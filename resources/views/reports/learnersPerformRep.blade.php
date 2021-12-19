<!-- app/views/reports/learnersPerformRep.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Learners PerformancReporte  Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Learners' Performance Report</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="learnersPerformance" role="button" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($sessions) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Learner</th>
                        <th>Course</th>
                        <th>Average</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <!-- Learner -->
                            <td class="table-text">
                                <div>{{ $session->surname }} {{ $session->name }}</div>
                            </td>

                            <!-- Course Name -->
                            <td class="table-text">
                                <?php
                                    $subject = \App\Models\Subject::where('id', '=', $session->subject_id)->first();
                                ?>
                                <div>{{ 'Grade ' }} {{ $session->grade }} - {{ $subject->name }}</div>
                            </td>

                            <!-- Average -->
                            <td class="table-text">
                                <div>{{ number_format($session->marks), 2 }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <div class="alert alert-info" role="alert">No learners' preformance to display</div>
                @endif
            </table>
        </div>
    </div>
@endsection
