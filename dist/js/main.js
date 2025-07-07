$(document).ready(function () {

  /*********************************************togglePassword***********************************************/
  $(document).on('click', "#togglePassword" ,function () {
    const input = $('#password');
    const icon = $('#eyeIcon');
    const type = input.attr('type') === 'password' ? 'text' : 'password';
    input.attr('type', type);

    // Cambiar ícono
    if (type === 'text') {
      icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });
  /*********************************************FIN togglePassword*******************************************/

  /*********************************************showRegistro*************************************************/
  $(document).on('click', "#showRegistro" ,function (){
    $('#loginForm').fadeOut(200);
    $('#loginForm').addClass('hidden');

    $('#registroForm').removeClass('hidden');
    $('#registroForm').hide().fadeIn(200);
  });
  /*********************************************FIN showRegistro*********************************************/

  /*********************************************showLogin****************************************************/
  $(document).on('click', "#showLogin" ,function (){
    $('#registroForm').fadeOut(200);
    $('#registroForm').addClass('hidden');

    $('#loginForm').removeClass('hidden');
    $('#loginForm').hide().fadeIn(200);
  });
  /*********************************************FIN showLogin************************************************/

  /*********************************************showForgot***************************************************/
  $(document).on('click', "#showForgot" ,function () {
    $('#loginForm').fadeOut(200);
    $('#loginForm').addClass('hidden');

    $('#recuperacionForm').removeClass('hidden');
    $('#recuperacionForm').hide().fadeIn(200);
  });
  /*********************************************FIN showForgot***********************************************/

  /*********************************************volverLogin**************************************************/
  $(document).on('click', "#volverLogin" ,function () {
    $('#recuperacionForm').fadeOut(200);
    $('#recuperacionForm').addClass('hidden');

    $('#loginForm').removeClass('hidden');
    $('#loginForm').hide().fadeIn(200);
  });
  /*********************************************FIN volverLogin**********************************************/

  /*********************************************loginRedirect************************************************/
  $(document).on('click', '#loginBtn', function () {
    window.location.href = 'escritorio.php';
  });
  /*********************************************FIN loginRedirect********************************************/

  /*********************************************toggleSidebarDesktop*****************************************/
  $(document).on('click', '#toggle-sidebar', function () {
    const $sidebar = $('#sidebar');
    const $icon = $('#toggle-icon');
    const $main = $('#mainContent');

    // Alternar clases para colapsar/expandir sidebar
    $sidebar.toggleClass('sidebar-expanded sidebar-collapsed');
    $sidebar.toggleClass('sidebar-width sidebar-collapsed-width');

    // Ajustar margen del main en desktop
    if ($sidebar.hasClass('sidebar-collapsed')) {
      $main.removeClass('main-expanded').addClass('main-collapsed');
      $icon.removeClass('fa-chevron-left').addClass('fa-chevron-right');
    } else {
      $main.removeClass('main-collapsed').addClass('main-expanded');
      $icon.removeClass('fa-chevron-right').addClass('fa-chevron-left');
    }
  });
  /*********************************************FIN toggleSidebarDesktop*************************************/

  /*********************************************toggleSidebarMobile******************************************/
  $(document).on('click', '#mobile-toggle', function () {
    const $sidebar = $('#sidebar');
    $sidebar.toggleClass('mobile-sidebar-open mobile-sidebar-closed');
  });
  /*********************************************FIN toggleSidebarMobile**************************************/

});