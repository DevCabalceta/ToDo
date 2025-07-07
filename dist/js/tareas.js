$(document).ready(function () {

  /********************************************* Sortable Kanban *********************************************/
  const columns = ['todo', 'inProgress', 'done'];

  columns.forEach(id => {
    new Sortable(document.getElementById(id), {
      group: 'kanban',
      animation: 200,
      ghostClass: 'bg-gray-200',
      dragClass: 'opacity-50',
      chosenClass: 'sortable-chosen',
      onSort: function () {
        checkEmptyColumns();
      }
    });
  });
  /********************************************* FIN Sortable Kanban ******************************************/

  /********************************************* Verificar columnas vacías ***********************************/
  function checkEmptyColumns() {
    columns.forEach(id => {
      const $column = $('#' + id);
      $column.find('.placeholder').remove(); // eliminar cualquier mensaje anterior

      if ($column.children('.relative').length === 0) {
        let icon = '', title = '', subtitle = '', color = '';

        if (id === 'todo') {
          icon = 'fas fa-inbox';
          title = 'No hay tareas por hacer';
          subtitle = 'Agrega nuevas tareas para comenzar.';
          color = 'text-pink-600';
        } else if (id === 'inProgress') {
          icon = 'fas fa-hourglass-half';
          title = 'Nada en progreso';
          subtitle = 'Arrastra tareas aquí cuando empieces.';
          color = 'text-yellow-700';
        } else if (id === 'done') {
          icon = 'fas fa-check-circle';
          title = '¡Todo completado!';
          subtitle = 'Buen trabajo, sigue así.';
          color = 'text-green-700';
        }

        const placeholder = `
          <div class="placeholder flex flex-col justify-center items-center text-center py-12 px-4 ${color}">
            <i class="${icon} text-4xl mb-2"></i>
            <h4 class="font-semibold text-base">${title}</h4>
            <p class="text-sm opacity-80">${subtitle}</p>
          </div>
        `;
        $column.append(placeholder);
      }
    });
  }

  checkEmptyColumns(); // al cargar
  /********************************************* FIN Verificar columnas vacías *******************************/

});
