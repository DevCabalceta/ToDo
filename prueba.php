<?php 
    include_once('includes/header.php');
?>

    <main class="flex-1 p-6 transition-all duration-300 main-expanded">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tus Tareas</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna: Por Hacer -->
            <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Por Hacer</h2>

            <!-- Tarjeta -->
            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded mb-4">
                <h3 class="text-md font-bold text-indigo-800">Diseñar página de inicio</h3>
                <p class="text-sm text-gray-600">Rediseñar el layout principal del dashboard</p>
                <div class="mt-2 text-xs text-gray-500">📅 5 días restantes</div>
            </div>

            <!-- Tarjeta -->
            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded mb-4">
                <h3 class="text-md font-bold text-indigo-800">Corregir errores de CSS</h3>
                <p class="text-sm text-gray-600">Ajustar colores y espaciado en los botones</p>
                <div class="mt-2 text-xs text-gray-500">📅 2 días restantes</div>
            </div>

            <!-- Botón agregar -->
            <button class="w-full mt-2 py-2 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded shadow">
                + Agregar nueva tarea
            </button>
            </div>

            <!-- Columna: En Progreso -->
            <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">En Progreso</h2>

            <!-- Tarjeta -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded mb-4">
                <h3 class="text-md font-bold text-yellow-800">Implementar API de usuarios</h3>
                <p class="text-sm text-gray-600">Conectar con el backend para autenticación</p>
                <div class="mt-2 text-xs text-gray-500">⚙️ En desarrollo</div>
            </div>
            </div>

            <!-- Columna: Hecho -->
            <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Hecho</h2>

            <!-- Tarjeta -->
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded mb-4">
                <h3 class="text-md font-bold text-green-800">Actualizar logo</h3>
                <p class="text-sm text-gray-600">Se cambió el logo por la nueva versión oficial</p>
                <div class="mt-2 text-xs text-gray-500">✅ Completado</div>
            </div>
            </div>
        </div>
    </main>

<?php 
    include_once('includes/footer.php');
?>