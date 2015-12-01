<!-- This is the master/base page -->
<!DOCTYPE html>
<html>
<head>
    <title>Lazer Reviews</title>
    <!-- Base includes for all pages -->
    {!! Html::script('https://code.jquery.com/jquery-2.1.3.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/alert_modal.js') !!}
    {!! Html::script('js/cancel_review.js') !!}

    {!! Html::style('https://fonts.googleapis.com/css?family=Lato:300') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/base.css') !!}

            <!-- Page specific includes -->
    @yield('specialized_css')

</head>
<body>

@if (session('status'))
    <div class="alert {{ session('alert-type') }}" id="globalAlert">{{ session('status') }}</div>
@endif

@include('header')

<div class="container">
    @yield('content')
</div>
@include('footer')

</body>
</html>