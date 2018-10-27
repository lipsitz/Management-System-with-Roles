<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="students-side-menu">


            <h3>Students<span>
                    <a href="/students/create" class="btn btn-success "id="add-stu-btn">
                        <span class="glyphicon glyphicon-plus"></span> 
                    </a>

                </span></h3>                    
            <div>                           
                @if(count($students) > 0 ) 
                <?php $var = 0; ?> 
                @foreach($students as $student)
                @if($var<7)
                <a href="/students/{{$student->StudentID}}">
                    <li class="student_li">
                        <img class="student_img" src="/storage/studentsimages/{{$student->StudentLogo}}" style="width: 50px; margin-right: 10px">
                        <p>{{$student->StudentName}}<br>
                            <small>{{$student->StudentPhone}}</small>
                        </p>
                    </li>
                </a>
                <?php $var++; ?>     
                @else
                @endif
                @endforeach
                @else


                @endif  
            </div>


        </ul>
    </div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="courses-side-menu">


            <h3>Courses<span>
                    @if(Auth::user()->role == 'sale')
                    @else
                    <a href="/courses/create" class="btn btn-success "id="add-stu-btn">
                        <span class="glyphicon glyphicon-plus"></span> 
                    </a>
                    @endif
                </span></h3>
            <div>

                @if(count($courses) > 0)
                <?php $num = 0; ?> 
                @foreach($courses as $course)
                @if($num<7)
                <li class="settings-block">
                    <img src="/storage/coursesimages/{{$course->CourseLogo}}" style="width:50px; margin-right: 10px">
                    <a href="/courses/{{$course->CourseID}}"><i></i>{{$course->CourseName}} <span class="badge">{{count($course->students)}}</span></a>
                </li>
                <?php $num++; ?>     
                @else
                @endif
                @endforeach
                @else


                @endif  
            </div>


        </ul>
    </div>

    <!-- /.sidebar-collapse -->
    <div style="float:left;margin: 35px 0px 0px 30px;display: inline-flex;">
        <a href="/courses"class="btn btn-warning" style="margin:4px 26px 3px 0px;">All Courses</a>
        <a href="/students"class="btn btn-primary"style="margin:4px 28px 3px 27px;">All Students</a>
    </div>
</div>

