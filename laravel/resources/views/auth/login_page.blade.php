<!-- Inherit from base class -->
@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/main_page.css') !!}
    {!! Html::style('css/font-awesome.min.css') !!}
    {!! Html::style('fonts/fontawesome-webfont.woff') !!}
    {!! Html::style('css/bootstrap-social.css') !!}
@stop

@section('content')
    <!-- Show Facebook and Google Auth buttons here -->
    <div id="main_label" class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Sign in with:</h1>
        </div>
    </div>
    <div id="label_padding" class="row" align="center">
        <a class="btn btn-block btn-social btn-lg btn-facebook" href="/auth/facebook">
            <i class="fa fa-facebook"></i> Facebook</a>
        <a class="btn btn-block btn-social btn-lg btn-google" href="/auth/google">
            <i class="fa fa-google-plus"></i> Google+
        </a>
    </div>
@stop