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

    img {
        height: 50%;
        width: 50%;
    }

    p {
        display: line; 
        font-weight: bold;
        text-align: center;
    }

    a {
        font-weight: bold;
        font-family: 'Lato';
    }

    table {
        text-align: left;
    }

    h1, h3, h4, thead, td {
        font-weight: bold;
        text-align: center;
    }

    th, tr, label, input {
        font-weight: bold;
        font-size: 20px;
    }

    .rowHeight {
        width: 100%;
        height:45px;                 
    }

    .tableHeight {
        height:400px;              
    }

    .tbodyHeight {
        overflow-y: auto;      
        height: 300px;            
        width: 100%;
    }

    .leftWidth {
        text-align: left;
        width: 83%;
        vertical-align: middle;
    }

    .rightWidth {
        text-align: left;
        width: 17%;
        vertical-align: middle;
    }

    .alignRight {
        text-align: right;
    }

    .greenBtn {
        font-weight: bold;
        color: #00ff00;
    }

    .redBtn {
        font-weight: bold;
        color: #ff0000;
    }

    .inline {
        display: inline;
    }

    .container {
        text-align: center;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .vcenter {
        position: absolute;
        top: 40%;
        left:50%;
        transform: translate(-50%,-50%);
    }

    .title {
        text-align: center;
        font-size: 70px;
    }

    .textStyle {
        text-align: left;
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

    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      background: red;
      cursor: inherit;
      display: block;
    }
    input[readonly] {
      background-color: white !important;
      cursor: text !important;
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

    #name_banner{
        background-color: #d9edf7;
    }

</style>