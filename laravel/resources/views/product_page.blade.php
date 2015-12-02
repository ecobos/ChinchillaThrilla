@extends('master_page')
@section('content')
<style> 
.loading {max-width: 50px;} 
</style>
        <script>

        var next = 1;


            function getReviews(skip, scroll)
            {
                $('#review-table').fadeOut('slow');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        if(scroll)
                            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
                        var reviews = JSON.parse(xmlhttp.responseText);
                        if(reviews.length == 0)
                        {
                            document.getElementById('review-table').innerHTML = "<h3>No reviews found for this product!</h3>";
                        }
                        else
                        {
                             $('#review-table').html('');
                            
                            for(var i=0; i<reviews.length; i++)
                            {
                                var user = reviews[i]['name'];
                                var image = reviews[i]['avatar'];
                                var review = reviews[i]['review_text'];
                                var user_id = reviews[i]['user_id'];

                                appendReviewElement(user, image, review, user_id);
                            }                            
                        }
                        $('#review-table').fadeIn('slow');
                        next = skip + 1;
                    }
                }
                xmlhttp.open('get', '/reviews/product/{{$prod_id}}/'+((skip-1)*3));
                xmlhttp.send();

                // Loading reviews
                //document.getElementById('review-table').innerHTML = "<div align='center'><br><img src='/images/loading.gif' width='50' class='loading'/></div>";
            }

            function appendReviewElement(user, image, review, user_id)
            {

                var tr = document.createElement('tr');
                var td = document.createElement('td');
                    td.style.backgroundColor = "#F2F2F2";
                var row = document.createElement('div');
                    row.className = "row";
                var img_parent = document.createElement('div');
                    img_parent.className = "col-xs-3 col-sm-3 col-md-2 col-lg-2";
                var img = document.createElement('img');
                    img.src = image;
                    img.className = "avatar user-review-image";
                var review_parent = document.createElement('div');
                    review_parent.className = "col-xs-9 col-sm-9 col-md-9 col-lg-9";
                var userp = document.createElement('p');
                    userp.className = "textStyle";
                var profile = document.createElement('a');
                    profile.href = "/profile/"+user_id;
                    profile.innerHTML = user;
                var reviewp = document.createElement('p');
                    reviewp.className = "textStyle";
                    reviewp.style.verticalAlign = "center";
                    reviewp.innerHTML = review;
                var divFlags = document.createElement('div');
                    divFlags.className = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
                    divFlags.style.textAlign ="right";



            @if (Auth::check())                
                var aflag = document.createElement('a');
                    aflag.href = 'javascript:void(0);';
                    aflag.innerHTML = "Report this review";
                    aflag.className = "textStyle";
                    aflag.setAttribute('user_id', user_id);
                    aflag.setAttribute('id', 'report_'+user_id);
                    aflag.onclick = function () {reportUser(this.getAttribute('user_id'));};
                var alike = document.createElement('a');
                    alike.href = 'javascript:void(0);';
                    alike.innerHTML = "\"Like\" this review";
                    alike.className = "textStyle";
                    alike.setAttribute('user_id', user_id);
                    alike.setAttribute('id', 'like_'+user_id);
                    alike.onclick = function (){likeReview(this.getAttribute('user_id'))};
                var abuff = document.createElement('span');
                    abuff.innerHTML = "&nbsp;|&nbsp;";
                    abuff.className = 'textStyle';
                    divFlags.appendChild(aflag);
                    divFlags.appendChild(abuff);
                    divFlags.appendChild(alike);
            @endif

                    
                img_parent.appendChild(img);
                userp.appendChild(profile);
                review_parent.appendChild(userp);
                review_parent.appendChild(reviewp);
                row.appendChild(img_parent);
                row.appendChild(review_parent);
                row.appendChild(divFlags);
                td.appendChild(row);
                tr.appendChild(td);
                document.getElementById('review-table').appendChild(tr);

            }

            function getNext()
            {
                getReviews(next);
            }


        @if (Auth::check())   
            function reportUser (user_id) 
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () 
                {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {    
                        $( "#report_"+user_id ).fadeOut( "fast", function() {                   
                            $( "#report_"+user_id ).html('<span style="color:red;">Review has been flagged</span>');
                            $( "#report_"+user_id ).fadeIn( "fast", function(){});
                        });
                    }
                };
                xmlhttp.open('POST', '/reviews/flag', true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send('user_id='+user_id + "&prod_id={{$prod_id}}");
            }

            function likeReview (user_id) 
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () 
                {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {    
                        $( "#like_"+user_id ).fadeOut( "fast", function() {                   
                            $( "#like_"+user_id ).html('<span style="color:green;">Review Liked</span>');
                            $( "#like_"+user_id ).fadeIn( "fast", function(){});
                        });
                    }
                };
                xmlhttp.open('POST', '/reviews/like', true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send('other_uid='+user_id + "&this_uid={{Auth::user()->user_id}}&prod_id={{$prod_id}}");
            }
        @endif


            

            
        </script> 
<!--         
            <div class="navbar navbar-inverse navbar-static-top" role="navigation">
                <a href="#" class="navbar-brand">Lazer Reviews</a>
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">MyAcount</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div> -->
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-5 col-lg-5"  align="center">
                        <img src= "{{$img_path}}" class="img-responsive main-product-image" />
                        <br><br>
                    @if($logged_in)
                        <a href="/review/{{$prod_id}}" class="btn btn-primary font-me">Review Me!</a>
                    @endif
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h1 align="center">{{ $name }}</h1>
                                <div class="reg">Model: {{$model}}</div>
                                <br>    
                            </div>
                            <div class="col-xs-11 col-sm-10 col-md-12 col-lg-12">
                                <div>
                                    <span><label class="unchecked" id="check1"></label></span>
                                    <span><label class="unchecked" id="check2"></label></span>
                                    <span><label class="unchecked" id="check3"></label></span>
                                    <span><label class="unchecked" id="check4"></label></span>
                                    <span><label class="unchecked" id="check5"></label></span>
                                    <span><label class="unchecked" id="check6"></label></span>
                                </div>
                                </div>
                            <br/>
                            <div class="col-xs-11 col-sm-12 col-md-12 col-lg-12">
                                <p align="center">
                                    Total Rating: {{number_format($totalRating->rating, 2)}} ({{$totalRating->total}} votes)
                                </p>
                            </div>
                            <div class="col-xs-11 col-sm-12 col-md-12 col-lg-12">
                                <p align="center">
                                {{ $desc }}
                                </p>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-1 col-lg-1">
                    </div>
                </div>
                <br/><br/>
            @if($features['pros'] || $features['cons'])
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover table-responsive">
                            <thead>
                                    <tr align="center">
                                        <th class="success">Pros</th>
                                        <th class="danger">Cons</th>
                                    </tr> 
                            </thead>
                            <tbody> 
                                <table class="table table-responsive">
                                <tr><td >
                                <table width="80%">
                                        @for ($i=0; $i<sizeof($features['pros']); $i++)
                                        <tr>
                                           <td> {{ $features['pros'][$i]->feature_name }} </td>
                                           <td align="right"> 
                                                    {{$features['pros'][$i]->score}}
                                            </td>
                                        </tr>
                                        @endfor
                                </table>
                                </td>
                                <td>
                                <table width="80%" >
                                        @if (sizeof($features) > 1)
                                            @for ($i=0; $i<sizeof($features['cons']); $i++)
                                            <tr>
                                               <td> {{ $features['cons'][$i]->feature_name }} </td>
                                               <td align="right"> 
                                                        {{$features['cons'][$i]->score}}
                                                </td>
                                            </tr>
                                            @endfor
                                        @else
                                            <tr><td>&nbsp;</td></tr>
                                        @endif
                                </table>
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-warning" style="margin-top:10px;">Out of {{$features['cons'][0]->total_votes}} reviews</div>
                </div>
            @else
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                No features available yet for this product.
                </div>
                </div>
                <br>    
            @endif
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-hover table-responsive">
                        <thead>
                                    <tr>
                                        <th class="info">What people are saying about the product!</th>
                                    </tr> 
                            </thead>
                            <tbody id="review-table">                      
                        </tbody>
                    </table>
                </div> 
                <div id="review-nav">
                    <h2>
                    @for ($i = 0; $i < ceil($reviewCount / 3); $i++)
                        <a href="javascript:void(0);" onclick="getReviews({{ $i+1 }}, true)">{{ $i+1 }}</a> | 
                    @endfor
                        <a href="javascript:void(0);" onclick="getNext()">Next</a>
                    </h2>
                    <br><br>
                </div>
            </div>   
        </div>
    <br/>
    </body>

    <div class="navbar navbar-default navbar-fixed-bottom">
    <br>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <p >© 2015 - Site Built By Division Zero></p>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-4">
            <p align="center">                
                <a href="about">About</a>
                <a href="contact"><span style="margin-left:2em">Contact</span></a>
                <a href="privacyPolicy"><span style="margin-left:2em">PrivacyPolicy</span></a>
            </p>
        </div>

    </div>
    <div class="col-md-1 col-lg-1">
    </div>


    
    
</html>


<script>
getReviews(1, false);


var totalRating = {'rating' : {{$totalRating->rating}} , 'votes' : {{$totalRating->total}} };
console.log(totalRating);


for(var i=1; i<=Math.ceil(totalRating.rating); i++)
{
    document.getElementById('check'+i).className = 'checked';
}

</script>
@stop

