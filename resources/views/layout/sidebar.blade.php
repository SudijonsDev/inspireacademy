@if (!Auth::guest())
    <!-- sidebar nav -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav nav-pills nav-stacked">

                    @if(Auth::user()->admin == 'Y')
                        <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#adminMenu">Administration</span>
                        <div id="adminMenu" class="collapse in">
                            <li><a href="{!!URL::route('centres')!!}">Centres</a></li>
                            <li><a href="{!! URL::route('learners') !!}">Learners</a> </li>
                            <li><a href="{!!URL::route('subjects')!!}">Subjects</a></li>
                            <li><a href="{!!URL::route('courses')!!}">Courses</a></li>
                        </div>
                        <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#reportMenu">Reports</span>
                        <div id="reportMenu" class="collapse in">
                            <li><a href="{!! URL::route('coursesPerSubject') !!}">Courses Per Subject</a> </li>
                            <li><a href="{!! URL::route('courseCentre') !!}">Learners Per Course and Centre</a> </li>
                            <li><a href="{!! URL::route('learnersPerCourse') !!}">Learners Per Course</a> </li>
                            <li><a href="{!! URL::route('learnersPerformance') !!}">Learners Performance</a> </li>
                        </div>
                    @else
                        <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#adminMenu">Administration</span>
                        <div id="adminMenu" class="collapse in">
                            <li><a href="{!! URL::route('learners') !!}">Learners</a> </li>
                        </div>
                        <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#reportMenu">Reports</span>
                        <div id="reportMenu" class="collapse in">
                            <li><a href="{!! URL::route('learnersPerformance') !!}">Learners Performance</a> </li>
                        </div>
                    @endif
                    <div><li><a href="{!!URL::route('logout')!!}">Logout</a></li></div>
                </ul>
            </div>
        </div>
    </nav>
@endif
