<?php 
    include_once('includes/header.php');
?>

    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
        <div class="max-w-7xl mx-auto">
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Panel Principal</h1>

            <!-- Tarjetas estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-md">
                <p class="text-sm font-medium text-gray-500">Notas Registradas</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">18</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <p class="text-sm font-medium text-gray-500">Materias Creadas</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">6</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <p class="text-sm font-medium text-gray-500">Tareas Pendientes</p>
                <p class="text-2xl font-bold text-yellow-500 mt-1">3</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <p class="text-sm font-medium text-gray-500">Tareas Completadas</p>
                <p class="text-2xl font-bold text-green-500 mt-1">9</p>
            </div>
            </div>

            <!-- Sección de gráficos y notas tipo Google Keep -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Gráfico -->
            <div class="bg-white rounded-xl p-6 shadow-md col-span-1 lg:col-span-2">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Progreso semanal</h2>
                <canvas id="graficoSemanal" height="180"></canvas>
            </div>

            <!-- Notas estilo Google Keep -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Notas rápidas</h2>
                <div class="grid grid-cols-2 gap-3 mb-4" id="notasGrid">
                <!-- Notas se agregan aquí -->
                </div>
                <div class="flex gap-2">
                <input type="text" id="nuevaNota" placeholder="Escribe una nota..." class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                <button id="agregarNota" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded text-sm"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            </div>
        </div>
    </main>

<?php 
    include_once('includes/footer.php');
?>

<script src="dist/js/escritorio.js"></script>
