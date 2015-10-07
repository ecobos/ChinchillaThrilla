<!-- This is the master page -->
<!DOCTYPE html>
<html>
<head>
	<title> {{$page_name}}</title>
	<!-- this is how you include your bootstrap files...-->
	<!-- We could also use a CDN, CDN is better -->
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
	<div class="page-header">
		<h1>Consumer Reviews </h1>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">@</span>
		  <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
		</div>
		<span class="alert alert-success" role="alert">Objective Reviews You Can Trust</span>
	</div>
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
</body>
</html>
