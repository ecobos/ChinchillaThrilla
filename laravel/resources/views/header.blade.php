
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
	                <a href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
	                <ul class="dropdown-menu">
	                    @if(Auth::check())
                            <li>{{ link_to('/profile', 'Go to my account') }}</li>
	                        <li>{{ link_to('/auth/logout', 'Logout') }}</li>
                        @else
                            <li>{{ link_to('/auth/facebook', 'Facebook Login') }} </li>
                            <li>{{ link_to('/auth/google', 'Google Login') }}</li>
                        @endif
	                </ul>
	            </li>
	        </ul>
	    </div>
    </div>
