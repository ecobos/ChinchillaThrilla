@extends('master_page')

@section('content')
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
                                            <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">  
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
@stop