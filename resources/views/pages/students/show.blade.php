@extends('theme.default')




{{--  main content  --}}

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-graduation-cap"></i> {{$student->StudentName}}</h1> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3"style="font-size: 4em;">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="col-xs-9">
                        <div class="huge">{{$student->StudentID}}</div>
                        <div>{{$student->StudentName}} ID</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> 
    {!!Form::open(['action' => ['StudentsController@destroy',$student->StudentID],'method'=> 'POST','onsubmit'=>'return confirm("are you sure ? ")'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    <button type="submit"class="btn btn-danger pull-right">Delete </button>                                                                                                     
    {!!Form::close()!!}
    <a type="button" href="/students/{{$student->StudentID}}/edit" class="btn btn-info">Edit</a>  
</div>
<br>
<div class="row">
    <div class="well">
        <img src="/storage/studentsimages/{{$student->StudentLogo}}"style="width:100px; margin-right: 10px"><br>
        <h3>Name: {{$student->StudentName}}</h3>
        <h3>Email: {{$student->StudentEmail}}</h3>
        <h3>Phone: {{$student->StudentPhone}}</h3>

        <small>Member Since :{{$student->created_at}}</small><br>

        <div style="display:inline;">
            <h2>This Student Learn: <h2>
                    @if(count($student->courses)>0)
                    @foreach($student->courses as $course)
                    <a href="/courses/{{$course->CourseID}}">
                        <img class="cs-images" src="/storage/coursesimages/{{$course->CourseLogo}}">
                        {{$course->CourseName}}                       
                    </a>
                    @endforeach
                    @endif
                    </div>

                    </div>
                    </div>


                    @endsection