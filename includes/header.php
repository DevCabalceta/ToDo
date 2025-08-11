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
      --accent-color: #6366f1; /* Indigo-500 */
    }
    body {
      font-family: 'Inter', sans-serif;
    }

    .active-link {
      color: var(--accent-color);
      background-color: rgba(99, 102, 241, 0.1);
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

  </style>
  </head>

  <body class="bg-gradient-to-tr from-pink-300 via-white to-indigo-300 min-h-screen">

  

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
      <aside id="sidebar" class="sidebar-width fixed top-0 left-0 h-full bg-white/70 shadow transition-sidebar z-20 md:translate-x-0 mobile-sidebar-closed sidebar-expanded">
        <div class="flex flex-col h-full">
          <!-- Logo y Botón -->
          <div class="flex items-center justify-between p-5 border-b border-gray-200">
            <a href="#" class="flex items-center space-x-2">
              <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" class="h-8" alt="Logo">
              <span class="font-medium text-lg hide-when-collapsed">Academic ToDo</span>
            </a>
            <button id="toggle-sidebar" class="hidden md:flex items-center justify-center w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full text-gray-500">
              <i id="toggle-icon" class="fas fa-chevron-left text-sm"></i>
            </button>
          </div>

          <?php $activePage = basename($_SERVER['PHP_SELF']); ?>

          <!-- Navigation -->
          <nav class="flex-1 overflow-y-auto">
            <div class="p-4">
              <h5 class="text-xs font-semibold text-gray-500 uppercase mb-2 hide-when-collapsed">Navegación</h5>
              <a href="escritorio.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-indigo-600 text-gray-700 mb-2 <?= ($activePage == 'escritorio.php') ? 'active-link' : '' ?>">
                <i class="fas fa-house w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Dashboard</span>
              </a>
              <a href="tareas.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-indigo-600 text-gray-700 mb-2 <?= ($activePage == 'tareas.php') ? 'active-link' : '' ?>">
                <i class="fas fa-list-check w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Tareas</span>
              </a>
              <a href="calendario.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-indigo-600 text-gray-700 <?= ($activePage == 'calendario.php') ? 'active-link' : '' ?>">
                <i class="fas fa-calendar-days w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Calendario</span>
              </a>
            </div>

            <!-- Ajustes -->
            <div class="p-4 border-t border-gray-200">
              <h5 class="text-xs font-semibold text-gray-500 uppercase mb-2 hide-when-collapsed">Ajustes</h5>
              <a href="ajustes.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-indigo-600 text-gray-700 mb-2 <?= ($activePage == 'ajustes.php') ? 'active-link' : '' ?>">
                <i class="fas fa-gear w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Configuración</span>
              </a>
              <a id="logoutLink" href="api/auth/logout.php" class="flex center-when-collapsed items-center px-4 py-2 rounded hover:bg-gray-100 hover:text-indigo-600 text-gray-700">
                <i class="fas fa-arrow-right-from-bracket w-5 text-center"></i>
                <span class="ml-3 hide-when-collapsed">Cerrar sesión</span>
              </a>
            </div>
          </nav>
        </div>
      </aside>



