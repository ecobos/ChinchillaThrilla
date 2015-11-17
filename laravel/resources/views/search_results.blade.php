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
                /*height: 50%;*/
                /*width: 50%;*/
                max-height: 200px; 
            }

            table {
                text-align: left;
            }

            h1, h3 {
                font-weight: bold;
                text-align: center;
            }

            th, tr {
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
                        <div class="title"><h1>Lazer Reviews Search</h1></div>
                    </div>
                </div>



                <form method="GET" action="/search/results">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-8">
                                <!-- <label for="inputlg"></label> -->
                                <input class="form-control input-lg" id="inputlg" type="text" name="query" placeholder="Search for a Product" onchange="updateSearchBox()">
                            </div>
                            <div class="col-sm-2">
                                <select name="type" class="form-control input-lg">
                                    <option value="product">Products</option>
                                    <option value="category">Categories</option>
                                    <option value="brand">Brands</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-default btn-block input-lg" value="Search"/>
                            </div>
                        </div> 
    <!--                     <div class="col-sm-1 col-md-2 col-lg-3">
                        </div>
                        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">                       
                            <div class="form-group">
                                <input class="form-control input-lg" id="search-box" type="text" placeholder="Search for a Product">
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-2 col-lg-3">
                            <input class="form-control input-lg" type="submit" value="Search"/>
                        </div> -->
                    </div>
                </form>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <br/><br/>
                        <h3>Displaying Search Results for: "<?php echo $query; ?>"</h3>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Filter Results by:</th>
                                </tr>  
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="type" class="form-control input-lg">
                                            <option value="product">Products</option>
                                            <option value="category">Categories</option>
                                            <option value="brand">Brands</option>
                                        </select>
                                    </td>
                                </tr>
<!--                                 <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c1" value="yes" checked>Product Name</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c2" value="yes">Brand</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c3" value="yes">Category</label>
                                        </div>
                                    </td>
                                </tr>
 -->                            </tbody>
                        </table>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <table class="table table-hover">
                            <thead>
                                    <tr>
                                        <th>Product Results:</th>
                                    </tr>  
                            </thead>
                            <?php foreach ($results as $result) :?>
                            <tbody>
                                <tr>
                                    <td>
                                    <div class="row">
                                        
                                            <div class="col-xs-6 col-sm-8 col-md-8 col-lg-6">
                                                <img src="<?php echo $result->prod_img_path?>" class="img-responsive" align="middle" >
                                            </div>
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6" align="center">
                                                <p class="textStyle"><a href="<?php echo $result->url; ?>"><?php echo $result->prod_name; ?></a></p>
                                            </div> 
                                    </div>
                                    </td>
                                </tr>
                            </tbody>    
                         <?php endforeach; ?>
<!-- 

 
                                    <div class="col-xs-6 col-sm-8 col-md-8 col-lg-6">
                                                <img src="http://www.androidcentral.com/sites/androidcentral.com/files/styles/xlarge/public/article_images/2015/09/nexus-6p-render.jpg?itok=S7a7qata" class="img-responsive" align="middle" >
                                            </div>
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6" align="center">
                                                <p class="textStyle"><a>Nexus 6P</a></p>

                                    
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-6">
                                            <img src="http://www.androidcentral.com/sites/androidcentral.com/files/styles/xlarge/public/article_images/2015/09/nexus-6p-render.jpg?itok=S7a7qata" class="img-responsive" align="middle" >
                                        </div>
                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6" align="center">
                                            <p class="textStyle"><a>Nexus 6P</a></p>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody> 
                         </div> --> 

                        </table>
                    </div>
                </div>
            </div>


            <!-- Space --> <br><br><br><br><br><br>
    <div class="navbar navbar-default navbar-fixed-bottom">
    <br>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <p >© 2015 - Site Built By Division Zero></p>
        </div>
        <div class="col-xs-8 col-sm-4 col-lg-4">
            <p align="center">                
                <a href="#">About</a>
                <a href="#"><span style="margin-left:2em">Contact</span></a>
                <a href="#"><span style="margin-left:2em">PrivacyPolicy</span></a>
            </p>
        </div>
        <div class="col-xs-2 col-sm-4 col-lg-4">
            <a href="http://youtube.com" class="navbar-btn btn-danger btn pull-right">
            <span class="glyphicon glyphicon-star"></span>  Subscribe</a>
        </div>
    </div>
    </div>
    </body>



    
    
</html>

<script type="text/javascript">
    window.onload =  function(){ 

        var checkBoxes = document.querySelectorAll("input[type=checkbox]");

        for(var i = 0 ; i < checkBoxes.length ; i++){
            checkBoxes[i].addEventListener("change", checkUncheck, false);
        }

        function checkUncheck(){        
            for(var i = 0 ; i < checkBoxes.length ; i++){
                if(this.name !== checkBoxes[i].name && checkBoxes[i].checked){
                    checkBoxes[i].checked = false;
                }
            }
        }

    }
</script>
