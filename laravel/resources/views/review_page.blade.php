<?php 
    $api_key = '3aee3c02724f2bb06eb4210a751a36387bc86a9a';
?>

@extends('master_page')

@section('content')
<div>
    <h3 >Product Review</h3>
    

    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title"><h1>{{$product['product_name']}}</h1></div>
            </div>
    </div>

    {!! Form::open(array('action' => array('ReviewController@createReviewWithAPIKey', $product['prod_id'], $api_key))) !!}
    <table class="table table-responsive">
        <thead>
          <tr class="trHeight">
            <th class="tdLeft">Feature</th>
            <th class="tdRight">Vote</th>
          </tr>
        </thead>
        <tbody class="tbodyHeight">
          @foreach($features as $feat)
          <tr class="trHeight">
            <td class="tdLeft">{{ $feat->feature_name }}</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="features[{{ $feat->feature_id }}]" id="option1" value="1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="features[{{ $feat->feature_id }}]" id="option2" value="-1" autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8" align="left">
        <label>Rating:</label><br/>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" align="right">
        <div class="rating">
            <span><input type="radio" name="rating" id="str6" value="6"><label for="str6"></label></span>
            <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
            <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
            <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
            <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
            <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" align="left" >
        <label>Comment:</label><br/>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <textarea class="form-control" style="font-weight: bold" rows="5" name="review_text" id="comment" placeholder="Write your review here" required="true"></textarea>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/></div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <button type="button" class="btn btn-danger" onclick="return cancel();"><b>Cancel</b></button>
        <button type="submit" class="btn btn-success"><b>Submit</b></button><br/>
        
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/><br/><br/><br/></div>
</div>
{!! Form::close() !!}


<script type="text/javascript">
$(document).ready(function(){
//  Check Radio-box
    $(".rating input:radio").attr("checked", false);
    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
    $('input:radio').change(
    function(){
        var userRating = this.value;
        alert(userRating);
    }); 
});

function cancel() {
    return false;
}
</script>
@stop
