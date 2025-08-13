<?php 
    include_once('includes/header.php');
?>

<main id="mainContent" class="flex-1 p-6 transition-all duration-300 main-expanded">
  <!-- Encabezado -->
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-3">
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600">
        <i class="fas fa-cogs"></i>
      </span>
      Ajustes
    </h1>
    <p class="text-gray-500">Personaliza tu experiencia en Academic ToDo</p>
  </div>

  <!-- Contenido -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Columna izquierda (perfil + notificaciones) -->
    <div class="space-y-6 lg:col-span-1">

      <!-- Perfil -->
      <section class="bg-white/80 rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-user-circle text-indigo-500"></i> Perfil
          </h2>
        </div>

        <form id="formPerfil" class="space-y-4">
          <div>
            <label for="aj_nombre" class="block text-sm font-medium text-gray-700">Nombre completo</label>
            <input
              type="text" id="aj_nombre" name="nombre"
              value="<?php echo htmlspecialchars($_SESSION['user']['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
              class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Tu nombre"
            >
          </div>

          <div>
            <label for="aj_email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input
              type="email" id="aj_email" name="email"
              value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
              class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="tu@correo.com"
            >
          </div>

          <div class="pt-2">
            <button type="button" id="btnGuardarPerfil"
              class="inline-flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-black/90 active:scale-[.98] transition">
              <i class="fas fa-save"></i> Guardar cambios
            </button>
          </div>
        </form>
      </section>

      <!-- Notificaciones -->
      <section class="bg-white/80 rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-bell text-indigo-500"></i> Notificaciones
          </h2>
        </div>

        <form id="formNotificaciones" class="space-y-4">
          <div class="flex items-center justify-between gap-3">
            <div>
              <p class="text-sm font-medium text-gray-800">Recibir notificaciones</p>
              <p class="text-xs text-gray-500">Nuevas tareas, recordatorios y novedades.</p>
            </div>

            <!-- Switch -->
            <label class="relative inline-flex items-center cursor-pointer select-none">
              <input id="aj_notificaciones" type="checkbox" class="sr-only peer" checked>
              <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-200
                          peer peer-checked:bg-indigo-600 transition-all"></div>
              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-sm
                          peer-checked:translate-x-5 transform transition-all"></div>
            </label>
          </div>

          <div class="pt-2">
            <button type="button" id="btnGuardarNotificaciones"
              class="inline-flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-black/90 active:scale-[.98] transition">
              <i class="fas fa-save"></i> Guardar preferencia
            </button>
          </div>
        </form>
      </section>
    </div>

    <!-- Columna derecha (cambiar contraseña + cerrar sesión) -->
    <div class="space-y-6 lg:col-span-2">
      <!-- Cambiar contraseña -->
      <section class="bg-white/80 rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-key text-indigo-500"></i> Cambiar contraseña
          </h2>
        </div>

        <form id="formPassword" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Actual -->
            <div>
              <label for="aj_pass_actual" class="block text-sm font-medium text-gray-700">Contraseña actual</label>
              <div class="mt-1 relative">
                <input type="password" id="aj_pass_actual" name="pass_actual"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="••••••••">
                <button type="button" class="absolute inset-y-0 right-0 px-3 text-indigo-600 hover:text-indigo-500 toggle-visibility" data-target="#aj_pass_actual">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>

            <!-- Nueva -->
            <div>
              <label for="aj_pass_nueva" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
              <div class="mt-1 relative">
                <input type="password" id="aj_pass_nueva" name="pass_nueva"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Mínimo 8 caracteres">
                <button type="button" class="absolute inset-y-0 right-0 px-3 text-indigo-600 hover:text-indigo-500 toggle-visibility" data-target="#aj_pass_nueva">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <!-- Medidor fuerza -->
              <div class="mt-2">
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div id="aj_strength_bar" class="h-2 w-0 bg-red-500 transition-all"></div>
                </div>
                <p id="aj_strength_text" class="mt-1 text-xs text-gray-500">Seguridad: —</p>
              </div>
            </div>

            <!-- Confirmar -->
            <div>
              <label for="aj_pass_confirm" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
              <div class="mt-1 relative">
                <input type="password" id="aj_pass_confirm" name="pass_confirm"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Repite la nueva contraseña">
                <button type="button" class="absolute inset-y-0 right-0 px-3 text-indigo-600 hover:text-indigo-500 toggle-visibility" data-target="#aj_pass_confirm">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="pt-2">
            <button type="button" id="btnCambiarPassword"
              class="inline-flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-black/90 active:scale-[.98] transition">
              <i class="fas fa-rotate"></i> Actualizar contraseña
            </button>
          </div>
        </form>
      </section>

      <!-- Cerrar sesión -->
      <section class="bg-white/80 rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-md font-semibold text-gray-800">¿Quieres salir?</h3>
            <p class="text-sm text-gray-500">Puedes cerrar tu sesión de manera segura.</p>
          </div>
          <a id="logoutLink" href="api/auth/logout.php"
             class="inline-flex items-center gap-2 text-red-600 bg-red-50 hover:bg-red-600 hover:text-white px-5 py-2 rounded-xl shadow-sm transition">
            <i class="fas fa-arrow-right-from-bracket"></i> Cerrar sesión
          </a>
        </div>
      </section>
    </div>
  </div>
</main>

<?php 
    include_once('includes/footer.php');
?>

<!-- JS específico de esta página -->
<script src="public/dist/js/ajustes.js"></script>
