@extends('base_profile_page')

@section('profile_content')

    <div class="row">
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xs-offset-3">
            <table class="table table-hover table-responsive">
                <tr>
                    <th>User Statistics</th>
                </tr>
                <tr>
                    <td>Member Since: {{$base_info['member_since_date']}}</td>
                </tr>
                <tr>
                    <td>Number of Reviews: {{$base_info['total_reviews']}}</td>
                </tr>
                <tr>
                    <td>Number of Helpful Reviews: {{ $base_info['total_usefulness'] }}</td>
                </tr>
<!--                 <tr>
                    <td>Karma Points: [not implemented yet]</td>
                </tr> -->
            </table>
        </div>
    </div>

@stop