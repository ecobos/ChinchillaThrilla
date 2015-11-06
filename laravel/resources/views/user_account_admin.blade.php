<!DOCTYPE html>
<html>
    <head>
        <title>Lazer Reviews</title>
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
                    <div class="title" align="center"><h1>User Account<h1></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" align="center">
                    <img src="http://ifidieinpolicecustody.net/wp-content/uploads/2015/07/anonymous.jpg" class="img-responsive" align="middle" height="350" width="300" >
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-4 col-md-3 col-lg-4">
                </div>
                <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4" align="center">
                    <table class="table table-hover table-responsive">
                        <thead>
                                <tr>
                                    <th class="info" align="center">User Name: Anonymous</th>
                                </tr> 
                        </thead>
                    </table>
                </div>
                <div class="col-xs-3 col-sm-4 col-md-3 col-lg-4">
                </div>
            </div>            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Approve New Products</a></li>
                            <li><a href="#tab2" data-toggle="tab">Moderate Comments</a></li>
                            <li><a href="#tab3" data-toggle="tab">Account Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <table class="table table-hover table-responsive">
                                    <tbody>
                                        <tr>
                                            <td bgcolor="#F2F2F2">
                                                <div class="row">
                                                    <p class="textStyle" vertical-align="center" align="center">
                                                        PRODUCT-NAME submitted by USERNAME on DATE
                                                    </p>
                                                </div>                                      
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#F2F2F2">
                                                <div class="row">
                                                    <p class="textStyle" vertical-align="center" align="center">
                                                        PRODUCT-NAME submitted by USERNAME on DATE
                                                    </p>
                                                </div>                                      
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#F2F2F2">
                                                <div class="row">
                                                    <p class="textStyle" vertical-align="center" align="center">
                                                        PRODUCT-NAME submitted by USERNAME on DATE
                                                    </p>
                                                </div>                                      
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#F2F2F2">
                                                <div class="row">
                                                    <p class="textStyle" vertical-align="center" align="center">
                                                        PRODUCT-NAME submitted by USERNAME on DATE
                                                    </p>
                                                </div>                                      
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br><br><br><br></div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-hover table-responsive">
                                            <tbody>
                                                <tr>
                                                    <td bgcolor="#F2F2F2">
                                                        <div class="row">
                                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" >
                                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaYcLmUcKlNZscoJaVPizWWk-gRcGFm4lYz0og0nH95zhoWZiKcg" class="img-responsive" align="middle" >
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <p class="textStyle"><a href="profile">Anonymous-userName</a></p>
                                                                <p class="textStyle" vertical-align="center">
                                                                    Gravida quisque, pede tempor pulvinar in. Dolor vel nec. Lectus diam praesent dui, mattis morbi libero eleifend dolor. Diam nulla nunc quam morbi massa, turpis orci vulputate duis maecenas tellus, eros dui sed dis. At urna dolor vestibulum est in vel. Aliquam dui phasellus id curabitur ac, gravida pellentesque ad, aliquam habitasse semper. 
                                                                </p>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                                                <div class="btn-group btn-group-xs"><button type="button" class="btn btn-primary">Approve Comment</button>
                                                                    <button type="button" class="btn btn-primary">Delete Comment</button>
                                                                </div>
                                                            </div>
                                                
                                                        </div>                                      
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#F2F2F2">
                                                        <div class="row">
                                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                                                <img src="http://ifidieinpolicecustody.net/wp-content/uploads/2015/07/anonymous.jpg" class="img-responsive" align="middle" >
                                                            </div>
                                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <p class="textStyle"><a href="profile">Anonymous-userName</a></p>
                                                                <p class="textStyle">
                                                                    Gravida quisque, pede tempor pulvinar in. Dolor vel nec. Lectus diam praesent dui, mattis morbi libero eleifend dolor. Diam nulla nunc quam morbi massa, turpis orci vulputate duis maecenas tellus, eros dui sed dis. At urna dolor vestibulum est in vel. Aliquam dui phasellus id curabitur ac, gravida pellentesque ad, aliquam habitasse semper. 
                                                                </p>
                                                        </div> 
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                                            <div class="btn-group btn-group-xs"><button type="button" class="btn btn-primary">Approve Comment</button>
                                                                <button type="button" class="btn btn-primary">Delete Comment</button>
                                                            </div>
                                                        </div>
                                                        </div>                                     
                                                    </td>
                                                </tr>
                                            </tbody>
                                    </table>
                                </div>                              
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br><br><br><br></div>
                            </div>
                            <div class="tab-pane" id="tab3">

                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2" ></div>
                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10" >
                                <br>
                                    <label for="brand">Update Home Location</label>
                                    <div class="row">
                                        <form role="form">
                                            <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                                <input type="location" class="form-control" id="loc" placeholder="Long Beach, CA">
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4" align="left">  
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>  
                                        </form>    
                                    </div>  
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                                    <label for="brand">Update Email Address</label>
                                    <div class="row"> 
                                        <form role="form">               
                                            <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                                <input type="email" class="form-control" id="email" placeholder="MyEmail@domain.net">
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                                    <label for="brand">Change Password</label>
                                    <div class="row">  
                                        <form role="form">              
                                            <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="pwd" placeholder="New Password">
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4"></div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                                            <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="pwd" placeholder="New Password Again">
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                                <button type="submit" class="btn btn-primary">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br><br></div>
                                <div class="row">  
                                    <form role="form">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                                            <button type="button" class="btn btn-danger">Delete Account</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br><br><br><br></div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
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