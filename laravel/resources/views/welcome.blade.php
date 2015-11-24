@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/main_page.css') !!}
@stop

@section('content')

        <div id="main_label" class="row center-block">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title" align="center">Lazer Reviews</div>
            </div>
        </div>
        <form method="GET" action="/search/results">
            <div class="row">            
                <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
                <div class="col-xs-10 col-sm-10 col-md-8 col-lg-6">
                    <div class="input-group">
                        <label for="inputlg"></label>
                        <input type="hidden" name="type" value="product"/>
                        <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product" onchange="updateSearchBox()" name="query">
                        <span class="input-group-btn">
                            <button id="searchBtn" class="btn btn-default btn-lg" type="submit">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>

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

