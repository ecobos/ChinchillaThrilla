@extends('base_profile_page')


@section('profile_content')

        <!-- Page Content -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">My Statistics</a></li>
                <li><a href="#tab2" data-toggle="tab">My Reviews</a></li>
                <li><a href="#tab3" data-toggle="tab">Account Settings</a></li>
            </ul>
            <div class="tab-content">

                <!-- Tab 1 Content -->
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-hover table-responsive tableBorderless">
                        <tbody>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        Member Since: {{$base_info['member_since_date']}}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        Number of Reviews: {{$base_info['total_reviews']}}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        Number of Helpful Reviews: {{ $base_info['total_usefulness'] }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        Karma Points: [not implemented yet]
                                    </p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tab 2 Content -->
                <div class="tab-pane fade" id="tab2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover table-responsive tableBorderless">
                            <tbody>

                            @foreach($reviews as $review)
                                <tr id="section-{{ $review->prod_id }}">
                                    <td bgcolor="#F2F2F2">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                                <img src="{{ $review->prod_img_path }}"
                                                     class="img-responsive" align="middle">
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                <p class="textStyle"><a
                                                            href="products/{{ $review->prod_id }}">{{ $review->prod_name }}</a>
                                                </p>

                                                <p class="textStyle" vertical-align="center">
                                                    {{ $review->review_text }}
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                                <a class="textStyle2" data-toggle="modal" data-target="#confirmModal"
                                                   data-val="{{ $review->prod_id }}">Delete Review</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirm Review Delete</h4>
                            </div>
                            <div class="modal-body">
                                Please confirm that you want to delete this review. This action is permanent and <b>cannot</b>
                                be undone!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button id="doDelete" class="btn btn-danger" data-dismiss="modal">Permanently Delete!</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tab 3 Content -->
                <div class="tab-pane fade" id="tab3">
                    <table class="table table-hover table-responsive tableBorderless">
                        <tbody>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        E-mail: {{$base_info['email']}}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#F2F2F2">
                                <div class="row">
                                    <p class="textStyle" vertical-align="center" align="center">
                                        Authenticated with: {{$base_info['auth_type']}}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <form role="form">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                                <button type="button" class="btn btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>

@stop