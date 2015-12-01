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
                                <input class="form-control input-lg" id="inputlg" type="text" name="query" placeholder="Search for a Product" required>
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
                    </div>
                </form>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <br/><br/>
                        <h3>Displaying Search Results for: "<span id="query"><?php echo $query; ?></span>"</h3>
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
                                        <select id="filter" name="type" class="form-control input-lg">
                                            <option value="product" @if($type == 'product') selected @endif>Products</option>
                                            <option value="category" @if($type == 'category') selected @endif>Categories</option>
                                            <option value="brand" @if($type == 'brand') selected @endif>Brands</option>
                                        </select>
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
                            <?php foreach ($results as $result) :?>                                
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
                            <?php endforeach; ?>
                            </tbody> 
                        </table>
                    </div>
                </div>
            <script type="text/javascript">
                document.getElementById('filter').onchange = function () {
                    var query = document.getElementById('query').innerHTML;
                    var type = filter.value;
                    document.location = '/search/results?type='+type+'&query='+query;
                }
            </script>
@stop