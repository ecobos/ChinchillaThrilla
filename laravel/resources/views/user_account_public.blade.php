@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/profiles.css') !!}
@stop

@section('content')
        <div id="label_padding" class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="title" align="center"><h1>User Account</h1></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12" align="center">
                    <img src="{{$avatar_link}}" class="img-responsive" align="middle" height="350" width="300" >
                </div>
            </div>
            <div class="row">
                <div id="name_banner" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4" align="center">
                    {{ $name }}
                </div>
            </div>
            <div id="label_padding" class="row">
                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
                </div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
                    <table class="table table-hover table-responsive">
                        <thead>
                                <tr>
                                    <th align="center">Member Since: {{$member_since_date}}</th>
                                </tr> 
                        </thead>
                        <tbody> 
                            <table class="table table-responsive">
                                <tr>
                                    <td>Number of Reviews: {{$total_reviews}}</td>
                                </tr>
                                <tr>
                                    <td>Number of Helpful Reviews: 30/50</td>
                                </tr>
                                <tr>
                                    <td>Karma Points: 100pts</td>
                                </tr>
                            </table>
                        </tbody>
                    </table>
                </div>               
                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
                </div>
            </div>
        </div>
@stop