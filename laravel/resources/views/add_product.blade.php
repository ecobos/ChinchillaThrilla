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

            img {
                height: 50%;
                width: 50%;
            }

            table {
                text-align: left;
            }

            h1, h3 {
                font-weight: bold;
                text-align: center;
            }

            th, tr, label, input {
                font-weight: bold;
                font-size: 20px;
            }

            .content {
                text-align: center;
                display: inline-block;
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

            .btn-file {
              position: relative;
              overflow: hidden;
            }
            .btn-file input[type=file] {
              position: absolute;
              top: 0;
              right: 0;
              min-width: 100%;
              min-height: 100%;
              font-size: 100px;
              text-align: right;
              filter: alpha(opacity=0);
              opacity: 0;
              background: red;
              cursor: inherit;
              display: block;
            }
            input[readonly] {
              background-color: white !important;
              cursor: text !important;
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
                        <div class="title"><h1>Add New Product</h1></div>
                    </div>
                </div>
                <form role="form">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="email">Name:</label>
                        <input type="email" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="model">Model:</label>
                        <input type="model" class="form-control" autocomplete="on" id="mdl" placeholder="Enter model">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="brand">Brand:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="..." placeholder="Enter Brand">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </div><!-- /.col-xs-12 -->
                    <div class="form-group" >
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" data-toggle="dropdown">
                        <label for="ctg">Category:</label>
                            <select class="form-control" id="sel1">
                                <option>Category 1</option>
                                <option>Category 2</option>
                                <option>Category 3</option>
                                <option>Category 4</option>
                            </select>
                        </div>
                    </div>  
                </div> 
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="image">Image:</label>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                    <img id="myImage" src="http://womensfooty.com/sites/all/modules/media_gallery/images/empty_gallery.png" class="img-portrait" max-width="200px" max-height="200px">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                        <br>
                        <span class="btn btn-default btn-file">
                            <b>Browse</b>&hellip; <input type="file" onchange="readURL(this);" accept="image/*">
                        </span>
                    </div>   
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <label>At least 5 specs of the product</label>
                    </div>
                    <br>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc1" placeholder="Spec One">
                    </div>                     
                    <div class="visible-xs col-xs-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc2" placeholder="Spec Two">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc3" placeholder="Spec Three">
                    </div>
                    <div class="visible-xs col-xs-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc4" placeholder="Spec Four">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc5" placeholder="Spec Five">
                    </div>
                    <div class="visible-xs col-xs-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc6" placeholder="Spec Six">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc7" placeholder="Spec Seven">
                    </div>
                    <div class="visible-xs col-xs-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc8" placeholder="Spec Eight">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc9" placeholder="Spec Nine">
                    </div>
                    <div class="visible-xs col-xs-12" ><br></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <input type="spec" class="form-control" id="spc10" placeholder="Spec Ten">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    <label>Brief Description</label><br></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <textarea class="form-control" rows="5" id="comment" placeholder="Here is some text input"></textarea>
                    <br></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    
                    <div class="button" align="center">
                        <button type="submit" class="btn btn-default"><b>Review & Submit</b></button>
                    </div>
                    </div>
                    
                </form>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <br><br><br><br></div>

    <div class="navbar navbar-default navbar-fixed-bottom">
    <br>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <p >© 2015 - Site Built By Division Zero</p>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-4">
            <p align="center">                
                <a href="#">About</a>
                <a href="#"><span style="margin-left:2em">Contact</span></a>
                <a href="#"><span style="margin-left:2em">PrivacyPolicy</span></a>
            </p>
        </div>
    </div>
    </div>
    </body>
    
    
</html>

<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var image = document.getElementById("myImage");
            reader.onload = function (e) {
                $('#myImage')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
