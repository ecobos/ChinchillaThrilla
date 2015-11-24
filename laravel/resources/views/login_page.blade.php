@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/main_page.css') !!}
@stop

@section('content')

    <div id="main_label" class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Sign in with:</h1>
        </div>
    </div>
    <div id="label_padding" class="row" align="center">
            <a class="btn btn-block btn-social btn-lg btn-facebook">
                <i class="fa fa-facebook"></i> Facebook
            </a>
            <a class="btn btn-block btn-social btn-lg btn-google">
                <i class="fa fa-google-plus"></i> Google+
            </a>
    </div>
@stop