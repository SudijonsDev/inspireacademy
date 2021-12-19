<!-- app/views/reports/learnersPerformance.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Learners Performance Course Search Form... -->

    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Learners Performance Per Course or Year</h4>
                    </div>
                </div>
            </div>

            <div class="panel-body">

                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'learnersPerformRep', 'method'=>'GET','files'=>true)) !!}

                <div class="col-sm-8 col-md-8">

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
<script type="text/javascript">

    $(function () {
        $('.datepicker').datepicker({dateFormat: 'dd/mm/yy'}) ;
    });

</script>