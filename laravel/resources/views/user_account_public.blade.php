@extends('base_profile_page')

@section('profile_content')

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th align="center">Member Since: {{$base_info['member_since_date']}}</th>
                </tr>
                </thead>
                <tbody>
                <table class="table table-responsive">
                    <tr>
                        <td>Number of Reviews: {{$base_info['total_reviews']}}</td>
                    </tr>
                    <tr>
                        <td>Number of Helpful Reviews: [not implemented yet]</td>
                    </tr>
                    <tr>
                        <td>Karma Points: [not implemented yet]</td>
                    </tr>
                </table>
                </tbody>
            </table>
        </div>
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
    </div>

@stop