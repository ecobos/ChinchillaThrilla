<!-- This is the master/base page -->
<!DOCTYPE html>
<html>
<head>
	<!-- JQuery include should be loaded first -->
	{!! Html::script('https://code.jquery.com/jquery-2.1.3.js') !!}
	{!! Html::script('js/bootstrap.min.js') !!}

	@yield('specialized_js')

	{!! Html::style('https://fonts.googleapis.com/css?family=Lato:100') !!}
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/bootstrap-social.css') !!}
	{!! Html::style('css/font-awesome.min.css') !!}
	{!! Html::style('css/base.css') !!}

	@yield('specialized_css')

</head>
<body>

    @include('header')

    <div class="container">
        @yield('content')
    </div>
    @include('footer')
</body>
</html>
