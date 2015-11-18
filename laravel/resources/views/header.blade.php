
	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	    <a href="#" class="navbar-brand"><b>Lazer Reviews</b></a>
	    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>
	    <div class="collapse navbar-collapse navHeaderCollapse">
	        <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a href="#"><b>Home</b></a></li>
	            <li class="dropdown">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
	                <ul class="dropdown-menu">
	                    @if(Auth::check())
                            <li><a href="{{ url('/profile') }}"><b>Go to my account</b></a></li>
	                        <li><a href="{{ url('/auth/logout') }}"><b>Logout</b></a></li>
                        @else
                            <li><a href="{{ url('/auth/facebook') }}"><b>Facebook Login</b></a></li>
                            <li><a href="{{ url('/auth/google') }}"><b>Google Login</b></a></li>
                        @endif
	                </ul>
	            </li>
	        </ul>
	    </div>
    </div>
