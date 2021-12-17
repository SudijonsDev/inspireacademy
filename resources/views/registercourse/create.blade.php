<!-- app/views/registercourse/create.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Register Course Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register Course</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}


                    {!! Form::model(new App\Models\Registered_Course, ['route' => ['storeRegister']]) !!}

                    <div class="form-group form-group-sm">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $course_name, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::label('grade', 'Grade') !!}
                        {!! Form::text('grade', $grade, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <a href="{!!URL::route('courses')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Register', array('class' => 'btn btn-primary')) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection