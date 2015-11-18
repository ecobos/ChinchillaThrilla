<!DOCTYPE html>
<html>
    <head>
        <title>Lazer Reviews</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        @include('css_style')

    </head>

        
    <body>

        @include('header')
        @include('footer')
        <div class="container-fluid">
            <div class="row">
                <br/><br/>
                <div class="col-xs-offset-10 col-sm-offset-10 col-md-offset-10 col-lg-offset-11">
                    <button type="button" class="btn btn-primary btn-lg testbutton">Login</button>
                </div>     
            </div>
            <div class="row">  
                <br/><br/><br/><br/>
                <div class="col-xs-12 col-sm-12 col-lg-12">      
                    <div class="title" align="center">Lazer Reviews</div>
                </div>
            </div>
            <div class="row">            
                <div class="col-sm-1 col-md-2 col-lg-3"></div>
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="form-group">
                        <label for="inputlg"></label>
                        <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product">
                    </div>
                </div>
                <div class="col-sm-1 col-md-2 col-lg-3"></div>
            </div>
        </div>
    </body>    
</html>
