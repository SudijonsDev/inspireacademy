<!-- app/views/reports/learnersCentreCourse.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Learners Per Course and Subject Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>List of Learners Per Course and Centre</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="learnerCentCour" role="button" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($courseCentre) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Learner</th>
                        <th>Course</th>
                        <th>Centre</th>
                        <th></th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($courseCentre as $value)
                            <tr>
                                <!-- Learner -->
                                <td class="table-text">
                                    <div>{{ $value->learner }}</div>
                                </td>

                                <!-- Course Name -->
                                <td class="table-text">
                                    <div>{{ $value->course }}</div>
                                </td>

                                <!-- Centre Name -->
                                <td class="table-text">
                                    <div>{{ $value->centre }}</div>
                                </td>

                                <td>
                                    <div></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <div class="alert alert-info" role="alert">No learners for selected course and centre</div>
                @endif
            </table>
        </div>
    </div>
@endsection
