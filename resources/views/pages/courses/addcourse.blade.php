@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Add New Course</h1>

    </div>

    <div class="row">
        {!! Form::open(['action'=>'CoursesController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group col-md-8">
            {{Form::label('Course Name', '', ['class' => 'awesome'])}}
            {{Form::text('CourseName', '',['class'=>'form-control','placeholder'=>'Course Name'])}}
            {{Form::label('Course Info', '', ['class' => 'awesome'])}}
            {{Form::textarea('CourseInfo', '',['class'=>'form-control','placeholder'=>'Course Info'])}}

            {{Form::label('CourseLogo', '', ['class' => 'awesome'])}}        
            {{Form::file('CourseLogo')}}<br>



            {{Form::submit('Add',['class'=>'btn btn-primary'])}}

        </div>
        {!! Form::close() !!}

    </div>

    @endsection