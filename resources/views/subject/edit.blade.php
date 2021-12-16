<!-- app/views/subject/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Subject Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Subject: {!! $subject->name !!}</h3>
                </div>
                <div class="panel-body">

                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($subject, ['method' => 'PATCH', 'route' => ['updateSubject', $subject->id]]) !!}

                    <div class="form-group form-group-sm">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $subject->name, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <a href="{!!URL::route('subjects')!!}" class="btn btn-sm btn-secondary" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-sm btn-info')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection