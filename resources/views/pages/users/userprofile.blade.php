@extends('theme.admin.admindefault')



{{--  main content  --}}

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$user->name}}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"style="font-size: 4em;">
                            <i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{$user->name}}</div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="row"> 
    @if(Auth::user()->id==$user->id && Auth::user()->role == "manager")
    <a href="/users/{{$user->id}}/edit" class="btn btn-info">Edit</i></a> 
    @else
    {!!Form::open(['action' => ['UsersController@destroy',$user->id],'method'=> 'POST','class'=>'pull-right','onsubmit'=>'return confirm("are you sure ? ")'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    <button type="submit"class="btn btn-danger"> Delete</button>                                    
    {!!Form::close()!!}
    <a href="/users/{{$user->id}}/edit" class="btn btn-info">Edit</i></a> 
    @endif                                         
</div>
<div class="row">
    <div class="well">
        <img src="/storage/usersimages/{{$user->profilelogo}}"style="width:100px; margin-right: 10px"><br>

        <a  data-toggle="collapse" data-target="#editlogo">Edit Profile Picture</a>
        <div id="editlogo" class="collapse">
            {!! Form::open(['action'=>['UsersController@update',$user->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
            {{Form::file('profilelogo')}}
            {{Form::hidden('name', $user->name,['class'=>'form-control','placeholder'=>'user name'])}}
            {{Form::hidden('email', $user->email,['class'=>'form-control','placeholder'=>'user Email'])}}
            {{Form::hidden('phone', $user->phone,['class'=>'form-control','placeholder'=>'user Phone'])}}
            {{Form::hidden('role', $user->role,['class'=>'form-control','placeholder'=>$user->role])}}
            {{ method_field('PUT') }}
            {{Form::submit('submit')}}
            {!! Form::close() !!}
        </div>


        <h3>Name: {{$user->name}}</h3>
        <h3>Email: {{$user->email}}</h3>
        <h3>Phone: {{$user->phone}}</h3>
        <h3>Role: {{$user->role}}</h3>
        <small>Member Since :{{$user->created_at}}</small>

    </div>

</div>
@endsection