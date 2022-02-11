<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
 
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <link rel="stylesheet" href="{{url('adm')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adm')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('adm')}}/plugins/summernote/summernote-bs4.min.css">

	<link rel="stylesheet" href="{{url('adm')}}/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="{{url('adm')}}/dist/css/custom.css">
  
<link rel="shortcut icon" href="{{asset('adm')}}/img/task-favicon.png" type="image/x-icon">

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;600&family=Hind+Vadodara:wght@300&family=Kumar+One+Outline&family=Rasa:wght@300;400;700&display=swap" rel="stylesheet"> 


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('adm.ext.header')
            @include('adm.ext.sidebar')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{url('adm')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>
                <div id="calendar"></div>
        </div>
    </section>
</div>

@include('adm.ext.footer')
</div>

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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>

<script src="{{asset('adm')}}/plugins/chart.js/Chart.min.js"></script>

<script src="{{asset('adm')}}/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="{{asset('adm')}}/plugins/toastr/toastr.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<!-- treeview -->
<script type="text/javascript" src="{{url('mdbootstrap')}}/js/mdb.min.js"></script>

<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script src="{{asset('adm')}}/plugins/select2/js/select2.full.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="{{asset('adm')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="{{url('full-calendar-year')}}/fullcalendar.css" />
  
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/af.js"></script-->

  <style>
  .ui-dialog.ui-corner-all.ui-widget {
    z-index: 9999 !important;
}
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

  <script src="{{url('full-calendar-year')}}/fullcalendar.js"></script>
   
  <!-- <script src="{{url('full-calendar-year')}}/script.js"></script> -->
  

@section('toast')
    @include('adm.widget.toast')
@endsection

@yield('custom-js')

<div class="container">

<div id="calendar"></div>

<div id="dialog" style="display:none;
    z-index: 9999;"  title="Basic dialog">
    <div id="dialog-body">
        <form id="dayClick" method="post" action="{{route('eventStore')}}">
            @csrf

            <div class="form-group">
                <label for="">Event Title</label>
                <input type="text" name="title" placeholder="Event Title" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Start Date / Time</label>
                <input type="text" id="start"
                name="start" placeholder="Start Date & Time" class="form-control">
            </div>

            <div class="form-group">
                <label for="">End Date / Time</label>
                <input type="text" name="end" id="end" placeholder="End Date & Time" class="form-control">
            </div>
          
              <div class="form-group">
                  <label for="">All Day</label>
                  <input type="checkbox" value="1" name="allDay"> All Day
                  <input type="checkbox" value="0" name="allDay"> Partial
              </div>

              <div class="row">
                <div class="col-sm-6">
                    <label for="">Background Color</label>
                    <input type="color" name="color" class="form-control">
                </div>

              <div class="col-sm-6">
                  <label for="">Text Color</label>
                  <input type="color" name="textColor" class="form-control">
              </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Add Event</button>
            </div>

        </form>
    </div>
</div>
</div>

<!-- End Day click dialoug -->

<script>
    // Code goes here
$(document).ready(function() {

  function convertStart(str){
  const d = new Date(str);
  // alert(d.getMonth() + 1);   

  let month = '' + (d.getMonth() + 1);
  let day = '' + d.getDate();
  let year = '' + d.getFullYear();
  
  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;
  

  let hour = '' + d.getUTCHours();
  let minutes = '' + d.getUTCMinutes();
  let seconds = '' + d.getUTCSeconds();

  if(hour.length < 2) hour = '0' + hour;
  if(minutes.length < 2) minutes = '0' + minutes;
  if(seconds.length < 2) seconds = '0' + seconds;

  return [year, month, day].join('-')+' '+[hour, minutes, seconds].join(':') ;
};

function convertEnd(str){
  const d = new Date(str);
  // alert(d.getMonth() + 1);   

  // alert('ss');

  let month = '' + (d.getMonth() + 1);
  let day = '' + d.getDate();
  let year = '' + d.getFullYear();
  
  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;
  
  let hour = '' + d.getUTCHours();
  let minutes = '' + d.getUTCMinutes();
  let seconds = '' + d.getUTCSeconds();

  if(hour.length < 2) hour = '0' + hour;
  if(minutes.length < 2) minutes = '0' + minutes;
  if(seconds.length < 2) seconds = '0' + seconds;

  return [year, month, day].join('-')+' '+[hour, minutes, seconds].join(':') ;
};

// page is now ready, initialize the calendar...

var calendar = $('#calendar').fullCalendar({
  // put your options and callbacks here
  header: {
    left: 'prev,next today',
    center: 'title',
    // right: 'year,month,basicWeek,basicDay'
    right: 'year,month,agendaWeek,agendaDay'
  },
  dayClick:function(date, event, view){
    $('#start').val(convert(date));
    // $('#end').val(convert(date));
    $('#dialog').dialog({ 
        title: 'Add Event',
        width: 600,
        height: 550,
        modal:true,
        show:{effect:'clip', duration: 350},
        hide: {effect:'clip', duration: 350}
    });


    convertEnd(date);
  },
  select:function(start, end){


    $('#start').val(convertStart(start));
    $('#end').val(convertEnd(start));
    $('#dialog').dialog({ 
        title: 'Add Event',
        width: 600,
        height: 550,
        modal:true,
        show:{effect:'clip', duration: 350},
        hide: {effect:'clip', duration: 350}
    });
  },

  timezone: 'local',
  height: "auto",
  selectable: true,
  dragabble: true,
  defaultView: 'month',
  yearColumns: 2,

  durationEditable: true,
  bootstrap: false,

  events: [{
    title: "Some event",
    start: new Date('2017-1-10'),
    end: new Date('2017-1-20'),
    id: 1,
    allDay: false,
    editable: true,
    eventDurationEditable: true,
  }, ],
  
})
});
</script>  

</body>
</html>
