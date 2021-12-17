<!-- app/views/learner/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Learner Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Learner: {!! $name !!}</h3>
                </div>
                <div class="panel-body">

                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($learner, ['method' => 'PATCH', 'route' => ['updateLearner', $learner->id]]) !!}

                    <div class="form-group form-group-sm">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $learner->name, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', $learner->surname, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::label('user_name', 'User Name') !!}
                        {!! Form::text('user_name', $user->email, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        <input class = 'form-control input-sm' type = "password" required name="password" id="password"
                               value= "{!!$user->password !!}" >
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::Label('centre_id', 'Centre') !!}
                        <select class="form-control input-sm" name="centre_id">
                            @foreach($centres as $centre)
                                @if($centre['id'] == $cid)
                                    <option value="{{$centre['id']}}" selected="{{$cid}}">{{$centre['name']}}</option>
                                @else
                                    <option value="{{$centre->id}}">{{$centre->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <a href="{!!URL::route('login')!!}" class="btn btn-sm btn-secondary" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-sm btn-info')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection