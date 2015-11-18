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
            }

            h1, h3, th, thead, p {
                font-weight: bold;
                text-align: center;
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

            @include('header')
            @include('footer')

            <br/>
            <br/>
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-lg-1">
                    </div>
                    <div class="visible-xs col-xs-2"></div>
                    <div class="col-xs-8 col-sm-6 col-md-5 col-lg-5">
                        <img src="http://www.androidcentral.com/sites/androidcentral.com/files/styles/xlarge/public/article_images/2015/09/nexus-6p-render.jpg?itok=S7a7qata" class="img-responsive" align="middle">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="title" align="center"><h1>Huawei - Nexus 6P</h1></div>
                            </div>
                            <div class="col-xs-11 col-sm-10 col-md-12 col-lg-12">
                                <div class="rating" >
                                    <span><input type="radio" name="rating" id="str6" value="6"><label for="str6"></label></span>
                                    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
                                    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                                    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                                    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                                    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                                </div>
                                </div>
                            <br/>
                            <br/>
                            <div class="col-xs-11 col-sm-12 col-md-12 col-lg-12">
                                <p align="center">Lorem lorem quisque nec, fusce nascetur in vulputate vehicula, porttitor lectus, convallis id viverra amet, sit diam dapibus proin nunc. Fermentum est dignissim placerat. Quis tortor dolore et, in nostrum elit amet. Bibendum dui et platea, curabitur adipiscing vestibulum. Dolor lectus dolor laoreet nec pellentesque ut, est tellus mauris vestibulum interdum justo, etiam nulla lectus eros mauris. Pulvinar sit in duis at luctus vitae, ac magna etiam sed, lectus pellentesque orci accumsan metus metus enim, congue risus ac. 
                                </p>
                                </div>
                        </div>                        
                    </div>
                    <div class="col-md-1 col-lg-1">
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover table-responsive">
                            <thead>
                                    <tr>
                                        <th class="success">Pros</th>
                                        <th class="danger">Cons</th>
                                    </tr> 
                            </thead>
                            <tbody> 
                                <table class="table table-responsive">
                                <tr>
                                    <td>105/120</td>
                                    <td>Screen</td>
                                    <td>105/120</td>
                                    <td>Screen</td>
                                </tr>
                                <tr>
                                    <td>35/90</td>
                                    <td>Weight</td>
                                    <td>35/90</td>
                                    <td>Weight</td>
                                </tr>
                                </table>
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-hover table-responsive">
                        <thead>
                                    <tr>
                                        <th class="info">What people are saying about the product!</th>
                                    </tr> 
                            </thead>
                            <tbody>
                                <tr>
                                    <td bgcolor="#F2F2F2">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                                <img src="http://ifidieinpolicecustody.net/wp-content/uploads/2015/07/anonymous.jpg" class="img-responsive" align="middle" >
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                <p class="textStyle"><a href="profile">Anonymous-userName</a></p>
                                                <p class="textStyle" vertical-align="center">
                                                    Gravida quisque, pede tempor pulvinar in. Dolor vel nec. Lectus diam praesent dui, mattis morbi libero eleifend dolor. Diam nulla nunc quam morbi massa, turpis orci vulputate duis maecenas tellus, eros dui sed dis. At urna dolor vestibulum est in vel. Aliquam dui phasellus id curabitur ac, gravida pellentesque ad, aliquam habitasse semper. 
                                                </p>
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
                                        </div>                                      
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>    
            </div>
            <br/>
        </div>
    </body>

</html>