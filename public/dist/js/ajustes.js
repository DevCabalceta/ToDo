// dist/js/ajustes.js
$(document).ready(function () {
  /*************** Toggle ver/ocultar contraseña ***************/
  $(document).on('click', '.toggle-visibility', function () {
    const target = $(this).data('target');
    const $input = $(target);
    if (!$input.length) return;
    const isPass = $input.attr('type') === 'password';
    $input.attr('type', isPass ? 'text' : 'password');
    $(this).find('i').toggleClass('fa-eye fa-eye-slash');
  });

  /*************** Medidor fuerza ***************/
  const $newPass = $('#aj_pass_nueva');
  const $bar = $('#aj_strength_bar');
  const $txt = $('#aj_strength_text');

  function computeStrength(pw) {
    let s = 0;
    if (pw.length >= 6) s++;
    if (/[A-Z]/.test(pw)) s++;
    if (/[a-z]/.test(pw)) s++;
    if (/\d/.test(pw)) s++;
    if (/[^A-Za-z0-9]/.test(pw)) s++;
    return Math.min(s, 5);
  }
  function renderStrength(score) {
    const pct = [0, 25, 40, 60, 80, 100][score];
    const colors = ['bg-red-500','bg-orange-500','bg-yellow-500','bg-lime-500','bg-green-500'];
    $bar.removeClass(colors.join(' '));
    if (score > 0) $bar.addClass(colors[score-1]);
    $bar.css('width', pct + '%');
    const labels = ['Muy débil','Débil','Regular','Buena','Fuerte'];
    $txt.text(score === 0 ? 'Seguridad: —' : 'Seguridad: ' + labels[score-1]);
  }
  $newPass.on('input', function(){ renderStrength(computeStrength($(this).val())); });

  /*************** Guardar Perfil (AJAX) ***************/
  $('#btnGuardarPerfil').on('click', function () {
    const nombre = $('#aj_nombre').val().trim();
    const email  = $('#aj_email').val().trim();
    if (!nombre || !email) {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'warning', title:'Campos incompletos', text:'Completa nombre y correo.' });
      return;
    }
    $.ajax({
      url: 'api/settings/profile.php',
      method: 'POST',
      dataType: 'json',
      data: { nombre, email }
    })
    .done(res => {
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se pudo actualizar el perfil.' });
        return;
      }
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'success', title:'Perfil actualizado', timer: 1200, showConfirmButton:false });
    })
    .fail(jq => {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jq.status}` });
    });
  });

  /*************** Guardar Notificaciones (AJAX) ***************/
  $('#btnGuardarNotificaciones').on('click', function () {
    const enabled = $('#aj_notificaciones').is(':checked') ? 1 : 0;
    $.ajax({
      url: 'api/settings/notifications.php',
      method: 'POST',
      dataType: 'json',
      data: { enabled }
    })
    .done(res => {
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error', text: res.message || 'No se guardó la preferencia.' });
        return;
      }
      const msg = res.enabled ? 'Notificaciones activadas' : 'Notificaciones desactivadas';
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'success', title:'Guardado', text: msg, timer: 1100, showConfirmButton:false });
    })
    .fail(jq => {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jq.status}` });
    });
  });

  /*************** Cambiar contraseña (AJAX) ***************/
  $('#btnCambiarPassword').on('click', function () {
    const pass_actual = $('#aj_pass_actual').val().trim();
    const pass_nueva  = $('#aj_pass_nueva').val().trim();
    const pass_confirm= $('#aj_pass_confirm').val().trim();

    if (!pass_actual || !pass_nueva || !pass_confirm) {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'warning', title:'Campos incompletos', text:'Rellena las tres contraseñas.' });
      return;
    }

    $.ajax({
      url: 'api/settings/password.php',
      method: 'POST',
      dataType: 'json',
      data: { pass_actual, pass_nueva, pass_confirm }
    })
    .done(res => {
      if (!res.ok) {
        if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'No se actualizó', text: res.message || 'Error al cambiar la contraseña.' });
        return;
      }
      // Limpiar campos y medidor
      $('#aj_pass_actual, #aj_pass_nueva, #aj_pass_confirm').val('');
      renderStrength(0);
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'success', title:'Contraseña actualizada', timer: 1200, showConfirmButton:false });
    })
    .fail(jq => {
      if (typeof Swal !== 'undefined') Swal.fire({ icon:'error', title:'Error de red', text:`HTTP ${jq.status}` });
    });
  });
});
