@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header"><i class="fa fa-book"></i> All courses</h1>

    </div>
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"style="font-size: 4em;">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{count($courses)}}</div>
                            <div>COURSES</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr class="warning">
                    <th>Course Name</th>
                    <th>Course Info</th>
                    <th>Create Date</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($courses) > 0) 
                @foreach($courses as $course)

                <tr class="odd gradeX">
                    <td>{{$course->CourseName}}</td>
                    <td>{{$course->CourseInfo}}</td>
                    <td>{{$course->created_at}}</td>
                    <td>{{$course->updated_at}}</td>
                    @if(Auth::user()->role == 'sale')
                    <th>
                        <a href="/courses/{{$course->CourseID}}"class="btn btn-success btn-xs"><i class="fa fa-puzzle-piece"></i> </a>
                    </th>
                    @else
                    <th>                              
                        {!!Form::open(['action' => ['CoursesController@destroy',$course->CourseID],'method'=> 'POST','onsubmit'=>'return confirm("are you sure ? ")'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <button type="submit"class="btn btn-danger btn-xs pull-right">                                   
                            <i class="fa fa-trash"></i>
                        </button> 
                        {!!Form::close()!!}
                        <a href="/courses/{{$course->CourseID}}/edit" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a> 
                        <a href="/courses/{{$course->CourseID}}"class="btn btn-success btn-xs"><i class="fa fa-puzzle-piece"></i> </a>                              
                    </th>  
                    @endif        
                </tr>                

                @endforeach
            </tbody>
        </table>
        @else
        <p>no courses found <p>

            @endif 


    </div>

    @endsection