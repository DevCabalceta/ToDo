<?php 
    include_once('includes/header.php');
?>

    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Tareas</h1>

        <!-- Métricas de Tareas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 fade-in">
            <!-- Tareas Totales -->
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-indigo-500 text-center hover:shadow-md transition">
                <div class="text-indigo-600 mb-2">
                <i class="fas fa-tasks text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-indigo-600" id="totalTareas">0</h3>
                <p class="text-gray-500 text-sm">Tareas Totales</p>
            </div>

            <!-- Tareas en Progreso -->
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500 text-center hover:shadow-md transition">
                <div class="text-yellow-600 mb-2">
                <i class="fas fa-spinner text-2xl animate-spin"></i>
                </div>
                <h3 class="text-3xl font-bold text-yellow-600" id="tareasProgreso">0</h3>
                <p class="text-gray-500 text-sm">En Progreso</p>
            </div>

            <!-- Tareas Completadas -->
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500 text-center hover:shadow-md transition">
                <div class="text-green-600 mb-2">
                <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-green-600" id="tareasCompletadas">0</h3>
                <p class="text-gray-500 text-sm">Completadas</p>
            </div>

            <!-- Materias Registradas -->
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-pink-500 text-center hover:shadow-md transition">
                <div class="text-pink-600 mb-2">
                <i class="fas fa-book text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-pink-600" id="materiasRegistradas">0</h3>
                <p class="text-gray-500 text-sm">Materias</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
            <button onclick="document.getElementById('modalMateria').showModal()" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-md shadow-md transition font-medium flex items-center gap-2">
                <i class="fas fa-book"></i> Agregar Materia
            </button>
            <button onclick="document.getElementById('modalTarea').showModal()" class="bg-pink-600 hover:bg-pink-500 text-white px-5 py-2 rounded-md shadow-md transition font-medium flex items-center gap-2">
                <i class="fas fa-tasks"></i> Agregar Tarea
            </button>
        </div>

        <!-- Métricas de Kanban -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="kanbanBoard">

            <!-- POR HACER -->
            <div class="bg-pink-50 border border-pink-200 rounded-xl shadow-sm p-6 relative">
                <h2 class="text-lg font-semibold mb-4 text-pink-700 flex items-center gap-2">
                    <i class="fas fa-lightbulb"></i> Por Hacer
                </h2>

                <!-- Contenedor de tareas con padding inferior extra -->
                <div id="todo" class="space-y-4 min-h-[200px] pb-12">
                    <!-- Tareas aquí -->
                    <div class="relative bg-white p-4 rounded-xl shadow-md hover:shadow-lg cursor-move transition group">
                    <!-- Íconos -->
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
                </div>

                <!-- Contador con posición absoluta pero ya sin estorbar -->
                <div class="absolute bottom-4 left-4 text-sm text-pink-600 font-semibold flex items-center gap-2">
                    <i class="fas fa-list-check"></i>
                    <span id="count-todo">0 tareas</span>
                </div>
            </div>


            <!-- EN PROGRESO -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl shadow-sm p-6 relative">
                <h2 class="text-lg font-semibold mb-4 text-yellow-700 flex items-center gap-2">
                    <i class="fas fa-spinner animate-spin"></i> En Progreso
                </h2>

                <div id="inProgress" class="space-y-4 min-h-[200px] pb-12">
                    <!-- Tarea ejemplo -->
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
                <div class="absolute bottom-4 left-4 text-sm text-yellow-700 font-semibold flex items-center gap-2">
                    <i class="fas fa-list-check"></i>
                    <span id="count-inProgress">0 tareas</span>
                </div>
            </div>

            <!-- COMPLETADO -->
            <div class="bg-green-50 border border-green-200 rounded-xl shadow-sm p-6 relative">
                <h2 class="text-lg font-semibold mb-4 text-green-700 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> Completado
                </h2>

                <div id="done" class="space-y-4 min-h-[200px] pb-12">
                    <!-- Tarea ejemplo -->
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
                <div class="absolute bottom-4 left-4 text-sm text-green-700 font-semibold flex items-center gap-2">
                    <i class="fas fa-list-check"></i>
                    <span id="count-done">0 tareas</span>
                </div>
            </div>

        </div>

    </main>

<!-- Modal para Agregar Materia -->
<dialog id="modalMateria" class="rounded-xl shadow-xl w-full max-w-md p-6 border border-gray-200">
  <h2 class="text-lg font-semibold mb-4 text-indigo-600">Agregar Materia</h2>
  <form method="dialog" class="space-y-4">
    <div>
      <label class="block text-sm font-medium text-gray-700">Nombre de la materia</label>
      <input type="text" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ej. Matemática I" required>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Color</label>
      <input type="color" class="mt-1 w-16 h-10 p-1 border border-gray-300 rounded-md cursor-pointer">
    </div>
    <div class="flex justify-end gap-2 pt-4">
      <button type="button" onclick="document.getElementById('modalMateria').close()" class="text-sm text-gray-500 hover:text-gray-700">Cancelar</button>
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-md text-sm font-medium">Guardar</button>
    </div>
  </form>
</dialog>

<!-- Modal para Agregar Tarea -->
<dialog id="modalTarea" class="rounded-xl shadow-xl w-full max-w-md p-6 border border-gray-200">
  <h2 class="text-lg font-semibold mb-4 text-pink-600">Agregar Tarea</h2>
  <form method="dialog" class="space-y-4">
    <div>
      <label class="block text-sm font-medium text-gray-700">Nombre de la tarea</label>
      <input type="text" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Ej. Leer capítulo 4" required>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Materia</label>
      <select class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
        <option value="">Seleccionar...</option>
        <option>Matemática I</option>
        <option>Historia Universal</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
      <input type="date" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Descripción</label>
      <textarea rows="3" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Detalles de la tarea..."></textarea>
    </div>
    <div class="flex justify-end gap-2 pt-4">
      <button type="button" onclick="document.getElementById('modalTarea').close()" class="text-sm text-gray-500 hover:text-gray-700">Cancelar</button>
      <button type="submit" class="bg-pink-600 hover:bg-pink-500 text-white px-4 py-2 rounded-md text-sm font-medium">Guardar</button>
    </div>
  </form>
</dialog>


<?php 
    include_once('includes/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="dist/js/tareas.js"></script>