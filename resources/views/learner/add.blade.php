<!-- app/views/learner/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Learner Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Learner</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open(array('route' => 'storeLearner', 'method'=>'POST','files'=>true)) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('user_name', 'User Name') !!}
                        {!! Form::text('user_name', Request::old('user_name'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', array('class' => 'form-control input-sm', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('agreement', 'Signed Agreement') !!}
                        {!! Form::file('agreement', array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::Label('centre_id', 'Centre') !!}
                        <select class="form-control input-sm form-control-sm" name="centre_id" id="centre_id">
                            <option value="">Select a Centre</option>
                            @foreach($centres as $centre)
                                <option value="{{$centre->id}}" @if(old('centre_id')==$centre->id)
                                selected="selected"@endif>{{$centre->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{!!URL::route('login')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection