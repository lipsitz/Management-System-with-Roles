@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Add New Student</h1>

    </div>

</div>
<div class="row">
    {!! Form::open(['action'=>'StudentsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group col-md-8">
        {{Form::label('Student Name', '', ['class' => 'awesome'])}}
        {{Form::text('StudentName', '',['class'=>'form-control','placeholder'=>'student name'])}}
        {{Form::label('Student Email', '', ['class' => 'awesome'])}}
        {{Form::email('StudentEmail', '',['class'=>'form-control','placeholder'=>'student Email'])}}
        {{Form::label('Student Phone', '', ['class' => 'awesome'])}}
        {{Form::number('StudentPhone', '',['class'=>'form-control','placeholder'=>'student Phone'])}}



        <div class="row">
            <h3>Courses List</h3>
            @if(count($courses) > 0) 
            @foreach($courses as $course)
            <input type="checkbox" name="courses[]" value="{{$course->CourseID}}"> {{$course->CourseName}}<br>
            @endforeach
            @else
            <p>no courses found </p>

            @endif  
        </div>  

        {{Form::label('Student Profile Picture', '', ['class' => 'awesome'])}}        
        {{Form::file('StudentLogo')}}



        {{Form::submit('Add',['class'=>'btn btn-primary'])}}

    </div>
    {!! Form::close() !!}

</div>
@endsection