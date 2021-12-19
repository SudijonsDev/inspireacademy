<!-- app/views/reports/learnersCentreCourse.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Learners Centres Search Form... -->

    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Search Learners Per Course and Centre</h4>
                    </div>
                </div>
            </div>

            <div class="panel-body">

                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'courseCentreRep', 'method'=>'GET','files'=>true)) !!}

                <div class="col-sm-8 col-md-8">

                    <div class="form-group">
                        {!! Form::Label('centre_id', 'Centre Name') !!}
                        <select class="form-control input-sm" required name="centre_id" id="centre_id">
                            <option disabled selected hidden>Select Centre</option>
                            @foreach($centres as $centre)
                                <option value="{{$centre->id}}"> {{$centre->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::Label('course_id', 'Course Name') !!}
                        <select class="form-control input-sm" required name="course_id" id="course_id">
                            <option disabled selected hidden>Select Course</option>
                            @foreach($courses as $course)
                                <?php
                                    $subject = \App\Models\Subject::where('id', '=', $course->subject_id)->first();
                                    $course_name = 'Grade ' . $course->grade . ' - ' . $subject->name;
                                ?>
                                <option value="{{$course->id}}"> {{$course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-8 col-sm-8 col-md-8">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection