<!-- app/views/reports/subjectAndCourses.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Courses Per Subject Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Courses Per Subject</h4>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($subjectAndCourses) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Subject</th>
                        <th>Courses</th>
                        <th></th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($subjectAndCourses as $value)
                            <tr>
                                <!-- Subject -->
                                <td class="table-text">
                                    <div>{{ $value->subject }}</div>
                                </td>

                                <!-- Course Name -->
                                <td class="table-text">
                                    <div>{{ $value->course_created }}</div>
                                </td>

                                <td>
                                    <div></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <div class="alert alert-info" role="alert">No courses has been created</div>
                @endif
            </table>
        </div>
    </div>
@endsection
