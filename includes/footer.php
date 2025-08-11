  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="dist/js/main.js"></script>

  <script>
      // Confirmación al cerrar sesión (con id)
      $(document).on('click', '#logoutLink', function (e) {
        e.preventDefault();
        const href = this.href;

        if (typeof Swal === 'undefined') {
          if (confirm('¿Cerrar sesión?')) window.location.href = href;
          return;
        }

        Swal.fire({
          title: '¿Cerrar sesión?',
          text: 'Se cerrará tu sesión actual.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, cerrar',
          cancelButtonText: 'Cancelar'
        }).then(r => {
          if (r.isConfirmed) window.location.href = href;
        });
      });
  </script>
</body>
</html>