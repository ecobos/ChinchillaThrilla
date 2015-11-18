<!-- This is the master page -->
<!DOCTYPE html>
<html>
<head>
	<!-- this is how you include your bootstrap files...-->
	<!-- We could also use a CDN, CDN is better -->
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> 
        
	@include('css_style')

</head>
<body>
    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
    <script src="js/bootstrap.js"></script>
	@include('header')
	<div class="container-fluid">
		@yield('content')
	</div>
	@include('footer')
</body>
</html>
