@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/main_page.css') !!}
@stop

@section('content')
        @if (session('status'))
            <div class="alert alert-success" id="alertMessage">{{ session('status') }}</div>
        @endif

        <div id="main_label" class="row center-block">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title" align="center">Lazer Reviews</div>
            </div>
        </div>
        <div class="row">            
            <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-sm-10 col-md-8 col-lg-6">
                <div class="form-group">
                    <label for="inputlg"></label>
                    <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product" onchange="updateSearchBox()">
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
        </div>

        <script>
        function updateSearchBox() 
        {            
            var query = document.getElementById('inputlg');
            var dropdown = document.getElementById('dropdown-search');

            var div = document.createElement('div');
            div.className = 'suggestion';
            div.innerHTML = "<p>" + query.value + "</p>";
            dropdown.appendChild(div);

        }
        </script>
@stop

