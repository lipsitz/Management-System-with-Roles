@extends('theme.default')




{{--  main content  --}}

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-book"></i> {{$course->CourseName}}</h1>      
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"style="font-size: 4em;">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{count($course->students)}}</div>
                            <div>Students Learn {{$course->CourseName}}</div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role == 'sale')
@else
<div class="row"> 
    {!!Form::open(['action' => ['CoursesController@destroy',$course->CourseID],'method'=> 'POST','onsubmit'=>'return confirm("are you sure ? ")'])!!}
    {{Form::hidden('_method', 'DELETE')}}<button type="submit"class="btn btn-danger pull-right">Delete</button>                                   
    <a type="button" href="/courses/{{$course->CourseID}}/edit" class="btn btn-info">Edit</a>                                           
</div>
@endif
<div class="row">
    <div class="well">
        <img src="/storage/coursesimages/{{$course->CourseLogo}}"style="width:100px; margin-right: 10px"><br>
        <h3>Name: {{$course->CourseName}}</h3>
        <h4>Info: {{$course->CourseInfo}}</h4>  
        @if(count($course->students)>0)
        <div style="display:inline">
            <h2>Students In This Course <span class="badge">{{count($course->students)}}</span><h2>
                    @foreach($course->students as $student)

                    <a href="/students/{{$student->StudentID}}"><small>{{$student->StudentName}}</small></a>
                    <img class="cs-images" src="/storage/studentsimages/{{$student->StudentLogo}}">


                    @endforeach
                    </div>
                    @else
                    <p>No Students Found</p>
                    @endif
                    </div>
                    </div>
                    @endsection