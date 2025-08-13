// dist/js/tareas.js
$(document).ready(function () {
  /*********************** State ***********************/
  let materias = [];   // {id, nombre, color}
  let tareas   = [];   // rows desde API
  const columns = ['todo', 'inProgress', 'done'];
  const estadoByCol = { 'todo':1, 'inProgress':2, 'done':3 };
  const colByEstado = { 1:'todo', 2:'inProgress', 3:'done' };
  const countsMap = { 'todo':'#count-todo', 'inProgress':'#count-inProgress', 'done':'#count-done' };

  /*********************** Helpers UI ***********************/
  function fmtDate(d) {
    if (!d) return '';
    const dt = new Date(d);
    if (isNaN(dt)) return d;
    const dd = String(dt.getDate()).padStart(2,'0');
    const mm = String(dt.getMonth()+1).padStart(2,'0');
    const yy = dt.getFullYear();
    return `${dd}/${mm}/${yy}`;
  }
  function escapeHtml(str){ return (str||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

  function taskCardTemplate(row) {
    return `
      <div class="task-card cursor-move relative bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition group border border-gray-100" 
          data-id="${row.id}" data-id_materia="${row.id_materia||''}" data-id_estado="${row.id_estado||1}">
        <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition pointer-events-auto">
          <button class="task-edit text-gray-500 hover:text-indigo-600" title="Editar"><i class="fas fa-pen-to-square"></i></button>
          <button class="task-delete text-gray-500 hover:text-red-600" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
        </div>

        <div class="flex items-start gap-3">
          <!-- 🔘 Handle de arrastre -->
          <div class="drag-handle shrink-0 mt-1 p-1.5 rounded-lg hover:bg-gray-50 text-gray-400">
            <i class="fa-solid fa-grip-vertical"></i>
          </div>


          <span class="inline-flex w-2.5 h-2.5 rounded-full mt-2" style="background:${row.color || '#94a3b8'}"></span>
          <div class="flex-1">
            <h3 class="font-semibold text-gray-900 leading-tight">${escapeHtml(row.titulo)}</h3>
            <p class="text-xs text-gray-500 mt-0.5">Materia: <span class="font-medium text-gray-700">${escapeHtml(row.materia || '-')}</span></p>
            ${row.fecha_vencimiento ? `<p class="text-xs text-gray-500 mt-1">Vence: ${fmtDate(row.fecha_vencimiento)}</p>` : ''}
            ${row.descripcion ? `<p class="text-sm text-gray-600 mt-2">${escapeHtml(row.descripcion)}</p>` : ''}
          </div>
        </div>
      </div>
    `;
  }


  function cleanColumns() { columns.forEach(id => $('#'+id).empty()); }

  function renderTareas() {
    cleanColumns();
    (tareas || []).forEach(t => {
      const col = colByEstado[t.id_estado] || 'todo';
      $('#'+col).append(taskCardTemplate(t));
    });
    checkEmptyColumns();
    updateCounts();
  }

  function populateMateriaOptions($select){
    $select.empty().append('<option value="">Seleccionar...</option>');
    (materias||[]).forEach(m => $select.append(`<option value="${m.id}">${escapeHtml(m.nombre)}</option>`));
  }

  function updateCounts(){
    columns.forEach(id=>{
      const count = $('#'+id+' .task-card').length;
      $(countsMap[id]).text(count === 1 ? '1 tarea' : `${count} tareas`);
    });
    const total = $('#todo .task-card').length + $('#inProgress .task-card').length + $('#done .task-card').length;
    $('#totalTareas').text(total);
    $('#tareasProgreso').text($('#inProgress .task-card').length);
    $('#tareasCompletadas').text($('#done .task-card').length);
    $('#materiasRegistradas').text(materias.length);
    renderMateriasList(); // actualiza contadores por materia
  }

  function checkEmptyColumns(){
    columns.forEach(id=>{
      const $col=$('#'+id);
      $col.find('.placeholder').remove();
      if($col.children('.task-card').length===0){
        let icon='', title='', subtitle='', color='';
        if(id==='todo'){ icon='fas fa-inbox'; title='No hay tareas por hacer'; subtitle='Agrega nuevas tareas para comenzar.'; color='text-pink-600'; }
        if(id==='inProgress'){ icon='fas fa-hourglass-half'; title='Nada en progreso'; subtitle='Arrastra tareas aquí cuando empieces.'; color='text-yellow-700'; }
        if(id==='done'){ icon='fas fa-check-circle'; title='¡Todo completado!'; subtitle='Buen trabajo, sigue así.'; color='text-green-700'; }
        $col.append(`
          <div class="placeholder flex flex-col justify-center items-center text-center py-10 px-4 ${color} border-2 border-dashed border-gray-200 rounded-xl bg-white/50">
            <i class="${icon} text-4xl mb-2"></i>
            <h4 class="font-semibold text-base">${title}</h4>
            <p class="text-sm opacity-80">${subtitle}</p>
          </div>`);
      }
    });
  }

  /*********************** Modal bonito ***********************/
  function openModal(contentTemplateSelector, modalId) {
    const tpl = document.getElementById('modal-template');
    const node = tpl.content.firstElementChild.cloneNode(true);
    if (modalId) node.id = modalId.replace('#','');
    const card = node.querySelector('.modal-card');
    const innerTpl = document.querySelector(contentTemplateSelector);
    card.appendChild(innerTpl.content.cloneNode(true));
    document.body.appendChild(node);
    requestAnimationFrame(()=>{ node.classList.remove('hidden'); node.querySelector('div.absolute').classList.remove('opacity-0'); card.classList.remove('opacity-0','-translate-y-3','scale-95'); });
    function close(){ node.querySelector('div.absolute').classList.add('opacity-0'); card.classList.add('-translate-y-3','opacity-0','scale-95'); setTimeout(()=>node.remove(),150); }
    $(node).on('click','.modal-close',close);
    $(node).on('click',e=>{ if(e.target===node) close(); });
    $(document).on('keydown.modal',e=>{ if(e.key==='Escape'){ close(); $(document).off('keydown.modal'); }});
    return node;
  }

  $(document).on('click','[data-open="#modalMateria"]',function(){
    openModal('#modal-materia-content','#modalMateria');
    $('#materia_modal_title').text('Agregar Materia');
    $('#mat_id').val(''); $('#mat_nombre').val(''); $('#mat_color').val('#6366F1');
  });

  $(document).on('click','[data-open="#modalTarea"]',function(){
    openModal('#modal-tarea-content','#modalTarea');
    populateMateriaOptions($('#tarea_materia'));
    $('#tarea_modal_title').text('Agregar Tarea');
    $('#tarea_id').val('');
    $('#formTarea')[0].reset();
  });

  /*********************** Render Materias (lista inferior) ***********************/
  function materiaCard(m){
    const count = (tareas||[]).filter(t=> +t.id_materia === +m.id).length;
    return `
      <div class="rounded-xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition">
        <div class="flex items-start justify-between gap-3">
          <div class="flex items-center gap-3">
            <span class="inline-flex w-3.5 h-3.5 rounded-full" style="background:${m.color||'#94a3b8'}"></span>
            <div>
              <p class="font-medium text-gray-900">${escapeHtml(m.nombre)}</p>
              <p class="text-xs text-gray-500">${count} ${count===1?'tarea':'tareas'}</p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <button class="materia-edit text-gray-600 hover:text-indigo-600" data-id="${m.id}" title="Editar"><i class="fas fa-pen-to-square"></i></button>
            <button class="materia-delete text-gray-600 hover:text-red-600" data-id="${m.id}" title="Eliminar"><i class="fas fa-trash"></i></button>
          </div>
        </div>
      </div>
    `;
  }
  function renderMateriasList(){
    const $list = $('#materiasList');
    if(!$list.length) return;
    $list.empty();
    (materias||[]).forEach(m=> $list.append(materiaCard(m)));
  }

  /*********************** AJAX: Materias ***********************/
  function loadMaterias(){
    return $.ajax({ url:'api/materias/list.php', method:'GET', dataType:'json', cache:false, data:{ _t:Date.now() } })
      .then(res=>{
        if(!res.ok) throw new Error(res.message||'No se pudieron cargar las materias');
        materias = res.items||[];
        $('#materiasRegistradas').text(res.count||materias.length);
        renderMateriasList();
      }).catch(err=>{
        if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:err.message});
      });
  }

  $(document).on('click','#formMateria [data-color]',function(){
    $('#mat_color').val($(this).data('color'));
    $(this).addClass('ring-indigo-500').siblings('[data-color]').removeClass('ring-indigo-500');
  });

  // Crear/Actualizar materia
  $(document).on('submit','#formMateria',function(e){
    e.preventDefault();
    const id    = $('#mat_id').val().trim();
    const nombre= $('#mat_nombre').val().trim();
    const color = $('#mat_color').val().trim() || '#888888';

    if(!nombre){
      if(typeof Swal!=='undefined') Swal.fire({icon:'warning',title:'Campo requerido',text:'El nombre de la materia es obligatorio.'});
      return;
    }

    const url = id ? 'api/materias/update.php' : 'api/materias/create.php';
    const payload = id ? { id, nombre, color } : { nombre, color };

    $.ajax({ url, method:'POST', dataType:'json', data: payload })
      .done(res=>{
        if(!res.ok){ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:res.message||'No se pudo guardar la materia.'}); return; }
        if(typeof Swal!=='undefined') Swal.fire({icon:'success',title: id?'Materia actualizada':'Materia creada', timer:1000, showConfirmButton:false});
        $('.modal .modal-close').last().click();
        // Recarga materias y tareas (para actualizar nombres/colores y conteos)
        loadMaterias().then(()=>{ populateMateriaOptions($('#tarea_materia')); });
        loadTareas();
      })
      .fail(jq=>{ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error de red',text:`HTTP ${jq.status}`}); });
  });

  // Editar materia (abre modal con datos)
  $(document).on('click','.materia-edit',function(){
    const id = $(this).data('id');
    const m = (materias||[]).find(x=> +x.id===+id);
    if(!m) return;
    openModal('#modal-materia-content','#modalMateria');
    $('#materia_modal_title').text('Editar Materia');
    $('#mat_id').val(m.id);
    $('#mat_nombre').val(m.nombre);
    $('#mat_color').val(m.color || '#6366F1');
  });

  // Eliminar materia (con advertencia)
  $(document).on('click','.materia-delete',function(){
    const id = $(this).data('id');
    const proceed = ()=>{
      $.ajax({ url:'api/materias/delete.php', method:'POST', dataType:'json', data:{ id } })
        .done(res=>{
          if(!res.ok){ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:res.message||'No se pudo eliminar la materia.'}); return; }
          if(typeof Swal!=='undefined') Swal.fire({icon:'success',title:'Materia eliminada',text:'Se eliminaron también sus tareas.', timer:1200, showConfirmButton:false});
          loadMaterias(); // actualiza lista
          loadTareas();   // refleja tareas eliminadas
        })
        .fail(jq=>{ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error de red',text:`HTTP ${jq.status}`}); });
    };

    if(typeof Swal==='undefined'){ if(confirm('Esto eliminará la materia y TODAS sus tareas. ¿Continuar?')) proceed(); return; }
    Swal.fire({
      icon:'warning',
      title:'Eliminar materia',
      text:'Se eliminará la materia y TODAS sus tareas asociadas. Esta acción no se puede deshacer.',
      showCancelButton:true,
      confirmButtonText:'Sí, eliminar',
      cancelButtonText:'Cancelar'
    }).then(r=>{ if(r.isConfirmed) proceed(); });
  });

  /*********************** AJAX: Tareas ***********************/
  function loadTareas(){
    return $.ajax({ url:'api/tareas/list.php', method:'GET', dataType:'json', cache:false, data:{ _t:Date.now() } })
      .then(res=>{
        if(!res.ok) throw new Error(res.message||'No se pudieron cargar las tareas');
        tareas = res.items||[];
        renderTareas();
      })
      .catch(err=>{
        if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:err.message});
      });
  }

  // Abrir modal de tarea para crear
  $(document).on('click','[data-open="#modalTarea"]',function(){
    // ya configurado en openModal hook
  });

  // Crear/Actualizar tarea
  $(document).on('submit','#formTarea',function(e){
    e.preventDefault();
    const id = $('#tarea_id').val().trim();
    const titulo = $('#tarea_titulo').val().trim();
    const id_materia = parseInt($('#tarea_materia').val()||0);
    const id_estado  = parseInt($('#tarea_estado').val()||1);
    const fecha_vencimiento = $('#tarea_fecha').val().trim();
    const descripcion = $('#tarea_desc').val().trim();

    if(!titulo){
      if(typeof Swal!=='undefined') Swal.fire({icon:'warning',title:'Título requerido',text:'Ingresa el nombre de la tarea.'});
      return;
    }
    if(!id_materia){
      if(typeof Swal!=='undefined') Swal.fire({icon:'warning',title:'Materia requerida',text:'Debes seleccionar una materia.'});
      return;
    }

    const payload = { titulo, id_materia, id_estado, fecha_vencimiento, descripcion };
    const url = id ? 'api/tareas/update.php' : 'api/tareas/create.php';
    if(id) payload.id = id;

    $.ajax({ url, method:'POST', dataType:'json', data: payload })
      .done(res=>{
        if(!res.ok){ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:res.message||'No se pudo guardar la tarea.'}); return; }
        if(typeof Swal!=='undefined') Swal.fire({icon:'success',title:'Tarea guardada',timer:900,showConfirmButton:false});
        $('.modal .modal-close').last().click();
        loadTareas();
      })
      .fail(jq=>{ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error de red',text:`HTTP ${jq.status}`}); });
  });

  // Editar tara (abrir modal con datos)
  $(document).on('click','.task-edit',function(){
    const $card = $(this).closest('.task-card');
    const id = $card.data('id');
    const row = tareas.find(t=> +t.id === +id);
    if(!row) return;

    openModal('#modal-tarea-content','#modalTarea');
    populateMateriaOptions($('#tarea_materia'));

    $('#tarea_modal_title').text('Editar Tarea');
    $('#tarea_id').val(row.id);
    $('#tarea_titulo').val(row.titulo);
    $('#tarea_materia').val(row.id_materia || '');
    $('#tarea_estado').val(row.id_estado || 1);
    $('#tarea_fecha').val(row.fecha_vencimiento || '');
    $('#tarea_desc').val(row.descripcion || '');
  });

  // Eliminar tarea
  $(document).on('click','.task-delete',function(){
    const id = $(this).closest('.task-card').data('id');
    const proceed = ()=>{
      $.ajax({ url:'api/tareas/delete.php', method:'POST', dataType:'json', data:{ id } })
        .done(res=>{
          if(!res.ok){ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error',text:res.message||'No se pudo eliminar la tarea.'}); return; }
          if(typeof Swal!=='undefined') Swal.fire({icon:'success',title:'Tarea eliminada',timer:800,showConfirmButton:false});
          loadTareas();
        })
        .fail(jq=>{ if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error de red',text:`HTTP ${jq.status}`}); });
    };
    if(typeof Swal==='undefined'){ if(confirm('¿Eliminar esta tarea?')) proceed(); return; }
    Swal.fire({icon:'warning',title:'¿Eliminar tarea?',showCancelButton:true,confirmButtonText:'Sí, eliminar',cancelButtonText:'Cancelar'})
        .then(r=>{ if(r.isConfirmed) proceed(); });
  });

  /*********************** Drag & Drop (arreglado) ***********************/
  // Config con fallback para navegadores que dan guerra; filtro para no iniciar drag desde botones
  columns.forEach(id=>{
    new Sortable(document.getElementById(id),{
      group:'kanban',
      handle: '.drag-handle',        // 👈 agarre dedicado
      animation: 180,
      forceFallback: true,
      fallbackClass: 'kanban-fallback',
      fallbackOnBody: true,
      fallbackTolerance: 6,
      swapThreshold: 0.65,

      // Móvil
      delay: 140,
      delayOnTouchOnly: true,
      touchStartThreshold: 3,

      // Auto-scroll
      scroll: true,
      bubbleScroll: true,
      scrollSensitivity: 40,
      scrollSpeed: 10,

      ghostClass: 'kanban-ghost',
      dragClass:  'kanban-drag',
      chosenClass:'kanban-chosen',

      // ❌ ¡Sin 'i' aquí!
      filter: '.task-edit, .task-delete, button',
      preventOnFilter: false,

      onStart() {
        document.body.classList.add('dragging-no-select','dragging');
      },
      onEnd(evt) {
        document.body.classList.remove('dragging-no-select','dragging');

        const $el = $(evt.item);
        const idTarea = +$el.data('id');
        const newCol = $(evt.to).attr('id');
        const newEstado = { 'todo':1, 'inProgress':2, 'done':3 }[newCol] || 1;

        // Optimista
        $el.attr('data-id_estado', newEstado);
        checkEmptyColumns();
        updateCounts();

        // Persistir en backend
        $.ajax({
          url:'api/tareas/move.php',
          method:'POST',
          dataType:'json',
          data:{ id:idTarea, id_estado:newEstado }
        })
        .done(res=>{
          if(!res.ok){
            if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'No se pudo mover',text:res.message});
            loadTareas(); // revertir
          } else {
            const t = tareas.find(x=> +x.id===idTarea);
            if(t) t.id_estado = newEstado;
          }
        })
        .fail(jq=>{
          if(typeof Swal!=='undefined') Swal.fire({icon:'error',title:'Error de red',text:`HTTP ${jq.status}`});
          loadTareas();
        });
      }
    });
  });




  /*********************** Init ***********************/
  Promise.all([loadMaterias(), loadTareas()])
    .then(()=>{ /* listo */ });

});
