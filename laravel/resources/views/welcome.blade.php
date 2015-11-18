<!DOCTYPE html>
<html>
    <head>
        <title>Lazer Reviews</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                color: black;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 70px;
            }

            .suggestion {
                border-bottom: 1px solid #000;
                border-left: 1px solid #000;
                border-right: 1px solid #000;
                text-align: left;
            }

            .suggestion:hover {
                background: #F0F8FF;
            }

        </style>


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


    </head>
    <body>

        <div class="container">
            @include('header')
            <div class="content">
                <div class="title">Lazer Reviews</div>
            </div>
            <div class="form-group">
                <label for="inputlg"></label>
                <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product" onchange="updateSearchBox()">
                <div class="col-lg-12" id="dropdown-search"></div>
            </div>
        </div>
    </body>
</html>
