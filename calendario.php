<?php 
    include_once('includes/header.php');
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

            .materia-matematicas { background-color: #22c55e; }
            .materia-espanol { background-color: #3b82f6; }
            .materia-ciencias { background-color: #f97316; }
            .materia-historia { background-color: #a855f7; }
        </style>

        <div class="max-w-7xl mx-auto w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">📅 Calendario</h1>

            <!-- Controles de mes -->
            <div class="flex items-center justify-between mb-4">
            <button data-mes="-1" class="text-xl px-3 py-1 rounded-md bg-white hover:bg-gray-100 shadow">
                <i class="fas fa-chevron-left"></i>
            </button>
            <h2 id="mes-actual" class="text-2xl font-semibold text-gray-800"></h2>
            <button data-mes="1" class="text-xl px-3 py-1 rounded-md bg-white hover:bg-gray-100 shadow">
                <i class="fas fa-chevron-right"></i>
            </button>
            </div>

            <!-- Días de la semana -->
            <div class="grid grid-cols-7 gap-px bg-gray-300 text-center font-semibold text-sm text-gray-700 mb-1">
            <div class="bg-gray-100 p-2">Dom</div>
            <div class="bg-gray-100 p-2">Lun</div>
            <div class="bg-gray-100 p-2">Mar</div>
            <div class="bg-gray-100 p-2">Mié</div>
            <div class="bg-gray-100 p-2">Jue</div>
            <div class="bg-gray-100 p-2">Vie</div>
            <div class="bg-gray-100 p-2">Sáb</div>
            </div>

            <!-- Celdas del calendario -->
            <div id="calendario" class="grid grid-cols-7 gap-px bg-gray-300"></div>
        </div>
    </main>


<?php 
    include_once('includes/footer.php');
?>

<script src="dist/js/calendario.js"></script>