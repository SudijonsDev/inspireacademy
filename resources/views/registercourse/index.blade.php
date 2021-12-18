<!-- app/views/registercourse/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Register Course Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Registered Courses for {{ $learner->name }} {{ $learner->surname }}</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="courses" role="button" class="btn btn-default">Register A Course</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($registered_courses) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Action</th>
                    <th></th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($registered_courses as $reg_course)
                            <tr>
                                <!-- Course Name -->
                                <td class="table-text">
                                    <?php
                                    $course = \App\Models\Course::where('id', '=', $reg_course->course_id)->first();
                                    $subject = \App\Models\Subject::where('id', '=', $course->subject_id)->first();
                                    ?>
                                    <div>{{ $subject->name }}</div>
                                </td>

                                <td>
                                    <div class="col-md-6">
                                        <div class="col-md-3">
                                            <a href="{!!URL::route('deRegister', [$reg_course->id]) !!}" class="btn btn-danger"
                                               onclick="return confirm('Are you sure about deregistering the course?');">Deregister</a>
                                        </div>

                                        <div class="col-md-3">
                                            {!! Form::model($reg_course, ['method' => 'GET', 'route' => ['addSession',
                                            $reg_course->id]]) !!}
                                            <button type="submit" class="btn btn-warning"> Session </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <div class="alert alert-info" role="alert">You haven't registered any course yet</div>
                @endif
            </table>
        </div>
    </div>
@endsection
