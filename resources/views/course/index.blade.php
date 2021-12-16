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
                    <a href="course/add" role="button" class="btn btn-default">Add New Course</a>
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
                        <th>Subject</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <!-- Course Name -->
                                <td class="table-text">
                                    <div>{{ $course->name }}</div>
                                </td>

                                <!-- Grade -->
                                <td class="table-text">
                                    <div>{{ $course->grade }}</div>
                                </td>

                                <!-- Subject -->
                                <td class="table-text">
                                    <div>{{ $course->subject_id }}</div>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            {!! Form::model($course, ['method' => 'GET', 'route' => ['editCourse',
                                            $course->id]]) !!}
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fa fa-trash"></i> Edit </button>
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
