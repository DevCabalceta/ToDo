// dist/js/calendario.js
$(document).ready(function () {
  let fechaActual = new Date();
  const tareasData = Array.isArray(tareas) ? tareas : [];

  // ===== Helpers =====
  const pad = (n) => String(n).padStart(2, '0');
  const ymd = (d) => `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
  const fmtES = (yyyy_mm_dd) => {
    if (!yyyy_mm_dd) return '';
    const [y,m,d] = yyyy_mm_dd.split('-').map(Number);
    const dt = new Date(y, m-1, d);
    return dt.toLocaleDateString('es-CR', { day:'2-digit', month:'long', year:'numeric' });
  };
  const escapeHtml = (s) => (s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');

  // ===== Modal bonito (como en tareas.php) =====
  function openModal(tplSelector) {
    const tpl = document.getElementById('modal-template');
    const node = tpl.content.firstElementChild.cloneNode(true);
    const card = node.querySelector('.modal-card');
    const inner = document.querySelector(tplSelector);
    card.appendChild(inner.content.cloneNode(true));
    document.body.appendChild(node);

    requestAnimationFrame(() => {
      node.classList.remove('hidden');
      node.querySelector('div.absolute').classList.remove('opacity-0');
      card.classList.remove('opacity-0', '-translate-y-3', 'scale-95');
      card.classList.add('rounded-2xl');
    });

    function close() {
      node.querySelector('div.absolute').classList.add('opacity-0');
      card.classList.add('-translate-y-3', 'opacity-0', 'scale-95');
      setTimeout(() => node.remove(), 140);
    }
    $(node).on('click', '.modal-close', close);
    $(node).on('click', (e) => { if (e.target === node) close(); });
    $(document).on('keydown.modal', (e) => { if (e.key === 'Escape') { close(); $(document).off('keydown.modal'); }});
    return node;
  }

  // ===== Navegación =====
  function cambiarMes(offset) {
    fechaActual.setMonth(fechaActual.getMonth() + offset);
    renderizarCalendario();
  }
  $(document).on('click', '[data-mes]', function () {
    const offset = parseInt($(this).data('mes'));
    cambiarMes(offset);
  });
  $('#btnHoy').on('click', function(){
    const hoy = new Date();
    fechaActual = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
    renderizarCalendario();
  });

  // ===== Render =====
  function renderizarCalendario() {
    const calendario = $('#calendario');
    const mesTexto = $('#mes-actual');
    calendario.empty();

    const año = fechaActual.getFullYear();
    const mes = fechaActual.getMonth();
    const primerDia = new Date(año, mes, 1);
    const ultimoDia = new Date(año, mes + 1, 0);
    const diaInicio = primerDia.getDay(); // 0=Dom

    const nombreMes = primerDia.toLocaleString("es", { month: "long" });
    mesTexto.text(`${nombreMes.charAt(0).toUpperCase() + nombreMes.slice(1)} ${año}`);

    const hoy = new Date();
    const fechaHoyStr = ymd(hoy);

    // Huecos iniciales
    for (let i = 0; i < diaInicio; i++) {
      $('<div>').addClass('bg-transparent').appendTo(calendario);
    }

    // Días del mes
    for (let dia = 1; dia <= ultimoDia.getDate(); dia++) {
      const fechaStr = `${año}-${pad(mes + 1)}-${pad(dia)}`;

      const divDia = $('<div>')
        .addClass('bg-white p-2 text-sm border border-gray-200 relative hover:shadow-md transition flex flex-col')
        .css('min-height','100%');

      // Header del día
      const numeroDia = fechaStr === fechaHoyStr
        ? $('<span>').addClass('inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-500 text-white text-xs font-bold').text(dia)
        : $('<span>').addClass('text-gray-800 font-bold text-sm').text(dia);

      const header = $('<div>').addClass('flex items-center justify-between')
        .append(numeroDia);

      divDia.append(header);

      // Contenedor de chips
      const cont = $('<div>').addClass('mt-1 flex-1 overflow-hidden');
      const tareasDelDia = tareasData.filter(t => t.fecha_vencimiento === fechaStr);

      // Mostrar hasta 3 chips + "+N"
      const MAX = 3;
      tareasDelDia.slice(0, MAX).forEach(t => {
        const color = t.color || '#6b7280';
        const chip = $(`
          <button class="chip-task" title="${escapeHtml(t.titulo)}"
                  data-id="${t.id}"
                  data-title="${escapeHtml(t.titulo)}"
                  data-desc="${escapeHtml(t.descripcion || '')}"
                  data-materia="${escapeHtml(t.materia || '')}"
                  data-color="${color}"
                  data-date="${fechaStr}"
                  style="background:${color}">
            <span class="chip-dot"></span>
            <span class="truncate">${escapeHtml(t.titulo)}</span>
          </button>
        `);
        cont.append(chip);
      });

      if (tareasDelDia.length > MAX) {
        const more = $(`<button class="more-btn" data-date="${fechaStr}">+${tareasDelDia.length - MAX} más</button>`);
        cont.append(more);
      }

      divDia.append(cont);
      calendario.append(divDia);
    }

    // Completar a 42 celdas
    const totalCeldas = calendario.children().length;
    const celdasFaltantes = 42 - totalCeldas;
    for (let i = 0; i < celdasFaltantes; i++) {
      $('<div>').addClass('bg-transparent').appendTo(calendario);
    }
  }

  // ===== Interacciones =====
  // Click en chip -> detalle
  $(document).on('click', '.chip-task', function () {
    const data = $(this).data();
    const node = openModal('#modal-task-content');

    const setBg = (el, color) => { $(el).css('background', color); $(el).css('backgroundImage', ''); };
    $('#taskTitle', node).text(data.title || '—');
    $('#taskSubject', node).text(data.materia || '—');
    $('#taskDate', node).text(fmtES(data.date));
    $('#taskDesc', node).text(data.desc || '—');
    $('#taskColorHex', node).text(data.color || '#—');
    setBg($('#taskColorDot', node), data.color || '#6b7280');
    setBg($('#taskColorChip', node), data.color || '#6b7280');
  });

  // Click en "+N más" -> lista del día
  $(document).on('click', '.more-btn', function () {
    const date = $(this).data('date');
    const list = tareasData.filter(t => t.fecha_vencimiento === date);
    const node = openModal('#modal-daylist-content');
    $('#dayListTitle', node).text(fmtES(date));

    const $body = $('#dayListBody', node).empty();
    if (list.length === 0) {
      $body.append('<p class="text-sm text-gray-600">No hay tareas.</p>');
      return;
    }

    list.forEach(t => {
      const color = t.color || '#6b7280';
      const item = $(`
        <button class="w-full text-left bg-white border border-gray-100 rounded-xl p-3 hover:shadow-sm transition flex items-start gap-3 chip-task"
                data-id="${t.id}"
                data-title="${escapeHtml(t.titulo)}"
                data-desc="${escapeHtml(t.descripcion || '')}"
                data-materia="${escapeHtml(t.materia || '')}"
                data-color="${color}"
                data-date="${date}"
                style="background:${color};color:#fff;">
          <span class="chip-dot mt-[2px]"></span>
          <div class="flex-1">
            <div class="font-medium">${escapeHtml(t.titulo)}</div>
            ${t.descripcion ? `<div class="text-[12px] opacity-90">${escapeHtml(t.descripcion)}</div>` : ''}
            ${t.materia ? `<div class="text-[11px] opacity-90">Materia: ${escapeHtml(t.materia)}</div>` : ''}
          </div>
        </button>
      `);
      $body.append(item);
    });
  });

  // ===== Init =====
  renderizarCalendario();
});
