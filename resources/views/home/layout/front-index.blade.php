<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @include('home.ext.head')
</head>

<body class="stretched">

	<div id="wrapper" class="clearfix">

    @include('home.ext.header')

    @include('home.ext.slider')
        

	@yield('content')


    @include('home.ext.footer')
	</div>

	<div id="gotoTop" class="icon-angle-up"></div>

	<script src="{{url('home')}}/js/jquery.js"></script>
	<script src="{{url('home')}}/js/plugins.min.js"></script>

	<script src="{{url('home')}}/js/functions.js"></script>
	<script src="{{url('home')}}/js/custom.js"></script>

</body>
</html>