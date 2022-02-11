
<!-- jQuery -->
<script src="{{asset('adm')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adm')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adm')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('adm')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('adm')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="{{asset('adm')}}/plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="{{asset('adm')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->

<!-- jQuery Knob Chart -->
<script src="{{asset('adm')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('adm')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('adm')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adm')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('adm')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adm')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('adm')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adm')}}/dist/js/demo.js"></script>
<script src="{{asset('adm')}}/dist/js/custom.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{asset('adm')}}/dist/js/pages/dashboard.js"></script> -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>

<script src="{{asset('adm')}}/plugins/chart.js/Chart.min.js"></script>

<script src="{{asset('adm')}}/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="{{asset('adm')}}/plugins/toastr/toastr.min.js"></script>

<!-- treeview -->
<script type="text/javascript" src="{{url('mdbootstrap')}}/js/mdb.min.js"></script>

<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script src="{{asset('adm')}}/plugins/select2/js/select2.full.min.js"></script>


<script>

  // Treeview Initialization
$(document).ready(function() {
  $('.treeview-colorful').mdbTreeview();

setTimeout(() => {
  
  $('.treeview-colorful .nested').css('display', 'block');
}, 100);
  
});


$(function () {
    $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    })

$(document).ready(function () {
    $('html, body').scrollTop(240);
    $(".chat-box").animate({scrollTop: $('.direct-chat').height()}, 1000);
      console.log('chat height - '+ $('.direct-chat').height());
});


</script>


<script src="{{url('mention')}}/mention.js"></script>

<script>
         var myMention = new Mention({
            input: document.querySelector('#textarea'),
            
            options: [
               { id: 2, name: 'WideEye', description: 'Wideeye Potion' },
               { id: 100, name: 'LiquidLuck', description: 'Felix Felicis' },
               { id: 10, name: 'PolyJuice', description: 'Polyjuice Potion' }
            ],

            update: function() {
               document.querySelector('#data').innerHTML = JSON.stringify(this.findMatches(), null, '\t')
            },
            match: function(word, option) {
               return option.name.startsWith(word)
                  || option.description.toLowerCase().indexOf(word.toLowerCase()) >= 0
            },
            template: function(option) {
               return '@' + option.name + ' [' + option.description + ']'
            }
         })




      </script>