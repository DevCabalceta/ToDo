<?php 
    include_once('includes/headerinicio.php');
?>


    <div class="relative isolate px-6 pt-14 lg:px-8">
        <!-- Fondo visual -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>

        <!-- Hero principal -->
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 text-center">
        <h1 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-7xl">
            Organiza tu vida académica <span id="typed-text" class="text-indigo-600"></span>
        </h1>

        <p class="mt-8 text-lg leading-8 text-gray-600 sm:text-xl">
            Academic ToDo es tu asistente estudiantil personal. Gestiona materias, tareas, apuntes y calificaciones desde una sola plataforma, con recordatorios automáticos y estadísticas visuales.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="login.php" class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear cuenta</a>
            <a href="#funciones" class="text-sm font-semibold text-gray-900">Ver funciones <span aria-hidden="true">→</span></a>
        </div>
        </div>

        <!-- Fondo inferior -->
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>

    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="relative isolate overflow-hidden bg-gray-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
            
            <!-- Fondo animado -->
            <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-256 -translate-y-1/2 mask-[radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0" aria-hidden="true">
                <circle cx="512" cy="512" r="512" fill="url(#gradient-todo)" fill-opacity="0.7" />
                <defs>
                <radialGradient id="gradient-todo">
                    <stop stop-color="#6366f1" /> <!-- Indigo-500 -->
                    <stop offset="1" stop-color="#ec4899" /> <!-- Pink-500 -->
                </radialGradient>
                </defs>
            </svg>

            <!-- Texto -->
            <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                Potencia tu organización académica
                </h2>
                <p class="mt-6 text-lg text-gray-300">
                Administra tus materias, tareas, notas y calificaciones desde un solo lugar. Academic ToDo es tu asistente personal para alcanzar el éxito estudiantil con menos estrés.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                <a href="login.php" class="rounded-md bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow hover:bg-gray-100">
                    ¡Comienza ahora!
                </a>
                <a href="#funciones" class="text-sm font-semibold text-white hover:text-gray-100">
                    Ver funciones <span aria-hidden="true">→</span>
                </a>
                </div>
            </div>

            <!-- Imagen del sistema -->
            <div class="relative mt-16 h-80 lg:mt-8">
                <img class="absolute top-0 left-0 w-[38rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                    src="assets/images/todo.png"
                    alt="Captura del sistema"
                    width="1824" height="1080" />
            </div>
            </div>
        </div>
    </div>

    <div id="funciones">
        <div class="container mx-auto px-4 pb-14 relative isolate">

            <!-- Fondo visual -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            
            <div class="max-w-2xl mx-auto text-center">
                <span class="text-sm text-indigo-600 uppercase font-semibold tracking-wider">Funciones Principales</span>
                <h2 class="text-3xl md:text-4xl/tight font-semibold text-gray-900 mt-4">Todo lo que necesitas para organizar tu vida académica</h2>
                <p class="text-base font-medium mt-4 text-gray-600">Administra tus materias, tareas, apuntes y notas con una sola plataforma moderna y práctica.</p>
            </div>

            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-x-3 gap-y-6 md:gap-y-12 lg:gap-y-20 md:pt-20 pt-12">
            
                <!-- Materias -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-book text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Gestión de materias</h3>
                    <p class="text-base text-gray-600 mt-2">Agrupa tus materias por periodo académico y asígnales íconos o colores.</p>
                </div>

                <!-- Tareas -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-clipboard-check text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Tareas y exámenes</h3>
                    <p class="text-base text-gray-600 mt-2">Crea tareas, asigna fechas y prioridades, y controla el estado de entrega.</p>
                </div>

                <!-- Apuntes -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-pen-nib text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Toma de apuntes</h3>
                    <p class="text-base text-gray-600 mt-2">Escribe y guarda notas rápidas organizadas por cada materia.</p>
                </div>

                <!-- Calificaciones -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-chart-column text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Control de notas</h3>
                    <p class="text-base text-gray-600 mt-2">Lleva un promedio por materia y visualiza tu rendimiento en gráficos.</p>
                </div>

                <!-- Notificaciones -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-bell text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Notificaciones</h3>
                    <p class="text-base text-gray-600 mt-2">Recibe alertas por correo antes de cada entrega o evaluación.</p>
                </div>

                <!-- Dashboard -->
                <div class="text-center">
                    <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center bg-indigo-100 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border border-indigo-300">
                        <i class="fa-solid fa-gauge-high text-indigo-600 text-2xl"></i>
                    </div>
                    </div>
                    <h3 class="text-xl font-semibold pt-4 text-gray-800">Dashboard visual</h3>
                    <p class="text-base text-gray-600 mt-2">Accede a un panel con estadísticas, historial y acceso a todo el sistema.</p>
                </div>

            </div>

            <!-- Fondo inferior -->
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>

        </div>
    </div>

<?php 
    include_once('includes/footerinicio.php');
?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    new Typed("#typed-text", {
      strings: ["sin estrés", "sin caos", "con claridad"],
      typeSpeed: 60,
      backSpeed: 30,
      backDelay: 2000,
      startDelay: 500,
      loop: true,
      showCursor: true,
      cursorChar: '|'
    });
  });
</script>
