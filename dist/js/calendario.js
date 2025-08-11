$(document).ready(function () {
  let fechaActual = new Date();
  const tareasData = Array.isArray(tareas) ? tareas : [];

  function cambiarMes(offset) {
    fechaActual.setMonth(fechaActual.getMonth() + offset);
    renderizarCalendario();
  }

  $(document).on('click', '[data-mes]', function () {
    const offset = parseInt($(this).data('mes'));
    cambiarMes(offset);
  });

  function renderizarCalendario() {
    const calendario = $('#calendario');
    const mesTexto = $('#mes-actual');
    calendario.empty();

    const año = fechaActual.getFullYear();
    const mes = fechaActual.getMonth();
    const primerDia = new Date(año, mes, 1);
    const ultimoDia = new Date(año, mes + 1, 0);
    const diaInicio = primerDia.getDay();

    const nombreMes = primerDia.toLocaleString("es", { month: "long" });
    mesTexto.text(`${nombreMes.charAt(0).toUpperCase() + nombreMes.slice(1)} ${año}`);

    const hoy = new Date();
    const fechaHoyStr = `${hoy.getFullYear()}-${String(hoy.getMonth() + 1).padStart(2, "0")}-${String(hoy.getDate()).padStart(2, "0")}`;

    for (let i = 0; i < diaInicio; i++) {
      $('<div>').addClass('bg-transparent').appendTo(calendario);
    }

    for (let dia = 1; dia <= ultimoDia.getDate(); dia++) {
      const fechaStr = `${año}-${String(mes + 1).padStart(2, "0")}-${String(dia).padStart(2, "0")}`;
      const divDia = $('<div>').addClass('bg-white aspect-square p-2 text-sm border border-gray-200 relative hover:shadow-md transition');

      const numeroDia = fechaStr === fechaHoyStr
        ? $('<span>').addClass('absolute top-2 left-2 w-6 h-6 leading-6 rounded-full bg-indigo-500 text-white text-xs text-center font-bold').text(dia)
        : $('<p>').addClass('text-gray-800 font-bold text-sm').text(dia);

      divDia.append(numeroDia);

      const tareasDelDia = tareasData.filter(t => t.fecha_vencimiento === fechaStr);

      tareasDelDia.forEach(t => {
        $('<div>')
          .addClass('tarea')
          .css('background-color', t.color || '#888')
          .attr('title', t.descripcion || '')
          .text(t.titulo)
          .appendTo(divDia);
      });

      calendario.append(divDia);
    }

    const totalCeldas = calendario.children().length;
    const celdasFaltantes = 42 - totalCeldas;

    for (let i = 0; i < celdasFaltantes; i++) {
      $('<div>').addClass('bg-transparent').appendTo(calendario);
    }
  }

  renderizarCalendario();
});
