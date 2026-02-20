// dist/js/escritorio.js
$(document).ready(function () {
  /****************************************************
   * Utils
   ****************************************************/
  function escapeHtml(str) {
    return (str || '')
      .replace(/&/g,'&amp;').replace(/</g,'&lt;')
      .replace(/>/g,'&gt;').replace(/"/g,'&quot;')
      .replace(/'/g,'&#039;');
  }
  function shortDate(dateStr) {
    try { return new Date(dateStr).toLocaleDateString('es-CR', { day:'2-digit', month:'short' }); }
    catch { return ''; }
  }

  /****************************************************
   * MÉTRICAS EN VIVO + DOUGHNUT ACTUALIZABLE
   ****************************************************/
  let doughnutChart = null;

  // Plugin: texto centrado que lee el total desde options
  const centerTextPlugin = {
    id: 'centerText',
    afterDraw(chart) {
      const total = chart.options?.plugins?.centerText?.total || 0;
      const { ctx, chartArea: { width, height } } = chart;
      ctx.save();
      ctx.font = '600 18px system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial';
      ctx.fillStyle = '#111827';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText(`${total}`, width / 2, height / 2 - 6);
      ctx.font = '12px system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial';
      ctx.fillStyle = '#6B7280';
      ctx.fillText('Total', width / 2, height / 2 + 12);
      ctx.restore();
    }
  };

  const CHART_COLORS = ['#F59E0B', '#3B82F6', '#10B981']; // Pendiente, Progreso, Completada

  function ensureDoughnut(total, c) {
    if (typeof Chart === 'undefined') return; // por si no cargaron Chart.js
    const ctx = document.getElementById('graficoEstados')?.getContext('2d');
    if (!ctx) return;

    if (!doughnutChart) {
      doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Pendiente', 'En progreso', 'Completada'],
          datasets: [{
            data: [c.pendiente, c.progreso, c.completada],
            backgroundColor: CHART_COLORS.map(col => col + 'E6'),
            borderColor: CHART_COLORS,
            borderWidth: 2,
            hoverOffset: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '65%',
          plugins: {
            legend: {
              display: true,
              position: 'bottom',
              labels: { usePointStyle: true, padding: 16, boxWidth: 10, color: '#374151', font: { size: 12 } }
            },
            tooltip: {
              callbacks: {
                label: (ctx) => {
                  const val = ctx.parsed;
                  const pct = total ? Math.round((val * 100) / total) : 0;
                  return ` ${ctx.label}: ${val} (${pct}%)`;
                }
              }
            },
            centerText: { total } // 👈 el total que pintará el plugin
          }
        },
        plugins: [centerTextPlugin]
      });
    } else {
      // Actualiza datos + total sin recrear
      doughnutChart.data.datasets[0].data = [c.pendiente, c.progreso, c.completada];
      doughnutChart.options.plugins.centerText.total = total;
      doughnutChart.update();
    }
  }

  function loadMetrics() {
    $.ajax({
      url: 'api/dashboard/metrics.php',
      method: 'GET',
      dataType: 'json',
      cache: false,
      data: { _t: Date.now() } // rompe caché del navegador/proxy
    })
    .done(function (res) {
      if (!res.ok) return;

      const m = res.metrics || {};
      const c = res.chart || { pendiente: 0, progreso: 0, completada: 0 };
      const total = (c.pendiente || 0) + (c.progreso || 0) + (c.completada || 0);

      // Tarjetas (IDs según tu HTML actual)
      $('#totalTareas').text(m.notas ?? 0);          // "Notas Registradas"
      $('#materiasCreadas').text(m.materias ?? 0);
      $('#tareasPendientes').text(m.pendientes ?? 0);
      $('#tareasCompletadas').text(m.completadas ?? 0);

      // Gráfico
      ensureDoughnut(total, c);
    })
    .fail(function (jqXHR) {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jqXHR.status}` });
    });
  }

  // Llamada inicial y refrescos automáticos
  loadMetrics();
  document.addEventListener('visibilitychange', () => { if (!document.hidden) loadMetrics(); });
  window.addEventListener('focus', loadMetrics);
  setInterval(loadMetrics, 30000); // cada 30s

  // Refresca métricas automáticamente cuando haya AJAX a notes/tareas/materias
  $(document).ajaxSuccess(function (e, xhr, settings) {
    if (!settings || !settings.url) return;
    if (settings.url.startsWith('api/notes/') || settings.url.startsWith('api/tareas/') || settings.url.startsWith('api/materias/')) {
      loadMetrics();
    }
  });

  // También disponible globalmente por si quieres dispararlo manual
  window.refreshDashboard = loadMetrics;

  /****************************************************
   * NOTAS RÁPIDAS (listar / crear / editar / eliminar)
   ****************************************************/
  const gradients = [
    'from-amber-50 to-amber-100',
    'from-rose-50 to-rose-100',
    'from-sky-50 to-sky-100',
    'from-emerald-50 to-emerald-100',
    'from-violet-50 to-violet-100',
    'from-slate-50 to-slate-100'
  ];

  function createNoteCardDOM(nota) {
    const grad = gradients[Math.floor(Math.random() * gradients.length)];
    return $(`
      <div class="group relative rounded-2xl p-4 bg-gradient-to-br ${grad} shadow-sm border border-white/60 hover:shadow-md transition">
        <div class="pr-8 text-sm text-gray-800 leading-snug select-text note-content">${escapeHtml(nota.contenido)}</div>
        <div class="mt-3 flex items-center justify-between text-[11px] text-gray-500">
          <span>${shortDate(nota.fecha_creacion)}</span>
          <div class="opacity-0 group-hover:opacity-100 transition">
            <button class="px-2 py-1 rounded-lg hover:bg-black/5 text-gray-600 editNote" title="Editar" data-id="${nota.id}">
              <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="px-2 py-1 rounded-lg hover:bg-black/5 text-red-500 deleteNote" title="Eliminar" data-id="${nota.id}">
              <i class="fa-regular fa-trash-can"></i>
            </button>
          </div>
        </div>
      </div>
    `);
  }

  function loadNotes() {
    $.ajax({
      url: 'api/notes/list.php',
      method: 'GET',
      dataType: 'json',
      cache: false,
      data: { _t: Date.now() }
    })
    .done(function(res){
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se pudieron cargar las notas.' });
        return;
      }
      const $grid = $('#notasGrid').empty();
      (res.items || []).forEach(n => $grid.append(createNoteCardDOM(n)));
      // Si quieres, también: $('#totalTareas').text((res.items || []).length);
    })
    .fail(function(jqXHR){
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jqXHR.status}` });
    });
  }

  // Cargar notas al iniciar
  loadNotes();

  // Agregar nota
  $(document).on('click', '#agregarNota', function(){
    const texto = $('#nuevaNota').val().trim();
    if (!texto) {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'warning', title:'Escribe algo', text:'La nota no puede estar vacía.' });
      return;
    }
    $.ajax({
      url: 'api/notes/create.php',
      method: 'POST',
      data: { contenido: texto },
      dataType: 'json',
      cache: false
    })
    .done(function(res){
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se pudo crear la nota.' });
        return;
      }
      const nota = { id: res.id, contenido: res.contenido, fecha_creacion: res.fecha_creacion };
      $('#notasGrid').prepend(createNoteCardDOM(nota));
      $('#nuevaNota').val('').focus();
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'success', title:'Nota guardada', timer: 900, showConfirmButton:false });
      loadMetrics(); // refresca métricas sin recargar
    })
    .fail(function(jqXHR){
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jqXHR.status}` });
    });
  });

  // Enter para agregar
  $('#nuevaNota').on('keydown', function(e){
    if (e.key === 'Enter') {
      e.preventDefault();
      $('#agregarNota').click();
    }
  });

  // Editar
  $(document).on('click', '.editNote', function(){
    const $btn = $(this);
    const id = $btn.data('id');
    const $card = $btn.closest('.group');
    const current = $card.find('.note-content').text().trim();

    if (typeof Swal === 'undefined') {
      const nuevo = prompt('Editar nota:', current || '');
      if (nuevo !== null) saveEdit(id, nuevo, $card);
      return;
    }

    Swal.fire({
      title: 'Editar nota',
      input: 'text',
      inputValue: current,
      inputAttributes: { maxlength: 200 },
      showCancelButton: true,
      confirmButtonText: 'Guardar',
      cancelButtonText: 'Cancelar'
    }).then(res => {
      if (res.isConfirmed) {
        const nuevo = (res.value || '').trim();
        saveEdit(id, nuevo, $card);
      }
    });
  });

  function saveEdit(id, texto, $card) {
    if (!texto) return;
    $.ajax({
      url: 'api/notes/update.php',
      method: 'POST',
      data: { id, contenido: texto },
      dataType: 'json',
      cache: false
    })
    .done(function(res){
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se pudo actualizar la nota.' });
        return;
      }
      $card.find('.note-content').html(escapeHtml(texto));
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'success', title:'Actualizada', timer: 800, showConfirmButton:false });
      // no afecta conteo, no recargamos métricas
    })
    .fail(function(jqXHR){
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jqXHR.status}` });
    });
  }

  // Eliminar
  $(document).on('click', '.deleteNote', function(){
    const id = $(this).data('id');
    const $card = $(this).closest('.group');

    const proceed = () => {
      $.ajax({
        url: 'api/notes/delete.php',
        method: 'POST',
        data: { id },
        dataType: 'json',
        cache: false
      })
      .done(function(res){
        if (!res.ok) {
          if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se pudo eliminar la nota.' });
          return;
        }
        $card.addClass('scale-[.98] opacity-70 transition').fadeOut(160, function(){ $(this).remove(); });
        loadMetrics(); // refresca métricas sin recargar
      })
      .fail(function(jqXHR){
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jqXHR.status}` });
      });
    };

    if (typeof Swal === 'undefined') {
      if (confirm('¿Eliminar esta nota?')) proceed();
      return;
    }

    Swal.fire({
      icon: 'warning',
      title: '¿Eliminar nota?',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) proceed(); });
  });
});
