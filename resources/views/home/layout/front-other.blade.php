<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @yield('custom-head')
    @include('home.ext.head')
</head>

<body class="stretched">

	<div id="wrapper" class="clearfix">

    @include('home.ext.header')

    <section id="page-title" class="page-title-mini"  
        style="
        
        
					background:url(http://localhost:8000/home/images/ccpl/bg-header2.jpg);
    background-size: 100%;
    background-position: 0px;
    background-repeat: no-repeat;
        ">

        
    <div class="container clearfix">
        <h1>@yield('breadcrumb-name')</h1>
        <span style="display:block"><strong>@yield('breadcrumb-title')</strong></span>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb-name')</li>
        </ol>
    </div>
</section>

	@yield('content')

    @include('home.ext.footer')
	</div>

	<div id="gotoTop" class="icon-angle-up"></div>

	<script src="{{url('home')}}/js/jquery.js"></script>
	<script src="{{url('home')}}/js/plugins.min.js"></script>
    <!-- @yield('custom-footer') -->
	
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAeMV-FMGnR139m8rBqa5LNKyP5rBqMhIE"></script>

    <script src="{{url('home')}}/js/functions.js"></script>
	<script src="{{url('home')}}/js/custom.js"></script>


</body>
</html>