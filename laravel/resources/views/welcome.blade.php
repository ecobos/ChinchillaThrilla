<!DOCTYPE html>
<html>
    <head>
        <title>Lazer Reviews</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            p {
               display: line; 
            }

            .inline {
                display: inline;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 70px;
            }

            .testbutton {
                font-family: 'Lato';
                color: #628C9E !important;
                font-size: 20px;
                text-shadow: 2px 1px 1px #ADC6DE;
                box-shadow: 1px 1px 1px #F7F9F9;
                padding: 24px 14px;
                -moz-border-radius: 40px;
                -webkit-border-radius: 40px;
                border-radius: 40px;
                border: 1px solid #BFBDBD;
                background: #FFFFFF;
            }

            .testbutton:hover {
                color: #5EA6F7 !important;
                background: #FAF9F5;
            }

            * {
                margin: 0;
            }

            .wrapper {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -155px; /* the bottom margin is the negative value of the footer's height */
            }
            .footer, .push {
                height: 155px; /* .push must be the same height as .footer */
            }

        </style>
    </head>

        
    <body>
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
    
    <div class="navbar navbar-default navbar-fixed-bottom">
    <br>
    <div class="row">
        <div class="col-xs-5 col-sm-4 col-lg-4">
            <p >© 2015 - Site Built By Division Zero></p>
        </div>
        <div class="col-xs-5 col-sm-4 col-lg-4">
            <p align="center">                
                <a href="#">About</a>
                <a href="#"><span style="margin-left:2em">Contact</span></a>
                <a href="#"><span style="margin-left:2em">PrivacyPolicy</span></a>
            </p>
        </div>
        <div class="col-xs-3 col-sm-4 col-lg-4"></div>
    </div>
    </div>
    
</html>
