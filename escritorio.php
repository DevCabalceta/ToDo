<?php 
    include_once('includes/header.php');
?>

    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
        <div class="max-w-7xl mx-auto">
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Panel Principal</h1>

            <!-- Métricas (igual que ya tenías) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 fade-in">
            <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-blue-500 text-center hover:shadow-md transition">
                <div class="text-blue-600 mb-2">
                <i class="fas fa-sticky-note text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-blue-600" id="totalTareas">0</h3>
                <p class="text-gray-500 text-sm">Notas Registradas</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-purple-500 text-center hover:shadow-md transition">
                <div class="text-purple-600 mb-2">
                <i class="fas fa-book-open text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-purple-600" id="materiasCreadas">0</h3>
                <p class="text-gray-500 text-sm">Materias Creadas</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-yellow-500 text-center hover:shadow-md transition">
                <div class="text-yellow-600 mb-2">
                <i class="fas fa-hourglass-half text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-yellow-600" id="tareasPendientes">0</h3>
                <p class="text-gray-500 text-sm">Tareas Pendientes</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-green-500 text-center hover:shadow-md transition">
                <div class="text-green-600 mb-2">
                <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-green-600" id="tareasCompletadas">0</h3>
                <p class="text-gray-500 text-sm">Tareas Completadas</p>
            </div>
            </div>

            <!-- Gráfico + Notas -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Gráfico Doughnut -->
            <div class="bg-white rounded-2xl p-6 shadow-md col-span-1 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Estado de tus tareas</h2>
                <div class="text-xs text-gray-500">Últimos 30 días</div>
                </div>
                <div class="flex items-center justify-center">
                <div class="relative w-full max-w-xl">
                    <canvas id="graficoEstados" height="220"></canvas>
                </div>
                </div>
            </div>

            <!-- Notas estilo Apple -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Notas rápidas</h2>
                <div class="text-xs text-gray-500">Toques rápidos</div>
                </div>

                <!-- Grid de notas -->
                <div id="notasGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                <!-- Notas se agregan aquí -->
                </div>

                <!-- Composer -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center bg-gray-50 rounded-2xl p-2 border border-gray-200 focus-within:ring-2 focus-within:ring-indigo-100">
                <input
                    type="text"
                    id="nuevaNota"
                    placeholder="Escribe una nota..."
                    class="flex-1 min-w-0 px-4 py-2 text-sm bg-transparent outline-none text-gray-800"
                />
                <button
                    id="agregarNota"
                    class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-black/90 active:scale-[.98] transition shrink-0"
                    title="Agregar nota"
                >
                    <i class="fas fa-plus"></i> Agregar
                </button>
                </div>


                <!-- Sugerencias mini -->
                <div class="mt-3 flex flex-wrap gap-2">
                <button class="px-3 py-1 rounded-full text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 quick-suggest" data-text="Estudiar 30 minutos de matemáticas.">Estudiar</button>
                <button class="px-3 py-1 rounded-full text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 quick-suggest" data-text="Comprar marcadores y hojas.">Compras</button>
                <button class="px-3 py-1 rounded-full text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 quick-suggest" data-text="Enviar correo al profe.">Correo</button>
                </div>
            </div>
            </div>
        </div>
    </main>


<?php 
    include_once('includes/footer.php');
?>

<script src="dist/js/escritorio.js"></script>
