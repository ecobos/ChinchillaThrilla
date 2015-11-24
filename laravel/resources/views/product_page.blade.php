@extends('master_page')

@section('content')
<div id="label_padding" class="row">
    <div class="col-md-1 col-lg-1">
    </div>
    <div class="visible-xs col-xs-2"></div>
    <div class="col-xs-8 col-sm-6 col-md-5 col-lg-5">
        <img src= {{$img_path}} class="img-responsive" align="middle">
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title" align="center"><h1>{{ $brand }} - {{ $name }} {{ $model }}</h1></div>
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
                <p align="center">
                {{ $desc }}
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
                                    <img id="tableImg" src="http://ifidieinpolicecustody.net/wp-content/uploads/2015/07/anonymous.jpg" class="img-responsive" align="middle" >
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
                    <tr>
                        <td bgcolor="#F2F2F2">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                    <img id="tableImg" src="http://ifidieinpolicecustody.net/wp-content/uploads/2015/07/anonymous.jpg" class="img-responsive" align="middle" >
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
@stop