@extends('theme.admin.admindefault')




{{--  main content  --}}
@section('content')

<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header"><i class="fa fa-android"></i> Administration</h1>

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3"style="font-size: 4em;">
                        <i class="fa fa-android"></i>
                    </div>
                    <div class="col-xs-9">
                        <div class="huge">{{count($users)}}</div>
                        <div>Administrators</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#register">Register New User</button>
<div id="register" class="collapse"><br>
    <form class="form-horizontal" method="POST" action="{{route('register_me')}}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        {{--  phone  --}}
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="col-md-4 control-label">phone</label>

            <div class="col-md-6">
                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
        </div>

        {{--  role  --}}

        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
            <label for="role" class="col-md-4 control-label">role</label>

            <div class="col-md-6">
                <select name="role"required autofocus>
                    <option value="manager">manager</option>
                    <option value="sale">sale</option>
                </select>
                @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        {{--  default image  --}}
        <div class="form-group{{ $errors->has('profilelogo') ? ' has-error' : '' }}">
            <label for="profilelogo" class="col-md-4 control-label">Gender</label>

            <div class="col-md-6">
                <select name="profilelogo"required autofocus>
                    <option value="noimage.jpg">Male</option>
                    <option value="female.jpg">Female</option>
                </select>
                @if ($errors->has('profilelogo'))
                <span class="help-block">
                    <strong>{{ $errors->first('profilelogo') }}</strong>
                </span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</div>
<div class="panel-body">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr class="info">
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th> Phone</th>
                <th> Role</th>
                <th>Create Date</th>
                <th>Last Update</th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0) 
            @foreach($users as $user)
            {{--  hidden owner information  --}}
            @if(Auth::user()->role == "manager" && $user->role=="owner")
            @else
            <tr class="odd gradeX">
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <th>
                    {{--  hidden delete himself  --}}
                    @if(Auth::user()->id==$user->id && Auth::user()->role == "manager")
                    <a href="/users/{{$user->id}}/edit" class="btn btn-info btn-xs "> <i class="fa fa-pencil"></i></a>
                    <a href="/users/{{$user->id}}"class="btn btn-success btn-xs"><i class="fa fa-user"></i> </a>  

                    @else
                    {!!Form::open(['action' => ['UsersController@destroy',$user->id],'method'=> 'POST','class'=>'pull-right','onsubmit'=>'return confirm("are you sure ? ")'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button type="submit"class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> </button>                                    
                    {!!Form::close()!!}
                    <a href="/users/{{$user->id}}/edit" class="btn btn-info btn-xs "> <i class="fa fa-pencil"></i></a>
                    <a href="/users/{{$user->id}}"class="btn btn-success btn-xs"><i class="fa fa-user"></i> </a> 
                    @endif
                </th>
            </tr>                
            @endif
            @endforeach
        </tbody>
    </table>
    @else
    <p>no student found <p>

        @endif 


</div>
@endsection