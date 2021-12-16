<!-- app/views/centre/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Centre Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Current Centres</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="centre/add" role="button" class="btn btn-default">Add New Centre</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="dataTable">
                @if (count($centres) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($centres as $centre)
                            <tr>
                                <!-- Name -->
                                <td class="table-text">
                                    <div>{{ $centre->name }}</div>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            {!! Form::model($centre, ['method' => 'GET', 'route' => ['editCentre',
                                            $centre->id]]) !!}
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
                    <div class="alert alert-info" role="alert">No centres available</div>
                @endif
            </table>
        </div>
    </div>
@endsection
