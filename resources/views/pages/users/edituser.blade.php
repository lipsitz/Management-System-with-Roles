@extends('theme.admin.admindefault')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Edit User</h1>

    </div>

</div>
<div class="row">
    {!! Form::open(['action'=>['UsersController@update',$user->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group col-md-8">
        {{Form::label('User Name', '', ['class' => 'awesome'])}}
        {{Form::text('name', $user->name,['class'=>'form-control','placeholder'=>'user name'])}}
        {{Form::label('User Email', '', ['class' => 'awesome'])}}
        {{Form::email('email', $user->email,['class'=>'form-control','placeholder'=>'user Email'])}}
        {{Form::label('User Phone', '', ['class' => 'awesome'])}}
        {{Form::number('phone', $user->phone,['class'=>'form-control','placeholder'=>'user Phone'])}}<br>
        {{Form::hidden('_method','PUT')}}
        @if(Auth::user()->id==$user->id)
        {{Form::label('Role', '', ['class' => 'awesome'])}}<br>
        {{Form::select('role', array($user->role => $user->role))}}<br><br>
        @else
        {{Form::label('Role', '', ['class' => 'awesome'])}}<br>
        {{Form::select('role', array('manager' => 'manager', 'sale' => 'sale'))}}<br><br>
        @endif

        {{Form::label('User Profile Picture', '', ['class' => 'awesome'])}}        
        {{Form::file('profilelogo')}}<br><br>



        {{Form::submit('submit',['class'=>'btn btn-primary'])}}

    </div>
    {!! Form::close() !!}

</div>
@endsection