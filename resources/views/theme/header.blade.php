<div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

    </button>
    <a class="navbar-brand" href="/">The <i class="fa fa-university"></i>School</a>        
</div>
<div class="pull-right">
    <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">                                  
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">          
                {{ Auth::user()->name }}  , {{ Auth::user()->role }}

                <img src="/storage/usersimages/{{ Auth::user()->profilelogo }}" style="width:50px;">
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Logout  
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @if(Auth::user()->role == "sale")
                @else
                <li>
                    <a href="/users/{{ Auth::user()->id}}"><i class="fa fa-user fa-fw"></i>Profile</a>
                </li>
                @endif
            </ul>

            </div>
            <!-- /.navbar-top-links -->
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">      
                    <li><a href="/">School</a></li>    
                    @if(Auth::user()->role == 'sale')
                    @else
                    <li><a href="/admin">Administration</a></li>         
                    @endif
                </ul>
                {{--  -----  --}}

