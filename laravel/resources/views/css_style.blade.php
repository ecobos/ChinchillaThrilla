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

    p {
       display: line; 
    }

    table {
        text-align: left;
    }

    h1, h3, th, thead, td {
        font-weight: bold;
        text-align: center;
    }

    th, tr {
        font-size: 20px;
    }

    .inline {
        display: inline;
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

    .textStyle {
        font-weight: normal;
        font-size: 12px;
        font-family: 'verdana';
    }

    .textStyle2 {
        display: inline;
        font-weight: normal;
        font-size: 12px;
        font-family: 'verdana';
    }

    .flagStyle {
        font-weight: normal;
        font-size: 25px;
        color: red;
        margin: 1%;
    }

    .centerImage
    {
        text-align:center;
        display:block;
    }

    .rating {
        width:300px;
        margin-right: auto;
        margin-left: auto;
    }
    .rating span { float:right; position:relative; }
    .rating span input {
        position:absolute;
        top:0px;
        opacity:0;
    }
    .rating span label {                
        display:inline-block;
        width:30px;
        height:30px;
        left: 00px;
        text-align:center;
        color:#FFF;
        background:#ccc;
        font-size:30px;
        margin-right:10px;
        line-height:30px;
        border-radius:50%;
        -webkit-border-radius:50%;
    }
    .rating span:hover ~ span label,
    .rating span:hover label,
    .rating span.checked label,
    .rating span.checked ~ span label {
        background:#81AAD9;
        color:#FFF;
    }

</style>