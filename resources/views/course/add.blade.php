<!-- app/views/course/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Course Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Course</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}


                    {!! Form::model(new App\Models\Course, ['route' => ['storeCourse']]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Course Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('grade', 'Grade') !!}
                        {!! Form::select('grade', array('Select Grade'=>'Select Grade', '6'=>'6', '7'=>'7', '8'=>'8',
                        '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12'), null, array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::Label('subject_id', 'Subject') !!}
                        <select class="form-control input-sm form-control-sm" name="subject_id" id="subject_id">
                            <option value="">Select a Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}" @if(old('subject_id')==$subject->id)
                                selected="selected"@endif>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{!!URL::route('courses')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection