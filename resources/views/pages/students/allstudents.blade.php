@extends('theme.default')






{{--  main content  --}}

@section('content')

<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header"><i class="fa fa-graduation-cap"></i>All Students</h1>

    </div>
    <div class="row ">
        <div class="col-lg-12 col-md-6 pull-right">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"style="font-size: 4em;">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{count($students)}}</div>
                            <div>STUDENTS</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr class="info">
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Student Phone</th>
                    <th>Create Date</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($students) > 0) 
                @foreach($students as $student)

                <tr class="odd gradeX">
                    <td>{{$student->StudentID}}</td>
                    <td>{{$student->StudentName}}</td>
                    <td>{{$student->StudentEmail}}</td>
                    <td>{{$student->StudentPhone}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>{{$student->updated_at}}</td>
                    <th> 
                        {!!Form::open(['action' => ['StudentsController@destroy',$student->StudentID],'method'=> 'POST','onsubmit'=>'return confirm("are you sure ? ")'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <button type="submit"class="btn btn-danger btn-xs pull-right">                                   
                            <i class="fa fa-trash"></i>
                        </button>       
                        {!!Form::close()!!}
                        <a href="/students/{{$student->StudentID}}/edit" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="/students/{{$student->StudentID}}"class="btn btn-success btn-xs"><i class="fa fa-user"></i> </a> 
                    </th>
                </tr>                                       
                @endforeach
            </tbody>
        </table>
        @else
        <p>no student found <p>

            @endif 


    </div>

    @endsection