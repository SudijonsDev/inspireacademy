<!-- app/views/centre/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Centre Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Centre: {!! $centre->name !!}</h3>
                </div>
                <div class="panel-body">

                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($centre, ['method' => 'PATCH', 'route' => ['updateCentre', $centre->id]]) !!}

                    <div class="form-group form-group-sm">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $centre->name, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <a href="{!!URL::route('centres')!!}" class="btn btn-sm btn-secondary" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-sm btn-info')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection