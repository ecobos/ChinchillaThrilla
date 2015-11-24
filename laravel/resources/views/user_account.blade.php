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
                <div class="tab-pane active" id="tab1">
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
                                        Number of Helpful Reviews: [not implemented yet]
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
                <div class="tab-pane" id="tab2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover table-responsive tableBorderless">
                            <tbody>






                                    @foreach($reviews as $review)
                            <tr>
                                <td bgcolor="#F2F2F2">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                            <img src="{{ $review->prod_img_path }}"
                                                 class="img-responsive" align="middle">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <p class="textStyle"><a href="products/{{ $review->prod_id }}">{{ $review->prod_name }}</a></p>

                                            <p class="textStyle" vertical-align="center">
                                                {{ $review->review_text }}
                                            </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
                                            <a class="textStyle2" href="profile">Delete Review</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab 3 Content -->
                <div class="tab-pane" id="tab3">

                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2"></div>
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10">
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
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
                        <label for="brand">Update Email Address</label>

                        <div class="row">
                            <form role="form">
                                <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                    <input type="email" class="form-control" id="email"
                                           placeholder="{{ $base_info['email'] }}">
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