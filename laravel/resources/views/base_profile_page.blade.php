@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/profiles.css') !!}
@stop

@section('content')
    <br>
    <br>
    <div class="container">

        <!-- Page Label-->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title" align="center"><h1>{{$base_info['page_title']}}</h1></div>
            </div>
        </div>

        <!-- User Image -->
        <div class="row">

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4" align="center">
                <img src="{{ $base_info['avatar'] }}" class="img-responsive" align="middle" height="350" width="300" >
            </div>
        </div>

        <!-- User Name Label-->
        <div class="row">
            <div id="name_banner" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4" align="center">
                {{ $base_info['name'] }}
            </div>
        </div>

        <!-- Page Content -->
        @yield('profile_content')

    </div>
@stop