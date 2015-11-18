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
            
            @include('header')
            @include('footer')

            <br/>
            <br/>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="title"><h1>Lazer Reviews Search</h1></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1 col-md-2 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">                       
                        <div class="form-group">
                            <label for="inputlg"></label>
                            <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product">
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-2 col-lg-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <br/><br/>
                        <h3>Displaying Search Results for: "ITEM"</h3>
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
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c1" value="yes" checked><b>Product Name</b></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c2" value="yes"><b>Brand</b></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="c3" value="yes"><b>Category</b></label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <table class="table table-hover">
                            <thead>
                                    <tr>
                                        <th>Product Results:</th>
                                    </tr>  
                            </thead>
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
                        </table>
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
