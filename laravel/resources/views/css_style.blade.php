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

    .testbutton {
        font-family: 'Lato';
        color: #628C9E !important;
        font-size: 20px;
        text-shadow: 2px 1px 1px #ADC6DE;
        box-shadow: 1px 1px 1px #F7F9F9;
        padding: 24px 14px;
        -moz-border-radius: 40px;
        -webkit-border-radius: 40px;
        border-radius: 40px;
        border: 1px solid #BFBDBD;
        background: #FFFFFF;
    }

    .testbutton:hover {
        color: #5EA6F7 !important;
        background: #FAF9F5;
    }

    * {
        margin: 0;
    }

    .wrapper {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -155px; /* the bottom margin is the negative value of the footer's height */
    }
    .footer, .push {
        height: 155px; /* .push must be the same height as .footer */
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

    .title {

        font-size: 70px;
    }

    .btn-circle {
        width: 70px;
        height: 70px;
        padding: 10px 10px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 35px;
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