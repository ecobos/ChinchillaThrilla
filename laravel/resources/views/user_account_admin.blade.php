@extends('base_profile_page')

@section('admin_only_includes')
    {!! Html::script('js/approve_products.js') !!}
    {!! Html::script('js/approve_comment.js') !!}
    {!! Html::style('css/admin_page_style.css') !!}
@stop

@section('profile_content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Approve New Products<span class="badge">{{ $prodcuts_count }}</span></a></li>
                    <li><a href="#tab2" data-toggle="tab">Moderate Comments<span class="badge">{{ $reviews_count }}</span></a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-hover table-responsive tableBorderless">
                                <tbody>

                                @if( $prodcuts_count === 0 )
                                    <div class="alert alert-warning" style="margin-top:10px;">No products need review! :)</div>
                                @else
                                    @foreach($products as $product)
                                    <tr id="section-{{ $product->prod_id }}">
                                        <td bgcolor="#F2F2F2">
                                            <div class="row">
                                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                                    <img src="{{ $product->prod_img_path }}"
                                                         class="img-responsive" align="middle">
                                                </div>
                                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                    <p class="textStyle"><a
                                                                href="/products/admin_prev/{{ $product->prod_id }}">{{ $product->prod_name }}</a>
                                                    </p>

                                                    <p class="textStyle" vertical-align="center">
                                                        {{ $product->prod_description }}
                                                    </p>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                                    <button type="button" class="btn btn-success"
                                                       data-toggle="modal"
                                                       data-target="#confirmModal"
                                                       data-val="{{ $product->prod_id }}">Approve Product
                                                    </button>

                                                    <button type="button" class="btn btn-success"
                                                       data-val="{{ $product->prod_id }}"><a href="/edit_product/{{ $product->prod_id }}"> Edit Submission </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-hover table-responsive">
                                <tbody>

                                @if( $reviews_count === 0 )
                                    <div class="alert alert-warning" style="margin-top:10px;">No comments need moderation! :)</div>
                                @else
                                @foreach($reviews as $rev)
                                    <tr id="section-{{ $rev->prod_id }}-{{ $rev->user_id }}">
                                        <td bgcolor="#F2F2F2">
                                            <div class="row">
                                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">

                                                    <img src="{{$rev->avatar}}"
                                                         class="img-responsive img-rounded" align="middle">
                                                </div>
                                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                    <p class="textStyle">
                                                        <a href="/profile/{{ $rev->user_id }}">{{ $rev->name }}</a>
                                                        for <a href="/products/{{ $rev->prod_id }}">{{ $rev->prod_name }}</a>
                                                        <br> on {{ $rev->updated_at }}
                                                    </p>

                                                    <p class="textStyle" vertical-align="center">
                                                        {{ $rev->review_text }}
                                                    </p>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                                    <span id="{{ $rev->prod_id }}-{{ $rev->user_id }}" class="glyphicon glyphicon-ok commentApprovalMsg" aria-hidden="true">
                                                        Approved
                                                    </span>

                                                    <div class="btn-group btn-group-xs">
                                                        <button type="button" class="btn btn-success commentApprovalBtn"
                                                                data-prodid="{{ $rev->prod_id }}"
                                                                data-userid="{{ $rev->user_id }}">
                                                            Approve Comment
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-toggle="modal" data-target="#deleteModal"
                                                                data-prodid="{{ $rev->prod_id }}"
                                                                data-userid="{{ $rev->user_id }}">
                                                            Delete Comment
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br><br><br><br></div>
                    </div>


                    <!-- Approve PRODUCT Confirmation Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Confirm Approval?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button id="approveProduct" class="btn btn-success" data-dismiss="modal">Approve
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Delete COMMENT Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    This cannot be undone. Confirm Deletion?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                    <button id="deleteComment" class="btn btn-danger" data-dismiss="modal">Yes, Delete!
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@stop