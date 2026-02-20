<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Si tu app está en /ToDo, usa esta base web -->
    <base href="/ToDo/">
    <title>Academic ToDo</title>
    <link rel="icon" type="image/svg+xml" href="https://tailwindcss.com/favicons/favicon-32x32.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
    <!-- AOS Animate On Scroll CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/dist/css/main.css">


</head>

<body class="bg-brand-black bg-repeat text-white overflow-x-hidden font-sans">

    <header id="mainHeader" class="w-full overflow-visible z-[99999] fixed top-0 left-0 right-0 transition-all duration-300 backdrop-blur-lg bg-transparent mb-10">
        <div class="grid items-center justify-center md:justify-normal w-full grid-cols-[auto_1fr] mx-auto text-white gap-x-10 md:flex max-w-screen-full py-4">

            <div class="md:flex-grow md:basis-0 flex justify-start">
                <a href="./home" class="ml-4 flex items-center gap-2.5 font-bold transition-transform duration-300 hover:scale-110">
                <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=blue&shade=500" width="228" height="198" alt="Logo">
                <span class="hidden lg:block text-[32px] tracking-wide">Academic ToDo</span>
                </a>
            </div>

            <nav class="col-span-full overflow-x-auto row-[2/3] grid grid-rows-[0fr] transition-[grid-template-rows] data-[open]:grid-rows-[1fr] md:justify-center md:flex group/nav" aria-label="Global">
                <ul class="flex flex-col items-center overflow-x-hidden overflow-y-hidden md:flex-row gap-x-2">
                    <li class="flex justify-center w-full first:mt-5 md:first:mt-0 md:block md:w-auto">
                        <a href="./home" class="flex items-center md:w-auto justify-center gap-2 md:px-4 md:py-2 hover:text-blue-400 md:rounded-2xl border border-transparent transition-all min-h-[50px] md:text-base px-5 py-4 text-xl duration-300 w-full">Inicio</a>
                    </li>
                    <li class="flex justify-center w-full first:mt-5 md:first:mt-0 md:block md:w-auto">
                        <a href="./home#funciones" class="flex items-center md:w-auto justify-center gap-2 md:px-4 md:py-2 hover:text-blue-400 md:rounded-2xl border border-transparent transition-all min-h-[50px] md:text-base px-5 py-4 text-xl duration-300 w-full">Funciones</a>
                    </li>
                    <li class="flex justify-center w-full first:mt-5 md:first:mt-0 md:block md:w-auto">
                        <a href="./sobrenosotros" class="flex items-center md:w-auto justify-center gap-2 md:px-4 md:py-2 hover:text-blue-400 md:rounded-2xl border border-transparent transition-all min-h-[50px] md:text-base px-5 py-4 text-xl duration-300 w-full">Sobre Nosotros</a>
                    </li>
                </ul>
            </nav>

            <div class="md:flex-grow md:basis-0 flex justify-end mr-3">
                <a href="./login" class="ml-4 flex items-center gap-2.5 font-bold ransition-transform duration-300 hover:scale-110">
                    <div class="bg-blue-500 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fa-solid fa-user text-white"></i>
                    </div>
                    <span class="hidden lg:block hover:text-blue-400">Iniciar Sesión</span>
                </a>
            </div>
        </div>

    </header>

    <script>
        const header = document.getElementById('mainHeader');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
            header.classList.add('header-scrolled');
            } else {
            header.classList.remove('header-scrolled');
            }
        });
    </script>




