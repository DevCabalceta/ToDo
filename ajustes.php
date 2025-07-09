<?php 
    include_once('includes/header.php');
?>

    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
    <!-- Encabezado -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><i class="fas fa-cogs text-indigo-600 me-2"></i>Ajustes</h1>
        <p class="text-gray-500">Personaliza tu experiencia en Academic ToDo</p>
    </div>

    <!-- Contenido dividido -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Perfil -->
        <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4"><i class="fas fa-user-circle me-2 text-indigo-500"></i>Perfil</h2>
        <div class="space-y-4">
            <input type="text" placeholder="Nombre completo" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <input type="email" placeholder="Correo electrónico" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition">Guardar Cambios</button>
        </div>
        </div>

        <!-- Preferencias -->
        <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4"><i class="fas fa-sliders-h me-2 text-indigo-500"></i>Preferencias</h2>
        <div class="space-y-4">
            <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Tema</label>
            <select class="w-full border border-gray-300 rounded-lg p-2">
                <option>Claro</option>
                <option>Oscuro</option>
            </select>
            </div>
            <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Idioma</label>
            <select class="w-full border border-gray-300 rounded-lg p-2">
                <option>Español</option>
                <option>English</option>
            </select>
            </div>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition">Guardar Preferencias</button>
        </div>
        </div>

        <!-- Notificaciones -->
        <div class="bg-white rounded-xl shadow-md p-6 md:col-span-2">
        <h2 class="text-xl font-semibold text-gray-800 mb-4"><i class="fas fa-bell me-2 text-indigo-500"></i>Notificaciones</h2>
        <div class="space-y-4">
            <label class="flex items-center space-x-3">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600">
            <span class="text-gray-700">Recibir notificaciones de nuevas tareas</span>
            </label>
            <label class="flex items-center space-x-3">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600">
            <span class="text-gray-700">Alertas de vencimiento próximas</span>
            </label>
            <label class="flex items-center space-x-3">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600">
            <span class="text-gray-700">Novedades de la plataforma</span>
            </label>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition">Actualizar Notificaciones</button>
        </div>
        </div>

        <!-- Cerrar sesión -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
            <button class="text-red-600 bg-red-50 hover:bg-red-600 hover:text-white px-5 py-2 rounded-md shadow-md transition font-medium flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </div>


    </div>
    </main>


<?php 
    include_once('includes/footer.php');
?>