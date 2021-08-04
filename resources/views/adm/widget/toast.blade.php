@if(Session::get('success'))
          <script>
            $(function() {
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
            });
            toastr.success(`{{ Session::get('success')}}`);
          </script>
    @endif

    @if(Session::get('fail'))

    <script>
            $(function() {
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
            });
            toastr.success(`{{Session::get('fail')}}`);
          </script>

    @endif
