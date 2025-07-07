<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="min-h-screen flex items-center justify-center bg-white relative overflow-hidden">

  <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Academic ToDo</span>
          <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
          </a>
      </div>
      <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          </button>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="index.php" class="text-sm font-semibold text-gray-900">Inicio <span aria-hidden="true">&rarr;</span></a>
      </div>
      </nav>
  </header>

  <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem]
                -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30
                sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]">
    </div>
  </div>


<!----------------------------------------------------------------------------LOGIN------------------------------------------------------------------------------------------------------------->
  <!-- Login -->
  <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/30 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40" id="loginForm">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Inicia sesión en tu cuenta</h2>
      <p class="mt-2 text-sm text-gray-700">Bienvenido de vuelta</p>
    </div>

    <form class="space-y-6" action="#" method="POST">
      <!-- Correo -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-800">Correo electrónico</label>
        <input type="email" name="email" id="email" required autocomplete="email"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <!-- Contraseña con ojito -->
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium text-gray-800">Contraseña</label>
          <a href="#" id="showForgot" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">¿Olvidaste tu contraseña?</a>
        </div>
        <div class="mt-2 relative">
          <input type="password" name="password" id="password" required autocomplete="current-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                        placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 pr-10" />
          <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:text-indigo-600 z-10">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>

      <!-- Botón -->
      <div>
        <button id="loginBtn" type="submit"
                class="flex w-full justify-center items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md
                      hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition hover:cursor-pointer">
          <i class="fas fa-right-to-bracket"></i> Iniciar sesión
        </button>
      </div>
    </form>

    <!-- Registro -->
    <p class="mt-8 text-center text-sm text-gray-700">
      ¿No tienes una cuenta?
      <a href="#" id="showRegistro" class="font-semibold text-indigo-600 hover:text-indigo-500">Crea una ahora</a>
    </p>
  </div>

<!----------------------------------------------------------------------------REGISTRO---------------------------------------------------------------------------------------------------------->
  <!-- Registro -->
  <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/30 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40 hidden" id="registroForm">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Crea tu cuenta</h2>
      <p class="mt-2 text-sm text-gray-700">¡Únete a Academic ToDo y organiza tu vida académica!</p>
    </div>

    <form class="space-y-6" action="#" method="POST">
      <!-- Nombre -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-800">Nombre completo</label>
        <input type="text" name="name" id="name" required
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <!-- Correo -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-800">Correo electrónico</label>
        <input type="email" name="email" id="email" required autocomplete="email"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <!-- Contraseña con ojito -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-800">Contraseña</label>
        <div class="mt-2 relative">
          <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 pr-10 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:text-indigo-600 z-10">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>

      <!-- Confirmar contraseña -->
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-800">Confirmar contraseña</label>
        <input type="password" name="confirm_password" id="confirm_password" required
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <!-- Botón -->
      <div>
        <button type="submit"
                class="flex w-full justify-center items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md
                      hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition hover:cursor-pointer">
          <i class="fas fa-user-plus"></i> Registrarse
        </button>
      </div>
    </form>

    <!-- Enlace a login -->
    <p class="mt-8 text-center text-sm text-gray-700">
      ¿Ya tienes una cuenta?
      <a href="#" id="showLogin" class="font-semibold text-indigo-600 hover:text-indigo-500">Inicia sesión</a>
    </p>
  </div>

<!----------------------------------------------------------------------------RECUPERACION------------------------------------------------------------------------------------------------------>
  <!-- Recuperar contraseña -->
  <div id="recuperacionForm" class="hidden">
    <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/30 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900">¿Olvidaste tu contraseña?</h2>
        <p class="mt-2 text-sm text-gray-700">Te enviaremos un enlace para restablecerla.</p>
      </div>

      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="forgot_email" class="block text-sm font-medium text-gray-800">Correo electrónico</label>
          <input type="email" name="forgot_email" id="forgot_email" required
                class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
          <button type="submit"
                  class="flex w-full justify-center items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md
                        hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
            <i class="fas fa-paper-plane"></i> Enviar enlace
          </button>
        </div>
      </form>

      <p class="mt-8 text-center text-sm text-gray-700">
        <a href="#" id="volverLogin" class="font-semibold text-indigo-600 hover:text-indigo-500">Volver al login</a>
      </p>
    </div>
  </div>


  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="dist/js/main.js"></script>

</body>
</html>

