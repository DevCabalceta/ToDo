<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Admin</title>
    <link rel="icon" type="image/svg+xml" href="https://tailwindcss.com/favicons/favicon-32x32.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/dist/css/main.css">

</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-brand-black bg-repeat text-white font-sans">

    <header id="mainHeader" class="w-full overflow-visible z-[99999] fixed top-0 left-0 right-0 transition-all duration-300 backdrop-blur-lg bg-transparent mb-10">
        <div class="grid items-center justify-center md:justify-normal w-full grid-cols-[auto_1fr] mx-auto text-white gap-x-10 md:flex max-w-screen-full py-4">

            <div class="md:flex-grow md:basis-0 flex justify-start">
                <a href="home" class="ml-4 flex items-center gap-2.5 font-bold transition-transform duration-300 hover:scale-110">
                <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=blue&shade=500" width="228" height="198" alt="Logo">
                <span class="hidden lg:block text-[32px] tracking-wide">Academic ToDo</span>
                </a>
            </div>

            <div class="md:flex-grow md:basis-0 flex justify-end mr-3">
                <a href="./home" class="ml-4 flex items-center gap-2.5 font-bold ransition-transform duration-300 hover:scale-110">
                    <div class="bg-blue-500 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fa-solid fa-house text-white"></i>
                    </div>
                    <span class="hidden lg:block hover:text-blue-400">Inicio</span>
                </a>
            </div>
        </div>

    </header>

<!----------------------------------------------------------------------------LOGIN------------------------------------------------------------------------------------------------------------->
  <!-- Login -->
  <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/20 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40" id="loginForm">

    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-blue-500">Inicia sesión en tu cuenta</h2>
      <p class="mt-2 text-sm text-white">Bienvenido de vuelta</p>
    </div>

    <form class="space-y-6" action="#" method="POST">
      <!-- Correo -->
      <div>
        <label for="email" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-envelope text-white"></i>Correo electrónico</label>
        <input type="email" name="email" id="email" autocomplete="email"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Contraseña con ojito -->
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-lock text-white"></i>Contraseña</label>
          <a href="#" id="showForgot" class="text-sm text-blue-500 hover:text-blue-400 font-medium">¿Olvidaste tu contraseña?</a>
        </div>
        <div class="mt-2 relative">
          <input type="password" name="password" id="password" autocomplete="current-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                        placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" />
          <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-blue-500 hover:text-blue-400 hover:cursor-pointer z-10">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>

      <!-- Botón -->
      <div>
        <button id="loginBtn" type="submit"
                class="flex w-full justify-center items-center gap-2 rounded-md bg-brand-blue px-4 py-2 text-sm font-semibold text-white shadow-md
                      hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition hover:cursor-pointer">
          <i class="fas fa-right-to-bracket"></i> Iniciar sesión
        </button>
      </div>
    </form>

    <!-- Registro -->
    <p class="mt-8 text-center text-sm text-white">
      ¿No tienes una cuenta?
      <a href="#" id="showRegistro" class="font-semibold text-blue-500 hover:text-blue-400">Crea una ahora</a>
    </p>
  </div>

<!----------------------------------------------------------------------------REGISTRO---------------------------------------------------------------------------------------------------------->
  <!-- Registro -->
  <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/20 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40 hidden" id="registroForm">

    <!-- Fondo inferior -->
    <!-- <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div> -->

    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-blue-500">Crea tu cuenta</h2>
      <p class="mt-2 text-sm text-white">¡Únete a Academic ToDo y organiza tu vida académica!</p>
    </div>

    <form class="space-y-6" action="#" method="POST">
      <!-- Nombre -->
      <div>
        <label for="name" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-user text-white"></i>Nombre completo</label>
        <input type="text" name="name" id="name"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Correo -->
      <div>
        <label for="email" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-envelope text-white"></i>Correo electrónico</label>
        <input type="email" name="email" id="email" autocomplete="email"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Contraseña con ojito -->
      <div>
        <label for="password" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-lock text-white"></i>Contraseña</label>
        <div class="mt-2 relative">
          <input type="password" name="password" id="password" autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 pr-10 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-blue-500 hover:text-blue-400 hover:cursor-pointer z-10">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>

      <!-- Confirmar contraseña -->
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-lock text-white"></i>Confirmar contraseña</label>
        <input type="password" name="confirm_password" id="confirm_password"
              class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Botón -->
      <div>
        <button type="submit"
                class="flex w-full justify-center items-center gap-2 rounded-md bg-brand-blue px-4 py-2 text-sm font-semibold text-white shadow-md
                      hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition hover:cursor-pointer">
          <i class="fas fa-user-plus"></i> Registrarse
        </button>
      </div>
    </form>

    <!-- Enlace a login -->
    <p class="mt-8 text-center text-sm text-white">
      ¿Ya tienes una cuenta?
      <a href="#" id="showLogin" class="font-semibold text-blue-500 hover:text-blue-400">Inicia sesión</a>
    </p>
  </div>

<!----------------------------------------------------------------------------RECUPERACION------------------------------------------------------------------------------------------------------>
  <!-- Recuperar contraseña -->
  <div id="recuperacionForm" class="hidden">
    <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white/20 backdrop-blur-xl rounded-3xl shadow-xl ring-1 ring-white/40">

      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-blue-500">¿Olvidaste tu contraseña?</h2>
        <p class="mt-2 text-sm text-white">Te enviaremos un enlace para restablecerla.</p>
      </div>

      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="forgot_email" class="block text-sm font-medium text-white flex items-center gap-2"><i class="fa-solid fa-envelope text-white"></i>Correo electrónico</label>
          <input type="email" name="forgot_email" id="forgot_email" required
                class="mt-2 w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm 
                      placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
          <button type="submit"
                  class="flex w-full justify-center items-center gap-2 rounded-md bg-brand-blue px-4 py-2 text-sm font-semibold text-white shadow-md
                        hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition hover:cursor-pointer">
            <i class="fas fa-paper-plane"></i> Enviar enlace
          </button>
        </div>
      </form>

      <p class="mt-8 text-center text-sm text-gray-700">
        <a href="#" id="volverLogin" class="font-semibold text-blue-500 hover:text-blue-400">Volver al login</a>
      </p>
    </div>
  </div>


  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Custom JavaScript -->
  <script src="public/dist/js/main.js"></script>

</body>
</html>

