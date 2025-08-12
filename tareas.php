<?php 
  include_once('includes/header.php');
?>

<main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">

  <style>


    /* Evitar selección de texto mientras se arrastra */
    .dragging-no-select, .dragging-no-select * {
      -webkit-user-select: none !important;
      -ms-user-select: none !important;
      user-select: none !important;
      -webkit-touch-callout: none !important;
    }

    /* Clases para Sortable (un solo token cada una) */
    .kanban-chosen {
      outline: 2px solid rgb(199 210 254); /* indigo-200 */
      outline-offset: 2px;
      border-radius: 0.75rem;
    }
    .kanban-drag { opacity: 0.7; }
    .kanban-ghost {
      background-color: #f3f4f6; /* gray-100 */
      border: 1px dashed #e5e7eb; /* gray-200 */
    }
    .kanban-fallback { transform: rotate(0.0001deg); } /* hack para perf */

    /* Handle de arrastre */
    .drag-handle {
      cursor: grab;
      -webkit-user-drag: none;
    }
    .dragging .drag-handle { cursor: grabbing; }

    /* Suavidad visual en la tarjeta */
    .task-card { will-change: transform; transition: transform 120ms ease; }

  </style>

  <!-- Título -->
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Gestión de Tareas</h1>
    <p class="text-gray-500">Organiza y visualiza tu avance por columnas.</p>
  </div>

  <!-- Métricas -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-indigo-100 hover:shadow-md transition">
      <div class="text-indigo-600 mb-2"><i class="fas fa-tasks text-2xl"></i></div>
      <h3 class="text-3xl font-bold text-indigo-600" id="totalTareas">0</h3>
      <p class="text-gray-500 text-sm">Tareas Totales</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-yellow-100 hover:shadow-md transition">
      <div class="text-yellow-500 mb-2"><i class="fas fa-spinner text-2xl"></i></div>
      <h3 class="text-3xl font-bold text-yellow-500" id="tareasProgreso">0</h3>
      <p class="text-gray-500 text-sm">En Progreso</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-green-100 hover:shadow-md transition">
      <div class="text-green-600 mb-2"><i class="fas fa-check-circle text-2xl"></i></div>
      <h3 class="text-3xl font-bold text-green-600" id="tareasCompletadas">0</h3>
      <p class="text-gray-500 text-sm">Completadas</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-100 hover:shadow-md transition">
      <div class="text-pink-600 mb-2"><i class="fas fa-book text-2xl"></i></div>
      <h3 class="text-3xl font-bold text-pink-600" id="materiasRegistradas">0</h3>
      <p class="text-gray-500 text-sm">Materias</p>
    </div>
  </div>

  <!-- Toolbar -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-6">
    <button data-open="#modalMateria"
      class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-xl shadow-sm transition font-medium inline-flex items-center gap-2">
      <i class="fas fa-book"></i> Agregar Materia
    </button>
    <button data-open="#modalTarea"
      class="bg-pink-600 hover:bg-pink-500 text-white px-5 py-2 rounded-xl shadow-sm transition font-medium inline-flex items-center gap-2">
      <i class="fas fa-tasks"></i> Agregar Tarea
    </button>
  </div>

  <!-- Kanban -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="kanbanBoard">
    <!-- Por hacer -->
    <section class="rounded-2xl bg-gradient-to-b from-pink-50 to-white border border-pink-200 shadow-sm p-6 relative">
      <h2 class="text-lg font-semibold mb-4 text-pink-700 flex items-center gap-2">
        <i class="fas fa-lightbulb"></i> Por Hacer
      </h2>
      <div id="todo" class="space-y-4 min-h-[220px] pb-12"></div>
      <div class="absolute bottom-4 left-4 text-sm text-pink-700 font-semibold flex items-center gap-2">
        <i class="fas fa-list-check"></i> <span id="count-todo">0 tareas</span>
      </div>
    </section>

    <!-- En progreso -->
    <section class="rounded-2xl bg-gradient-to-b from-yellow-50 to-white border border-yellow-200 shadow-sm p-6 relative">
      <h2 class="text-lg font-semibold mb-4 text-yellow-700 flex items-center gap-2">
        <i class="fas fa-spinner"></i> En Progreso
      </h2>
      <div id="inProgress" class="space-y-4 min-h-[220px] pb-12"></div>
      <div class="absolute bottom-4 left-4 text-sm text-yellow-700 font-semibold flex items-center gap-2">
        <i class="fas fa-list-check"></i> <span id="count-inProgress">0 tareas</span>
      </div>
    </section>

    <!-- Completado -->
    <section class="rounded-2xl bg-gradient-to-b from-green-50 to-white border border-green-200 shadow-sm p-6 relative">
      <h2 class="text-lg font-semibold mb-4 text-green-700 flex items-center gap-2">
        <i class="fas fa-check-circle"></i> Completado
      </h2>
      <div id="done" class="space-y-4 min-h-[220px] pb-12"></div>
      <div class="absolute bottom-4 left-4 text-sm text-green-700 font-semibold flex items-center gap-2">
        <i class="fas fa-list-check"></i> <span id="count-done">0 tareas</span>
      </div>
    </section>
  </div>

  <!-- ===== Materias (gestión) ===== -->
  <section class="mt-8 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
        <i class="fas fa-book-open text-indigo-500"></i> Materias
      </h2>
      <button data-open="#modalMateria"
        class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-sm shadow-sm">
        <i class="fas fa-plus"></i> Nueva Materia
      </button>
    </div>

    <div id="materiasList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
      <!-- Tarjetas de materias renderizadas por JS -->
    </div>
  </section>

</main>

<!-- ================== MODALES FINOS ================== -->

<!-- Overlay base (se clona por JS) -->
<template id="modal-template">
  <div class="modal fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px] opacity-0 transition-opacity"></div>
    <div class="relative mx-auto my-12 w-full max-w-lg px-4">
      <div class="modal-card opacity-0 -translate-y-3 scale-95 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 transition-all">
        <!-- contenido dinámico -->
      </div>
    </div>
  </div>
</template>

<!-- Contenido modal: Materia (crear/editar) -->
<template id="modal-materia-content">
  <div>
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <span class="inline-flex w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600 items-center justify-center">
          <i class="fas fa-book"></i>
        </span>
        <span id="materia_modal_title">Agregar Materia</span>
      </h3>
      <button class="modal-close text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
    </div>

    <form id="formMateria" class="space-y-4">
      <input type="hidden" id="mat_id" value="">
      <div>
        <label class="block text-sm font-medium text-gray-700">Nombre de la materia</label>
        <input id="mat_nombre" type="text" required placeholder="Ej. Matemática I"
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
        <div class="flex items-center gap-3">
          <input id="mat_color" type="color" value="#6366F1"
            class="w-14 h-10 rounded-md border border-gray-300 cursor-pointer">
          <div class="flex flex-wrap gap-2">
            <button type="button" data-color="#22c55e" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-indigo-400" style="background:#22c55e"></button>
            <button type="button" data-color="#3b82f6" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-indigo-400" style="background:#3b82f6"></button>
            <button type="button" data-color="#f97316" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-indigo-400" style="background:#f97316"></button>
            <button type="button" data-color="#a855f7" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-indigo-400" style="background:#a855f7"></button>
            <button type="button" data-color="#ef4444" class="w-6 h-6 rounded-full ring-2 ring-offset-2 ring-transparent hover:ring-indigo-400" style="background:#ef4444"></button>
          </div>
        </div>
      </div>

      <div class="pt-2 flex justify-end gap-2">
        <button type="button" class="modal-close px-4 py-2 rounded-xl text-sm text-gray-600 hover:bg-gray-100">Cancelar</button>
        <button type="submit" class="px-4 py-2 rounded-xl text-sm text-white bg-indigo-600 hover:bg-indigo-500">Guardar</button>
      </div>
    </form>
  </div>
</template>


<!-- Contenido modal: Tarea -->
<template id="modal-tarea-content">
  <div>
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <span class="inline-flex w-9 h-9 rounded-xl bg-pink-100 text-pink-600 items-center justify-center">
          <i class="fas fa-tasks"></i>
        </span>
        <span id="tarea_modal_title">Agregar Tarea</span>
      </h3>
      <button class="modal-close text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
    </div>

    <form id="formTarea" class="space-y-4">
      <input type="hidden" id="tarea_id" value="">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Título</label>
          <input id="tarea_titulo" type="text" required placeholder="Ej. Leer capítulo 4"
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Materia</label>
          <select id="tarea_materia" required
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
            <option value="">Seleccionar...</option>
            <!-- opciones por JS -->
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Estado</label>
          <select id="tarea_estado" required
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
            <option value="1">Pendiente</option>
            <option value="2">En progreso</option>
            <option value="3">Completada</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
          <input id="tarea_fecha" type="date" required
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea id="tarea_desc" rows="3" placeholder="Detalles de la tarea..."
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
      </div>

      <div class="pt-2 flex justify-between items-center gap-2">
        <button type="button" class="modal-close px-4 py-2 rounded-xl text-sm text-gray-600 hover:bg-gray-100">Cancelar</button>
        <button type="submit" class="px-4 py-2 rounded-xl text-sm text-white bg-pink-600 hover:bg-pink-500">Guardar</button>
      </div>
    </form>
  </div>
</template>

<?php 
  include_once('includes/footer.php');
?>

<!-- libs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<!-- si no tienes SweetAlert2 global aquí, puedes añadirlo: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="dist/js/tareas.js"></script>
