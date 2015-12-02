<?php 
    $api_key = 'c126ace07682861032b8903d9ec39787ac42772c';
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
                    @if(count($scores) > 0 && $scores[$feat->feature_id] === 1)
                    <label class="btn btn-default active">
                    @else
                    <label class="btn btn-default">   
                    @endif
                        <input type="radio" name="features[{{ $feat->feature_id }}]" id="option1" value="1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>

                    @if(count($scores) > 0 && $scores[$feat->feature_id] === -1)
                    <label class="btn btn-default active">
                    @else
                    <label class="btn btn-default">   
                    @endif
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
            <span><input type="radio" name="rating" id="str6" value="6" required @if ($product['rating'] === 6) checked @endif><label for="str6"></label></span>
            <span><input type="radio" name="rating" id="str5" value="5" @if ($product['rating'] === 5) checked @endif><label for="str5"></label></span>
            <span><input type="radio" name="rating" id="str4" value="4" @if ($product['rating'] === 4) checked @endif><label for="str4"></label></span>
            <span><input type="radio" name="rating" id="str3" value="3" @if ($product['rating'] === 3) checked @endif><label for="str3"></label></span>
            <span><input type="radio" name="rating" id="str2" value="2" @if ($product['rating'] === 2) checked @endif><label for="str2"></label></span>
            <span><input type="radio" name="rating" id="str1" value="1" @if ($product['rating'] === 1) checked @endif><label for="str1"></label></span>
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" >
        <label>Comment:</label>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <textarea class="form-control" style="font-weight: bold" rows="5" name="review_text" id="comment" maxlength="200" placeholder="Write your review (max 200 characters)." required="true">{{$product['review']}} {{$product['rating']}}</textarea>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/></div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <button data-target="#confirmModal" data-toggle="modal" type="button" class="btn btn-danger"><b>Cancel</b></button>
        <button type="submit" class="btn btn-success"><b>Submit</b></button><br/>
        
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/><br/><br/><br/></div>
</div>


<!-- Review Cancel Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Review Cancellation</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button id="cancelReview" class="btn btn-danger" data-dismiss="modal">Yes</button>
                </div>

            </div>
        </div>
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
    }); 
});

</script>
@stop
