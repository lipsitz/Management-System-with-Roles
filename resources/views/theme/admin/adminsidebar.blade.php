<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav pull-left">

        <ul class="nav navbar-top-links" id="users-side-menu">
            <h2> Administrators<a  class="btn btn-success pull-right" data-toggle="collapse" data-target="#register">
                    <span class="glyphicon glyphicon-plus"></span> 
                </a></h2>
            <div>                            
                @if(count($users) > 0 ) 
                <?php $var = 0; ?> 
                @foreach($users as $user)
                {{--  hidden owner information  --}}
                @if(Auth::user()->role == "manager" && $user->role=="owner")
                @else

                @if($var<6)
                <a href="/users/{{$user->id}}">
                    <li class="user_li">
                        <img class="img_li" src="/storage/usersimages/{{$user->profilelogo}}">
                        <p> Name: {{$user->name}}<br>
                            <small>Phone: {{$user->phone}}</small></p>
                    </li>
                </a>
                <hr>
                <?php $var++; ?>     
                @else
                @endif
                @endif
                @endforeach
                @else       
                @endif  
            </div>                   
        </ul>
    </div>              
</div>

