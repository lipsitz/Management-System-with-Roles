@extends('theme.default')



{{--  main content  --}}

@section('content')
<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Index</h1>

    </div>

</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
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


    <div class="col-lg-6 col-md-6">
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
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif


</div>
@endsection