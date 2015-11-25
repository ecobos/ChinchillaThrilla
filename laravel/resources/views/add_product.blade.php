
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
                <div class="title"><h1>Add New Product</h1></div>
            </div>
        </div>
        
        {!! Form::open(array('action' => array('ProductController@createWithAPIKey', $api_key), 'files' => true)) !!}
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="prod_name" placeholder="Enter name" required="true">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="model">Model:</label>
                <input type="text" class="form-control" autocomplete="on" name="prod_model" placeholder="Enter model" required="true">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                <label for="brand" align="center">Brand:</label>
                <span class="input-group-addon">
                    <input type="text" class="form-control" aria-label="..." name="prod_brand" id="brand_text" placeholder="Enter Brand" required="true">
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
                    <input type="text" class="form-control" aria-label="..." name="prod_category" id="category_text" placeholder="Enter Category" required="true">
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
            <img id="myImage" src="http://womensfooty.com/sites/all/modules/media_gallery/images/empty_gallery.png" class="img-responsive" width="200" height="200">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                {!! Form::file('image', ["id" => "upload_file", "onchange" => "preview()", "class" => "btn btn-default btn-file"]) !!}
            </div>   
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <label>At least 5 specs of the product</label>
            </div>
            <br>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec1" id="spc1" placeholder="Spec One">
            </div>                     
            <div class="visible-xs col-xs-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec2" id="spc2" placeholder="Spec Two">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec3" id="spc3" placeholder="Spec Three">
            </div>
            <div class="visible-xs col-xs-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec4" id="spc4" placeholder="Spec Four">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec5" id="spc5" placeholder="Spec Five">
            </div>
            <div class="visible-xs col-xs-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec6" id="spc6" placeholder="Spec Six">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec7" id="spc7" placeholder="Spec Seven">
            </div>
            <div class="visible-xs col-xs-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec8" id="spc8" placeholder="Spec Eight">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec9" id="spc9" placeholder="Spec Nine">
            </div>
            <div class="visible-xs col-xs-12" ><br></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <input type="spec" class="form-control" name="spec10" id="spc10" placeholder="Spec Ten">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            <label>Brief Description</label><br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <textarea class="form-control" rows="5" name="prod_description" placeholder="Description ofthe product"></textarea>
            <br></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            
            <div class="button" align="center">
                <button type="submit" class="btn btn-default"><b>Review & Submit</b></button>
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

