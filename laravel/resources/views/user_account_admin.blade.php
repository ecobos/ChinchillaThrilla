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
                    <li><a href="#tab3" data-toggle="tab">Account Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-hover table-responsive tableBorderless">
                                <tbody>

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
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-hover table-responsive">
                                <tbody>

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

                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br><br><br><br></div>
                    </div>


                    <!-- Approve Comment Confirmation Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Confirm Approval?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button id="approveComment" class="btn btn-success" data-dismiss="modal">Approve
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Delete Comment Confirmation Modal -->
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

                    <div class="tab-pane" id="tab3">

                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2"></div>
                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10">
                            <br>
                            <label for="brand">Update Home Location</label>

                            <div class="row">
                                <form role="form">
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <input type="location" class="form-control" id="loc"
                                               placeholder="Long Beach, CA">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
                            <label for="brand">Update Email Address</label>

                            <div class="row">
                                <form role="form">
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <input type="email" class="form-control" id="email"
                                               placeholder="MyEmail@domain.net">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
                            <label for="brand">Change Password</label>

                            <div class="row">
                                <form role="form">
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <input type="password" class="form-control" id="pwd" placeholder="New Password">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
                                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                        <input type="password" class="form-control" id="pwd"
                                               placeholder="New Password Again">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br><br></div>
                        <div class="row">
                            <form role="form">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                                    <button type="button" class="btn btn-danger">Delete Account</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br><br><br><br></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop