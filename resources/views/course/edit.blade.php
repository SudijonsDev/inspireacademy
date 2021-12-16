<!-- app/views/course/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Course Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Course: {!! $course->name !!}</h3>
                </div>
                <div class="panel-body">

                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($course, ['method' => 'PATCH', 'route' => ['updateCourse', $course->id]]) !!}

                    <div class="form-group form-group-sm">
                        {!! Form::label('name', 'Course Name') !!}
                        {!! Form::text('name', $course->name, array('class' => 'form-control form-control-sm
                        input-sm', 'required')) !!}
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::label('grade', 'Grade') !!}
                        {!! Form::select('grade', array('6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11',
                        '12'=>'12'), null, array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group form-group-sm">
                        {!! Form::Label('subject_id', 'Subject') !!}
                        <select class="form-control input-sm" name="subject_id">
                            @foreach($subjects as $subject)
                                @if($subject['id'] == $sid)
                                    <option value="{{$subject['id']}}" selected="{{$sid}}">{{$subject['name']}}</option>
                                @else
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <a href="{!!URL::route('courses')!!}" class="btn btn-sm btn-secondary" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-sm btn-info')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection