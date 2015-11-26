
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <a href="{!! url('/') !!}" class="navbar-brand"><b>Lazer Reviews</b></a>
	    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>
	    <div class="collapse navbar-collapse navHeaderCollapse">
	        <ul class="nav navbar-nav navbar-right">
	            @if(Auth::check())
					<li><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"> Logged In</span></li>
				@else
					<li><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"> Logged Out</span> </li>
				@endif

	            <li class="dropdown">
	                <a href="{!! url('/') !!}" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
	                <ul class="dropdown-menu">
	                    @if(Auth::check())
							@if(App\Admin::find(Auth::id()) != null )
								<li>{!! link_to('/profile/admin', 'Go to admin panel') !!}</li>
							@endif

                            <li>{!! link_to('/profile', 'Go to my account') !!}</li>
                            <li>{!! link_to('/addproduct', 'Add a new product') !!} </li>
	                        <li>{!! link_to('/auth/logout', 'Logout') !!}</li>
                        @else
                            <li>{!! link_to('/auth/facebook', 'Facebook Login') !!}</li>
                            <li>{!! link_to('/auth/google', 'Google Login') !!}</li>
                        @endif
	                </ul>
	            </li>
	        </ul>
	    </div>
    </div>
