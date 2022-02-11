
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/style.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="{{url('home')}}/css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="{{url('mention')}}/mention.css">
	<style>
         html, body{
            padding:0px;
            margin:0px;
            background:#222;
            font-family: 'Karla', sans-serif;
            color:#FFF;
         }
         h3{ text-align:center; }
         .demo{
            display:flex;
            max-width:600px;
            margin:0px auto;
         }

         #optionsZone {
            position:relative;
            top:0px;
         }

         #data {
            background:transparent;
            border:none;
            display:block;
            width:100%;
            height:400px;
            color:#FFF;
            flex:1;
            padding:20px;
            overflow:auto;
            white-space:nowrap;
            tab-size: 16px;
            flex:1;
            padding:10px;
				margin:0px;

         }
         .mention-wrapper {
            width:50%;
         }
         #textarea{
            border-radius:4px;
            height:100px;
            flex:1;
            box-sizing:border-box;
            background:#FFF;
            display:block;
            margin:0;
            resize:none;
            padding:10px;
            outline:none;
            color:#333;
            font-size:16px;
				font-family: 'Karla', sans-serif;
            border:3px solid transparent;
            font-weight:400;

         }
         #textarea:focus{
            border:3px solid #999;
         }

         .mention-options {
            border:3px solid #999;
            margin-top:-3px;
         }

         .mention-option {
            padding:5px 10px;
         }
      </style>
	  
	<!-- treeview -->

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<link rel="stylesheet" href="{{url('mdbootstrap')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url('mdbootstrap')}}/css/mdb.min.css">

	<link rel="stylesheet" href="{{url('mdbootstrap')}}/css/style.css">
	

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adm')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('adm')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

	<link rel="stylesheet" href="{{asset('adm')}}/plugins/`sweetalert2`-theme-bootstrap-4/bootstrap-4.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>

<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('adm')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .button.button-border.button-fill {
	overflow: hidden;
	transform-style: preserve-3d;
	-webkit-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
	-webkit-backface-visibility: hidden;
}

.side-panel-open:not(.device-xs):not(.device-sm):not(.device-md) .body-overlay:hover { cursor: url('images/icons/close.png') 15 15, default; }
.video-placeholder {
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	z-index: 5;
	background: transparent url('{{url('home')}}/images/grid.png') repeat;
	transform: translateZ(0);
	-webkit-backface-visibility: hidden;
}


.owl-carousel .owl-video-play-icon {
	position: absolute;
	height: 64px;
	width: 64px;
	left: 50%;
	top: 50%;
	margin-left: -32px;
	margin-top: -32px;
	background: url("images/icons/play.png") no-repeat;
	cursor: pointer;
	z-index: 1;
	-webkit-backface-visibility: hidden;
	-webkit-transition: scale 100ms ease;
	-o-transition: scale 100ms ease;
	transition: scale 100ms ease;
}
.i-alt {
	background-image: url('{{url('home')}}/images/icons/iconalt.svg');
	background-position: center center;
	background-size: 100% 100%;
}
.fbox-border.fbox-effect .fbox-icon i::after {
	top: -2px;
	left: -2px;
	padding: 2px;
	z-index: -1;
	box-shadow: none;
	background-image: url('{{url('home')}}/images/icons/iconalt.svg');
	background-position: center center;
	background-size: 100% 100%;
	-webkit-transition: -webkit-transform 0.5s, opacity 0.5s, background-color 0.5s;
	-o-transition: -moz-transform 0.5s, opacity 0.5s, background-color 0.5s;
	transition: transform 0.5s, opacity 0.5s, background-color 0.5s;
}

.page-title-pattern {
	background-image: url('{{url('home')}}/images/pattern.png');
	background-repeat: repeat;
    background-attac
    hment: fixed;
}


.page-title-parallax {
	background-color: transparent;
	background-image: url('{{url('home')}}/images/parallax/parallax-bg.jpg');
	background-attachment: fixed;
	background-position: 50% 0;
	background-repeat: no-repeat;
}
    </style>
	
	<title>@yield('title')</title>