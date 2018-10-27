@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Edit Course</h1>

    </div>

    <div class="row">
        {!! Form::open(['action'=>['CoursesController@update',$course->CourseID],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group col-md-8">
            {{Form::label('Course Name', '', ['class' => 'awesome'])}}
            {{Form::text('CourseName',$course->CourseName,['class'=>'form-control','placeholder'=>'Course Name'])}}
            {{Form::label('Course Info', '', ['class' => 'awesome'])}}
            {{Form::textarea('CourseInfo',$course->CourseInfo,['class'=>'form-control','placeholder'=>'Course Info'])}}                   
            {{Form::label('CourseLogo', '', ['class' => 'awesome'])}}        
            {{Form::file('CourseLogo')}}<br>
            {{Form::hidden('_method','PUT')}} 

            <h3>In This Course Have <span class="badge">{{count($course->students)}}</span> Students</h3>
            {{Form::submit('Save',['class'=>'btn btn-primary'])}}

        </div>
        {!! Form::close() !!}

    </div>

    @endsection