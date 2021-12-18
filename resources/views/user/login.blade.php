<!-- app/views/user/login.blade.php -->

@extends('layout/layout')

@section('content')

    <div class="row centered-form faded">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Inspire Academy Initiative Login Page</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url' => 'login')) !!}

                    <div class="form-group">
                        {!! Form::text('email', Request::old('email'), array('class' => 'form-control input-sm',
                        'placeholder' => 'User Name')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::password('password', array('class' => 'form-control input-sm', 'placeholder' => 'Password')) !!}
                    </div>

                    {!! Form::submit('Login', array('class' => 'btn btn-info btn-block')) !!}

                    {!! Form::close() !!}
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="{{ url('/learner/add') }}" class="d-block mt-3 pb-3 text-muted">New Learner? Register</a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="{{ url('/user/add') }}" class="d-block mt-3 pb-3 text-muted">Not a user? Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
