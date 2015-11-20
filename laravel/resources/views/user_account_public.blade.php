@extends('master_page')

@section('content')
        <br/>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="title" align="center"><h1>User Account<h1></div>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12" align="center">
                    <img src="{{$avatar_link}}" class="img-responsive" align="middle" height="350" width="300" >
                </div>

            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" align="center">
                    <table class="table table-hover table-responsive">
                        <thead>
                                <tr>
                                    <th class="info" align="center">Name: {{$name}}</th>
                                </tr> 
                        </thead>
                    </table>
                </div>
                <div class="col-xs-3 col-sm-6 col-md-3 col-lg-4">
                </div>
            </div>

            <br/>
            <br/> 
            <br/><br/>
            <div class="row">                
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