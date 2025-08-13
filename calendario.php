<?php 
  include_once('includes/header.php');
  require_once 'controllers/CalendarioController.php';

  $userId = $_SESSION['user']['id'];
  $controller = new CalendarController();
  $tareas = $controller->obtenerTareas($userId); 
?>

<main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
  <style>
    /* Grid responsive y celdas respirando */
    #cal-wrapper {
      container-type: inline-size;
    }
    #calendario {
      grid-auto-rows: minmax(110px, 1fr);
    }
    @container (min-width: 640px) {
      #calendario { grid-auto-rows: minmax(130px, 1fr); }
    }
    @container (min-width: 1024px) {
      #calendario { grid-auto-rows: minmax(150px, 1fr); }
    }

    /* Chip de tarea */
    .chip-task {
      display: flex;
      align-items: center;
      gap: .4rem;
      font-size: 12px;
      line-height: 1;
      padding: 6px 8px;
      border-radius: 10px;
      color: #fff;
      margin-top: 6px;
      width: 100%;
      text-align: left;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      box-shadow: 0 1px 0 rgba(0,0,0,.06);
      transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }
    .chip-task:hover { transform: translateY(-1px); filter: brightness(1.03); box-shadow: 0 2px 6px rgba(0,0,0,.08); }
    .chip-dot { width: 8px; height: 8px; border-radius: 999px; background: #fff; opacity: .9; flex-shrink: 0; }

    /* Botón +N más */
    .more-btn {
      margin-top: 6px;
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 8px;
      background: #f3f4f6;
      color: #374151;
      width: 100%;
      text-align: center;
      transition: background .15s ease;
    }
    .more-btn:hover { background: #e5e7eb; }

    /* Modal base (igual estilo que usamos en tareas.php) */
    .modal { position: fixed; inset: 0; z-index: 50; }
    .modal.hidden { display:none; }
    .modal-card { border-radius: 16px; }
  </style>

  <div id="cal-wrapper" >
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-3">
          <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600">
            <i class="fas fa-calendar-alt"></i>
          </span>
          Calendario
        </h1>
        <p class="text-gray-500">Revisa las tareas por fecha y mira sus detalles.</p>
      </div>

      <div class="flex items-center gap-2">
        <button data-mes="-1" class="px-3 py-2 rounded-xl bg-blue-500 text-white border border-gray-200 hover:bg-blue-400 shadow-sm">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button id="btnHoy" class="px-3 py-2 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 shadow-sm text-sm">Hoy</button>
        <button data-mes="1" class="px-3 py-2 rounded-xl bg-blue-500 text-white border border-gray-200 hover:bg-blue-400 shadow-sm">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>

    <div class="flex items-center justify-center mb-3">
      <h2 id="mes-actual" class="text-2xl font-semibold text-gray-900"></h2>
    </div>

    <!-- Encabezados de semana -->
    <div class="grid grid-cols-7 gap-px bg-gray-200 text-center font-semibold text-xs sm:text-sm text-gray-700 mb-1 rounded-lg overflow-hidden">
      <div class="bg-blue-500 text-white p-2">Dom</div>
      <div class="bg-blue-500 text-white p-2">Lun</div>
      <div class="bg-blue-500 text-white p-2">Mar</div>
      <div class="bg-blue-500 text-white p-2">Mié</div>
      <div class="bg-blue-500 text-white p-2">Jue</div>
      <div class="bg-blue-500 text-white p-2">Vie</div>
      <div class="bg-blue-500 text-white p-2">Sáb</div>
    </div>

    <!-- Calendario -->
    <div id="calendario" class="grid grid-cols-7 gap-px bg-gray-200 rounded-lg overflow-hidden"></div>
  </div>
</main>

<?php include_once('includes/footer.php'); ?>

<!-- Modal base (template) -->
<template id="modal-template">
  <div class="modal hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px] opacity-0 transition-opacity"></div>
    <div class="relative mx-auto my-8 w-full max-w-xl px-4">
      <div class="modal-card opacity-0 -translate-y-3 scale-95 bg-white shadow-xl border border-gray-100 p-6 transition-all">
        <!-- contenido dinámico -->
      </div>
    </div>
  </div>
</template>

<!-- Contenido: detalle de tarea -->
<template id="modal-task-content">
  <div>
    <div class="flex items-start justify-between mb-4">
      <div class="flex items-center gap-3">
        <span id="taskColorDot" class="inline-flex w-9 h-9 rounded-xl border border-white/70 shadow-sm"></span>
        <div>
          <h3 id="taskTitle" class="text-lg font-semibold text-gray-900">Título</h3>
          <p class="text-sm text-gray-500">Materia: <span id="taskSubject" class="font-medium text-gray-700"></span></p>
        </div>
      </div>
      <button class="modal-close text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
      <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
        <p class="text-xs text-gray-500">Fecha de vencimiento</p>
        <p id="taskDate" class="text-sm font-medium text-gray-800"></p>
      </div>
      <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
        <p class="text-xs text-gray-500">Color de materia</p>
        <div class="flex items-center gap-2">
          <span id="taskColorChip" class="inline-flex w-4 h-4 rounded-full border border-white/70 shadow-sm"></span>
          <code id="taskColorHex" class="text-xs text-gray-600"></code>
        </div>
      </div>
    </div>

    <div>
      <p class="text-xs text-gray-500 mb-1">Descripción</p>
      <p id="taskDesc" class="text-sm text-gray-700 whitespace-pre-wrap"></p>
    </div>

    <div class="pt-4 flex justify-end gap-2">
      <a href="tareas.php" class="px-4 py-2 rounded-xl text-sm bg-gray-100 hover:bg-gray-200 text-gray-700">Ver en Kanban</a>
      <button class="modal-close px-4 py-2 rounded-xl text-sm text-white bg-indigo-600 hover:bg-indigo-500">Cerrar</button>
    </div>
  </div>
</template>

<!-- Contenido: lista de tareas del día -->
<template id="modal-daylist-content">
  <div>
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-900">Tareas del <span id="dayListTitle"></span></h3>
      <button class="modal-close text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
    </div>
    <div id="dayListBody" class="space-y-3"></div>
    <div class="pt-4 flex justify-end">
      <button class="modal-close px-4 py-2 rounded-xl text-sm text-white bg-indigo-600 hover:bg-indigo-500">Cerrar</button>
    </div>
  </div>
</template>
<style>
  .modal {
    display: flex !important;
    align-items: center;
    justify-content: center;
    position: fixed;
    inset: 0;
    z-index: 50;
  }
  .modal .absolute {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    transition: opacity 0.2s;
  }
  .modal-card {
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    margin: auto;
    max-width: 32rem;
    width: 100%;
  }
</style>

<script>
  const tareas = <?php echo json_encode($tareas); ?>;
</script>
<script src="public/dist/js/calendario.js"></script>
