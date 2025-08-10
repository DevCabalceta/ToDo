<?php 
    include_once('includes/header.php');
    require_once 'controllers/CalendarController.php';

    $controller = new CalendarController();
    $tareas = $controller->obtenerTareas();
?>
    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
        <style>
            .tarea {
            font-size: 12px;
            padding: 2px 4px;
            border-radius: 0.25rem;
            margin-top: 4px;
            color: white;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            }
        </style>

        <div class="max-w-7xl mx-auto w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">📅 Calendario</h1>
        <div class="flex items-center justify-between mb-4">
            <button data-mes="-1" class="text-xl px-3 py-1 rounded-md bg-white hover:bg-gray-100 shadow">
                <i class="fas fa-chevron-left"></i>
            </button>
            <h2 id="mes-actual" class="text-2xl font-semibold text-gray-800"></h2>
            <button data-mes="1" class="text-xl px-3 py-1 rounded-md bg-white hover:bg-gray-100 shadow">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <div class="grid grid-cols-7 gap-px bg-gray-300 text-center font-semibold text-sm text-gray-700 mb-1">
            <div class="bg-gray-100 p-2">Dom</div>
            <div class="bg-gray-100 p-2">Lun</div>
            <div class="bg-gray-100 p-2">Mar</div>
            <div class="bg-gray-100 p-2">Mié</div>
            <div class="bg-gray-100 p-2">Jue</div>
            <div class="bg-gray-100 p-2">Vie</div>
            <div class="bg-gray-100 p-2">Sáb</div>
        </div>
        <div id="calendario" class="grid grid-cols-7 gap-px bg-gray-300"></div>
    </div>
</main>

<?php include_once('includes/footer.php'); ?>

<script>
  const tareas = <?php echo json_encode($tareas); ?>;
</script>
<script src="dist/js/calendario.js"></script>