<?php 
    include_once('includes/header.php');
?>

    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Tareas</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="kanbanBoard">
            <!-- POR HACER -->
            <div class="bg-pink-100 rounded-xl shadow-lg p-4">
            <h2 class="text-xl font-semibold mb-4 text-pink-800 flex items-center gap-2">
                <i class="fas fa-lightbulb"></i> Por Hacer
            </h2>
            <div id="todo" class="space-y-4 min-h-[200px]">
                <!-- TAREA -->
                <div class="relative bg-white p-4 rounded-xl shadow-md hover:shadow-lg cursor-move transition group">
                <!-- Íconos esquina superior -->
                <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="text-gray-500 hover:text-indigo-600" title="Editar">
                    <i class="fas fa-pen-to-square"></i>
                    </button>
                    <button class="text-gray-500 hover:text-red-600" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <h3 class="font-bold text-gray-800">Estudiar para el examen</h3>
                <p class="text-sm text-gray-600">Materia: Matemática I</p>
                <p class="text-xs text-gray-500 mt-1">Vence: 10/07/2025</p>
                <p class="text-sm text-gray-500 mt-2">Revisar temas de integrales y derivadas.</p>
                </div>

                <div class="relative bg-white p-4 rounded-xl shadow-md hover:shadow-lg cursor-move transition group">
                <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="text-gray-500 hover:text-indigo-600" title="Editar">
                    <i class="fas fa-pen-to-square"></i>
                    </button>
                    <button class="text-gray-500 hover:text-red-600" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <h3 class="font-bold text-gray-800">Leer capítulo 4</h3>
                <p class="text-sm text-gray-600">Materia: Historia Universal</p>
                <p class="text-xs text-gray-500 mt-1">Vence: 12/07/2025</p>
                <p class="text-sm text-gray-500 mt-2">Contexto de la Primera Guerra Mundial.</p>
                </div>
            </div>
            </div>

            <!-- EN PROGRESO -->
            <div class="bg-yellow-100 rounded-xl shadow-lg p-4">
            <h2 class="text-xl font-semibold mb-4 text-yellow-800 flex items-center gap-2">
                <i class="fas fa-spinner animate-spin"></i> En Progreso
            </h2>
            <div id="inProgress" class="space-y-4 min-h-[200px]">
                <div class="relative bg-white p-4 rounded-xl shadow-md hover:shadow-lg cursor-move transition group">
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="text-gray-500 hover:text-red-600" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <h3 class="font-bold text-gray-800">Proyecto de Biología</h3>
                <p class="text-sm text-gray-600">Análisis de ecosistemas</p>
                <p class="text-xs text-gray-500 mt-1">Vence: 14/07/2025</p>
                <p class="text-sm text-gray-500 mt-2">Incluir gráficos comparativos.</p>
                </div>
            </div>
            </div>

            <!-- COMPLETADO -->
            <div class="bg-green-100 rounded-xl shadow-lg p-4">
            <h2 class="text-xl font-semibold mb-4 text-green-800 flex items-center gap-2">
                <i class="fas fa-check-circle"></i> Completado
            </h2>
            <div id="done" class="space-y-4 min-h-[200px]">
                <div class="relative bg-white p-4 rounded-xl shadow-md hover:shadow-lg cursor-move transition group">
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="text-gray-500 hover:text-red-600" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <h3 class="font-bold text-gray-800">Subir tarea de Inglés</h3>
                <p class="text-sm text-gray-600">Entrega #2</p>
                <p class="text-xs text-gray-500 mt-1">Vence: 05/07/2025</p>
                <p class="text-sm text-gray-500 mt-2">Subtítulos en inglés incluidos.</p>
                </div>
            </div>
            </div>
        </div>
    </main>


<?php 
    include_once('includes/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="dist/js/tareas.js"></script>