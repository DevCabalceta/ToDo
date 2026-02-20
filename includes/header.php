<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: ./login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg+xml" href="https://tailwindcss.com/favicons/favicon-32x32.png">
  <title>Dashboard ToDo</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <!-- Fuente Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --accent-color: #0099ff; /* Indigo-500 */
    }
    body {
      font-family: 'Inter', sans-serif;
    }

    .active-link {
      color: #006eff !important; 
      background-color: rgba(255, 255, 255, 0.87);
    }

    .sidebar-width {
      width: 280px;
      min-width: 280px;
    }

    .sidebar-collapsed-width {
      width: 70px;
      min-width: 70px;
    }

    .transition-sidebar {
      transition: all 0.3s ease;
    }

    .sidebar-expanded .hide-when-collapsed {
      display: inline;
    }

    .sidebar-collapsed .hide-when-collapsed {
      display: none;
    }

    .sidebar-collapsed .center-when-collapsed {
      justify-content: center;
    }

    .sidebar-expanded .center-when-collapsed {
      justify-content: flex-start;
    }

    @media (max-width: 768px) {
      .mobile-sidebar-open {
        transform: translateX(0);
      }

      .mobile-sidebar-closed {
        transform: translateX(-100%);
      }
    }
  
    @media (min-width: 768px) {
      .main-expanded {
        margin-left: 280px;
      }
      .main-collapsed {
        margin-left: 70px;
      }
    }

    @media (max-width: 767px) {
      .main-expanded,
      .main-collapsed {
        margin-left: 0;
      }
    }

    .sortable-chosen {
      outline: 2px solid #6366f1; /* Indigo-500 */
      border-radius: 0.5rem;
    }

      aside, body {
        background-image: url(./dist/bg/bg.avif);
        background-position: 0 0;
        background-repeat: repeat-y;
        background-size: auto;
    }

    .bg-brand-black {
        background-color: #020617;
    }

    .bg-brand-main {
        background-color: #ebebf7;
    }

    .wall {
    background-color: hsla(220.9090909090909, 30%, 14%, 1);
    background-image: radial-gradient(circle at 0% 5%, hsla(225.00000000000003, 56%, 60%, 0.7) 3.1210986267166043%, transparent 40%), radial-gradient(circle at 23% 3%, hsla(210.4411764705882, 96%, 48%, 0.37) 3.1210986267166043%, transparent 76.4190383017679%), radial-gradient(circle at 100% 93%, hsla(186.61764705882354, 70%, 55%, 0.21) 3.1210986267166043%, transparent 45.38487571252063%), radial-gradient(circle at 96% 103%, hsla(120.44117647058823, 76%, 39%, 0.1) 3.1210986267166043%, transparent 50.0047517726123%), radial-gradient(circle at 80% 0%, hsla(158.82352941176472, 80%, 48%, 0.23) 3.1210986267166043%, transparent 24.819747276612727%);
    background-blend-mode: normal, normal, normal, normal, normal;
    }
  </style>
  </head>

  <body class="bg-brand-main min-h-screen">

    <!-- Mobile Top Bar -->
    <div class="md:hidden flex items-center justify-between p-4 bg-white shadow fixed w-full z-30">
      <button id="mobile-toggle" class="text-gray-600">
        <i class="fas fa-bars text-xl"></i>
      </button>
      <div class="font-semibold text-lg">ToDo</div>
      <div class="w-8"></div>
    </div>

    <div class="flex pt-16 md:pt-0 transition-all duration-300">
      <!-- Sidebar -->
      <aside id="sidebar" class="sidebar-width fixed top-0 left-0 h-full bg-brand-black shadow transition-sidebar z-20 md:translate-x-0 mobile-sidebar-closed sidebar-expanded">
        <div class="flex flex-col h-full">
          <!-- Logo y Botón -->
          <div class="flex items-center justify-between p-5 border-b border-gray-500">
            <a href="#" class="flex items-center space-x-2">
              <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=blue&shade=500" class="h-8" alt="Logo">
              <span class="font-medium text-lg hide-when-collapsed text-white">Academic ToDo</span>
            </a>
            <button id="toggle-sidebar" class="hidden md:flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-400 rounded-full text-gray-500">
              <i id="toggle-icon" class="fas fa-chevron-left text-sm text-white"></i>
            </button>
          </div>

          <?php $activePage = basename($_SERVER['PHP_SELF']); ?>

          <!-- Navigation -->
          <nav class="flex-1 overflow-y-auto">
            <div class="p-4">
              <h5 class="text-xs font-semibold text-gray-400 uppercase mb-2 hide-when-collapsed">Navegación</h5>
              <a href="escritorio" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-blue-500 text-gray-200 mb-2 <?= ($activePage == 'escritorio.php') ? 'active-link' : '' ?>">
                <i class="fas fa-house w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Dashboard</span>
              </a>
              <a href="tareas" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-blue-500 text-gray-200 mb-2 <?= ($activePage == 'tareas.php') ? 'active-link' : '' ?>">
                <i class="fas fa-list-check w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Tareas</span>
              </a>
              <a href="calendario" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-blue-500 text-gray-200 <?= ($activePage == 'calendario.php') ? 'active-link' : '' ?>">
                <i class="fas fa-calendar-days w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Calendario</span>
              </a>
            </div>

            <!-- Ajustes -->
            <div class="p-4 border-t border-gray-500">
              <h5 class="text-xs font-semibold text-gray-400 uppercase mb-2 hide-when-collapsed">Ajustes</h5>
              <a href="ajustes" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-blue-500 text-gray-200 mb-2 <?= ($activePage == 'ajustes.php') ? 'active-link' : '' ?>">
                <i class="fas fa-gear w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Configuración</span>
              </a>
              <a id="logoutLink" href="api/auth/logout.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-blue-500 text-gray-200">
                <i class="fas fa-arrow-right-from-bracket w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Cerrar sesión</span>
              </a>
            </div>
          </nav>
        </div>
      </aside>



