<!-- app/views/subject/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Subject Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Current Subjects</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="subject/add" role="button" class="btn btn-default">Add New Subject</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($subjects) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <!-- Name -->
                                <td class="table-text">
                                    <div>{{ $subject->name }}</div>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            {!! Form::model($subject, ['method' => 'GET', 'route' => ['editSubject',
                                            $subject->id]]) !!}
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
                    <div class="alert alert-info" role="alert">No subjects available</div>
                @endif
            </table>
        </div>
    </div>
@endsection
