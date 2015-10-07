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
        </style>
    </head>
    <body>
        <div class="container">

            <div class="content">
                <div class="title">Lazer Reviews</div>
            </div>
            <div class="form-group">
                <label for="inputlg"></label>
                <input class="form-control input-lg" id="inputlg" type="text" placeholder="Search for a Product">
            </div>
        </div>
    </body>
</html>
