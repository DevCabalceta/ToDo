// dist/js/main.js
$(document).ready(function () {

  /*********************************************togglePassword***********************************************
   * Soporta múltiples inputs con el mismo ID dentro de diferentes formularios (login/registro).
   * Busca el input y el ícono relativos al botón presionado.
   *********************************************************************************************************/
  $(document).on('click', "#togglePassword", function () {
    const $wrap = $(this).closest('.relative');        // contenedor del input + botón
    const $input = $wrap.find('input[type="password"], input[type="text"]').first();
    const $icon  = $wrap.find('#eyeIcon');             // ícono dentro del mismo bloque

    const isHidden = $input.attr('type') === 'password';
    $input.attr('type', isHidden ? 'text' : 'password');

    if (isHidden) {
      $icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      $icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });
  /*********************************************FIN togglePassword*******************************************/

  /*********************************************showRegistro*************************************************/
  $(document).on('click', "#showRegistro", function (){
    $('#loginForm').fadeOut(200, function () {
      $(this).addClass('hidden');
      $('#registroForm').removeClass('hidden').hide().fadeIn(200);
    });
  });
  /*********************************************FIN showRegistro*********************************************/

  /*********************************************showLogin****************************************************/
  $(document).on('click', "#showLogin", function (){
    $('#registroForm').fadeOut(200, function () {
      $(this).addClass('hidden');
      $('#loginForm').removeClass('hidden').hide().fadeIn(200);
    });
  });
  /*********************************************FIN showLogin************************************************/

  /*********************************************showForgot***************************************************/
  $(document).on('click', "#showForgot", function () {
    $('#loginForm').fadeOut(200, function () {
      $(this).addClass('hidden');
      $('#recuperacionForm').removeClass('hidden').hide().fadeIn(200);
    });
  });
  /*********************************************FIN showForgot***********************************************/

  /*********************************************volverLogin**************************************************/
  $(document).on('click', "#volverLogin", function () {
    $('#recuperacionForm').fadeOut(200, function () {
      $(this).addClass('hidden');
      $('#loginForm').removeClass('hidden').hide().fadeIn(200);
    });
  });
  /*********************************************FIN volverLogin**********************************************/

  /*********************************************LOGIN (AJAX + SweetAlert2)***********************************
   * Reemplaza cualquier redirección "en duro". Maneja errores con Swal.
   *********************************************************************************************************/
  $(document).off('submit', '#loginForm form').on('submit', '#loginForm form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const $btn  = $('#loginBtn');
    const formData = {
      email:    $form.find('input[name="email"]').val().trim(),
      password: $form.find('input[name="password"]').val().trim()
    };

    if (!formData.email || !formData.password) {
      Swal.fire({ icon: 'warning', title: 'Campos requeridos', text: 'Completa tu correo y contraseña.' });
      return;
    }

    $btn.prop('disabled', true).addClass('opacity-70');

    Swal.fire({
      title: 'Iniciando sesión...',
      didOpen: () => Swal.showLoading(),
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false
    });

    $.ajax({
      url: 'api/auth/login.php',
      method: 'POST',
      data: formData,
      dataType: 'json'
    })
    .done(function (res) {
      if (res.ok) {
        setTimeout(() => window.location.href = res.redirect || 'escritorio.php', 900);
      } else {
        Swal.fire({ icon: 'error', title: 'No se pudo iniciar sesión', text: res.message || 'Credenciales inválidas.' });
      }
    })
    .fail(function () {
      Swal.fire({ icon: 'error', title: 'Error de red', text: 'Verifica tu conexión e intenta de nuevo.' });
    })
  // .fail(function (jqXHR, textStatus, errorThrown) {
  //   let msg = 'Error de red';
  //   if (textStatus === 'parsererror') {
  //     msg = 'La respuesta no es JSON válido.';
  //   } else if (jqXHR.status) {
  //     msg = `HTTP ${jqXHR.status} - ${errorThrown || 'Error'}`;
  //   }
  //   const server = jqXHR.responseText ? `\n\nServidor:\n${jqXHR.responseText}` : '';
  //   Swal.fire({ icon: 'error', title: 'Ups', text: msg + server });
  // })
    .always(function () {
      $btn.prop('disabled', false).removeClass('opacity-70');
    });
  });
  /*********************************************FIN LOGIN (AJAX + Swal)**************************************/

  /*********************************************REGISTRO (AJAX + SweetAlert2)********************************
   * Crea la cuenta y redirige si todo sale bien. Muestra errores específicos.
   *********************************************************************************************************/
  $(document).off('submit', '#registroForm form').on('submit', '#registroForm form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const $btn  = $form.find('button[type="submit"]');
    const formData = {
      name:             $form.find('input[name="name"]').val().trim(),
      email:            $form.find('input[name="email"]').val().trim(),
      password:         $form.find('input[name="password"]').val().trim(),
      confirm_password: $form.find('input[name="confirm_password"]').val().trim()
    };

    if (!formData.name || !formData.email || !formData.password || !formData.confirm_password) {
      Swal.fire({ icon: 'warning', title: 'Campos incompletos', text: 'Por favor, completa todos los campos.' });
      return;
    }

    $btn.prop('disabled', true).addClass('opacity-70');

    Swal.fire({
      title: 'Creando tu cuenta...',
      didOpen: () => Swal.showLoading(),
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false
    });

    $.ajax({
      url: 'api/auth/register.php',
      method: 'POST',
      data: formData,
      dataType: 'json'
    })
    .done(function (res) {
      if (res.ok) {
        Swal.fire({ icon: 'success', title: '¡Cuenta creada!', text: res.message, timer: 1500, showConfirmButton: false });
        setTimeout(() => window.location.href = res.redirect || 'login.php', 1400);
      } else {
        let msg = res.message || 'No se pudo registrar.';
        if (res.errors && res.errors.email) msg = res.errors.email;
        if (res.errors && res.errors.password) msg = res.errors.password;
        if (res.errors && res.errors.confirm_password) msg = res.errors.confirm_password;
        if (res.errors && res.errors.name) msg = res.errors.name;

        Swal.fire({ icon: 'warning', title: 'Atención', text: msg });
      }
    })
    .fail(function () {
      Swal.fire({ icon: 'error', title: 'Error de red', text: 'Intenta nuevamente.' });
    })
    // .fail(function (jqXHR, textStatus, errorThrown) {
    //   let msg = 'Error de red';
    //   if (textStatus === 'parsererror') {
    //     msg = 'La respuesta no es JSON válido.';
    //   } else if (jqXHR.status) {
    //     msg = `HTTP ${jqXHR.status} - ${errorThrown || 'Error'}`;
    //   }
    //   const server = jqXHR.responseText ? `\n\nServidor:\n${jqXHR.responseText}` : '';
    //   Swal.fire({ icon: 'error', title: 'Ups', text: msg + server });
    // })
    .always(function () {
      $btn.prop('disabled', false).removeClass('opacity-70');
    });
  });
  /*********************************************FIN REGISTRO (AJAX + Swal)**********************************/

  /*********************************************toggleSidebarDesktop*****************************************
   * Dejas tu lógica de sidebar tal cual.
   *********************************************************************************************************/
  $(document).on('click', '#toggle-sidebar', function () {
    const $sidebar = $('#sidebar');
    const $icon = $('#toggle-icon');
    const $main = $('#mainContent');

    $sidebar.toggleClass('sidebar-expanded sidebar-collapsed');
    $sidebar.toggleClass('sidebar-width sidebar-collapsed-width');

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
