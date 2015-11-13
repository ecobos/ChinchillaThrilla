<!DOCTYPE html>
<html>
    <head>
        <title>User Not Found</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                font-weight: bold;
                font-family: 'Lato';
            }

            table {
                text-align: left;
                border: 0 !important;
            }

            h1, h3, th, thead {
                text-align: center;
                border: 0 !important;
            }

            th, tr {
                font-size: 20px;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .textStyle {
                font-weight: normal;
                font-size: 12px;
                font-family: 'verdana';
            }

            .textStyle2 {
                display: inline;
                font-weight: normal;
                font-size: 12px;
                font-family: 'verdana';
            }

            .flagStyle {
                font-weight: normal;
                font-size: 25px;
                color: red;
                margin: 1%;
            }

            .centerImage
            {
                text-align:center;
                display:block;
            }

            .title {

                font-size: 70px;
            }

            .btn-circle {
                width: 70px;
                height: 70px;
                padding: 10px 10px;
                font-size: 18px;
                line-height: 1.33;
                border-radius: 35px;
            }

            #container
            {
                width: 100%;
                margin: 0 auto;
            }

            .div1, .div2 {
                float: left;
                width: 25%;
            }

            
            .rating {
                width:300px;
                margin-right: auto;
                margin-left: auto;
            }
            .rating span { float:right; position:relative; }
            .rating span input {
                position:absolute;
                top:0px;
                opacity:0;
            }
            .rating span label {                
                display:inline-block;
                width:30px;
                height:30px;
                left: 00px;
                text-align:center;
                color:#FFF;
                background:#ccc;
                font-size:30px;
                margin-right:10px;
                line-height:30px;
                border-radius:50%;
                -webkit-border-radius:50%;
            }
            .rating span:hover ~ span label,
            .rating span:hover label,
            .rating span.checked label,
            .rating span.checked ~ span label {
                background:#81AAD9;
                color:#FFF;
            }
        </style>
    </head>
    <body> 
        <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
        <script src="js/bootstrap.js"></script>
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <a href="#" class="navbar-brand">Lazer Reviews</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">MyAcount</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <br/>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="title" align="center"><h1>User Account Not Found<h1></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12" align="center">
                    <img src="http://s3.amazonaws.com/37assets/svn/765-default-avatar.png" class="img-responsive" align="middle" height="350" width="300" >
                </div>
                <div class="col-xs-3 col-sm-3">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" align="center">
                    <table class="table table-hover table-responsive">
                        <thead>
                                <tr>
                                    <th class="info" align="center">No results found for this user</th>
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
    </body>

    <div class="navbar navbar-default navbar-fixed-bottom">
    <br>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <p >© 2015 - Site Built By Division Zero</p>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-4">
            <p align="center">                
                <a href="about">About</a>
                <a href="contact"><span style="margin-left:2em">Contact</span></a>
                <a href="privacyPolicy"><span style="margin-left:2em">PrivacyPolicy</span></a>
            </p>
        </div>
    </div>
    </div>

    
    
</html>