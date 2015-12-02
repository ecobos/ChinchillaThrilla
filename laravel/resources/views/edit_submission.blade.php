
<?php 
    $api_key = 'c126ace07682861032b8903d9ec39787ac42772c';
?>

   <script type="text/javascript">

    function preview() 
    {       
        var reader = new FileReader(); //JS class that can convert an image file to local url
        var upload = document.getElementById('upload_file').files[0];
        var img = document.getElementById('myImage');
        reader.onloadend = function() {
            img.src = reader.result;
        };
        if (upload) 
        {
                //change img src
            img.src = reader.readAsDataURL(upload);
        } else 
        {
                // whoops
            img.src = "";
        }
    }

    //$('.categories').children()[0].attr('disabled', 'true');
    //$('.categories').children()[0].attr('selected', 'true');
    
</script>

@extends('master_page')

@section('content')

        <br/><br/><br/>   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title"><h1>Edit Product Submission</h1></div>
                <div class="title"><h2>{{$product->prod_name}} </h2> </div>
            </div>
        </div>
        
        {!! Form::open(array('action' => array('ProductController@createWithAPIKey', $api_key), 'files' => true)) !!}
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="prod_name" value="{{$product->prod_name}}" placeholder="Enter name" required="true">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="model">Model:</label>
                <input type="text" class="form-control" autocomplete="on" name="prod_model" value="{{ $product->prod_model }}" placeholder="Enter model" required="true">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="brand" align="center">Brand:</label>
                <span class="input-group-addon">
                    <input type="text" class="form-control" aria-label="..." name="prod_brand" value="{{ $prod_info['brand'] }}" id="brand_text" placeholder="Enter Brand" required="true">
                </span>
                <span class="input-group-addon">
                {!! 
                    Form::select('select_brand', ($brands), null, 
                    ['class' => 'form-control', 'id' => 'brand_select']); 
                !!}
                </span>
            </div>
            <div class="form-group" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" data-toggle="dropdown" align="left">
                <label for="category" align="center">Category:</label>
                <span class="input-group-addon">
                    <input type="text" class="form-control" aria-label="..." name="prod_category" value="{{$prod_info['category']}}" id="category_text" placeholder="Enter Category" required="true">
                </span>
                <span class="input-group-addon">
                {!! 
                    Form::select('category', ($categories), null, 
                    ['class' => 'form-control first-disabled categories', 'id' => 'category_select']); 
                !!}
                </span>
            </div>  
        </div> 
            </div><!-- /.col-xs-12 -->
            
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">

            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="image">Image:</label>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
            <img id="myImage" src="{{$product->prod_img_path}}" class="img-responsive" width="200" height="200">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                {!! Form::file('image', ["id" => "upload_file", "onchange" => "preview()", "class" => "btn btn-default btn-file"]) !!}
            </div>   
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <label>Specs entered by User</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <br>
            @if(count($features) > 0)
            @for($i = 1;$i<=count($features); $i++)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec{{$i}}" id="spc"  value="{{$features[$i]}}" placeholder="Spec">
            </div>                     
            <div class="visible-xs col-xs-12" ><br></div>
            @if($i+1<=count($features))
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec{{$i+1}}" id="spc" value="{{$features[++$i]}}" placeholder="Enter New or Modified Specification">
            </div>
            @endif
            @endfor
            @else
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" > <h2>No features were entered for this product.</h2><br></div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <label>Brief Description</label><br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <textarea class="form-control" rows="5" name="prod_description" placeholder="Description">{{$product->prod_description}}</textarea>
            <br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            
            <div class="button" align="center">
                <button type="submit" class="btn btn-primary"><b>Review & Submit</b></button>
            </div>
            </div>

            
            
        {!! Form::close() !!}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <br><br><br><br></div>


<script type="text/javascript">
    // grabs selected field from drop down to update the textbox
    var mytextbox = document.getElementById('brand_text');
    var mydropdown = document.getElementById('brand_select');

    var mytextbox2 = document.getElementById('category_text');
    var mydropdown2 = document.getElementById('category_select');

    // replace values of textbox with drop down val
    mydropdown.onchange = function(){
          mytextbox.value = this.value; 
    }

    mydropdown2.onchange = function() {
        mytextbox2.value = this.value;
    }
    
</script>
@stop

