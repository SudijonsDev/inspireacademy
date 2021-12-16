<!-- app/views/learner/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Learner Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Current Learners</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="learner/add" role="button" class="btn btn-default">Add New Learner</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($learners) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Agreement Received</th>
                        <th>User Name</th>
                        <th>Centre</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($learners as $learner)
                            <tr>
                                <!-- Name -->
                                <td class="table-text">
                                    <div>{{ $learner->name }}</div>
                                </td>

                                <!-- Surname -->
                                <td class="table-text">
                                    <div>{{ $learner->surname }}</div>
                                </td>

                                <!-- Agreement Letter -->
                                <td class="table-text">
                                    <div>{{ $learner->agreement }}</div>
                                </td>

                                <!-- User Name -->
                                <td class="table-text">
                                    <div>{{ $learner->user_name }}</div>
                                </td>

                                <!-- Centre -->
                                <td class="table-text">
                                    <?php
                                        $centre = \App\Models\Centre::where('id', '=', $learner->centre_id)->first();
                                    ?>
                                    <div>{{ $centre->name }}</div>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            {!! Form::model($learner, ['method' => 'GET', 'route' => ['editLearner',
                                            $learner->id]]) !!}
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
                    <div class="alert alert-info" role="alert">No learners available</div>
                @endif
            </table>
        </div>
    </div>
@endsection
