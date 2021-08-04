
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