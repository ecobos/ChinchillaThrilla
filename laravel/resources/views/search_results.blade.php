@extends('master_page')

@section('content')
            <br/>
            <br/>
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
                                        <div class="checkbox" align="left">
                                            <label><input type="checkbox" name="c2" value="yes"><b>Brand</b></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox" align="left">
                                            <label><input type="checkbox" name="c3" value="yes"><b>Category</b></label>
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
                                                    <img src="<?php echo $result->prod_img_path?>" class="img-responsive product-thumb-image" align="middle" >
                                            </div>
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6" align="center">
                                                <p class="textStyle"><a href="<?php echo $result->url; ?>"><?php echo $result->prod_name; ?></a></p>
                                            </div> 
                                        </div>
                                        </td>
                                    </tr>
                                </tbody> 
                            <?php endforeach; ?>   
                        </table>
                    </div>
                </div>
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
@stop