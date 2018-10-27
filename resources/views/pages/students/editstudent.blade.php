@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-6">

        <h1 class="page-header">Edit Student</h1>

    </div>

</div>
<div class="row">
    {!! Form::open(['action'=>['StudentsController@update',$student->StudentID],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group col-md-8">
        {{Form::label('Student Name', '', ['class' => 'awesome'])}}
        {{Form::text('StudentName', $student->StudentName,['class'=>'form-control','placeholder'=>'student name'])}}
        {{Form::label('Student Email', '', ['class' => 'awesome'])}}
        {{Form::email('StudentEmail', $student->StudentEmail,['class'=>'form-control','placeholder'=>'student Email'])}}
        {{Form::label('Student Phone', '', ['class' => 'awesome'])}}
        {{Form::number('StudentPhone', $student->StudentPhone,['class'=>'form-control','placeholder'=>'student Phone'])}}
        {{Form::hidden('_method','PUT')}}



        <div class="row">
            <h3>Courses List</h3>
            @if(count($courses) > 0) 
            @foreach($courses as $course)
            @if(in_array($course->CourseID , $courses2))

            <input type="checkbox" checked  name="courses[]" $courses null  value="{{$course->CourseID}}"> {{$course->CourseName}}<br>
            @else
            <input  type="checkbox"  name="courses[]" value="{{$course->CourseID}}"> {{$course->CourseName}}<br>
            @endif
            @endforeach
            @else
            <p>no courses found </p>

            @endif  
        </div>  

        {{Form::label('Student Profile Picture', '', ['class' => 'awesome'])}}        
        {{Form::file('StudentLogo',['value'=>'$student->StudentLogo'])}}

        {{Form::submit('Save',['class'=>'btn btn-primary'])}}

    </div>
    {!! Form::close() !!}

</div>
@endsection