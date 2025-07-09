$(document).ready(function () {

  /********************************************* Notas estilo Google Keep *********************************************/
  $(document).on('click', '#agregarNota', function () {
    const texto = $('#nuevaNota').val().trim();
    if (texto !== '') {
      const colores = ['bg-yellow-100', 'bg-pink-100', 'bg-blue-100', 'bg-green-100', 'bg-purple-100'];
      const color = colores[Math.floor(Math.random() * colores.length)];
      const nota = `
        <div class="${color} p-3 rounded shadow-sm text-sm text-gray-800 relative">
          <span>${texto}</span>
          <button class="absolute top-1 right-1 text-red-400 hover:text-red-600 eliminarNota"><i class='fas fa-times'></i></button>
        </div>`;
      $('#notasGrid').append(nota);
      $('#nuevaNota').val('');
    }
  });

  $(document).on('click', '.eliminarNota', function () {
    $(this).closest('div').remove();
  });
  /******************************************* FIN Notas estilo Google Keep *******************************************/

  /****************************************** Chart.js ***********************************************/
  const ctx = document.getElementById('graficoSemanal').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
      datasets: [{
        label: 'Tareas',
        data: [3, 2, 4, 3, 5, 1, 4],
        borderColor: '#6366F1',
        backgroundColor: 'rgba(99, 102, 241, 0.2)',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
  /***************************************** FIN Chart.js ********************************************/

});
