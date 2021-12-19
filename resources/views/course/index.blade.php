<!-- app/views/course/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Course Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Current Courses</h4>
                </div>
                <div class="col-xs-6 text-right">
                    @if($isLearner == 'N')
                        <a href="course/add" role="button" class="btn btn-default">Add New Course</a>
                    @else
                        <a href="regcourses" role="button" class="btn btn-default">Back</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($courses) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <!-- Course Name -->
                                <td class="table-text">
                                    <?php
                                        $subject = \App\Models\Subject::where('id', '=', $course->subject_id)->first();
                                    ?>
                                    <div>{{ $subject->name }}</div>
                                </td>

                                <!-- Grade -->
                                <td class="table-text">
                                    <div>{{ $course->grade }}</div>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            @if($isLearner == 'N')
                                                {!! Form::model($course, ['method' => 'GET', 'route' => ['editCourse',
                                                    $course->id]]) !!}
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fa fa-trash"></i> Edit </button>
                                            @else
                                                <a href="{!!URL::route('registerLearner', ['id' => $course->id])!!}"
                                                    class="btn btn-warning">Register</a>
                                            @endif
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <div class="alert alert-info" role="alert">No courses available</div>
                @endif
            </table>
        </div>
    </div>
@endsection
