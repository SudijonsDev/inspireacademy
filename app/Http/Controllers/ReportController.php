<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Course;
use App\Models\Learner;
use App\Models\Registered_Course;
use App\Models\Session;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function coursesPerSubject()
    {
        $subjects = Subject::where('id', '>', 0)->get();
        $subjectAndCourses = array();

        foreach ($subjects as $subject)
        {
            $courses = Course::where('subject_id', '=', $subject->id)->get();

            foreach ($courses as $course) {
                $coursesPerSubject = new CoursesPerSubject();
                $coursesPerSubject->subject = $subject->name;
                $coursesPerSubject->course_created = 'Grade ' . $course->grade . ' - ' . $subject->name;
                array_push($subjectAndCourses, $coursesPerSubject);
            }
        }
        return view('reports.subjectAndCourses', ['subjectAndCourses' => $subjectAndCourses]);
    }

    public function searchLearnersCentreCourse()
    {
        $centres = Centre::where('id', '>', 0)->get();
        $courses = Course::where('id', '>', 0)->get();

        return view('reports.learnersCentreCourse', compact('centres', 'courses'));
    }

    public function  learnersCentreCourseRep(Request $request)
    {
        $centre = Centre::where('id', '=', $request->centre_id)->first();
        $registered_learners = Registered_Course::where('course_id', '=', $request->course_id)->get();
        $courseCentre = array();
        foreach ($registered_learners as $value)
        {
            $learner = Learner::where('id', '=', $value->learner_id)->first();
            if ($learner->centre_id != $request->centre_id)
                continue;
            else {
                $learnerCourseCentre = new LearnersPerCentreAndCourse();
                $learnerCourseCentre->learner = $learner->name . ' ' . $learner->surname;
                $course = Course::where('id', '=', $request->course_id)->first();
                $subject = Subject::where('id', '=', $course->subject_id)->first();
                $learnerCourseCentre->course = 'Grade ' . $course->grade . ' - ' . $subject->name;
                $learnerCourseCentre->centre = $centre->name;
                array_push($courseCentre, $learnerCourseCentre);
            }
        }
        return view('reports.learnersCentreCourseRep', ['courseCentre' => $courseCentre]);
    }

    public function searchLearnersPerCourse()
    {
        $courses = Course::where('id', '>', 0)->get();

        return view('reports.learnersPerCourse', ['courses' => $courses]);
    }

    public function learnersPerCourseRep(Request $request)
    {
        $registered_learners = Registered_Course::where('course_id', '=', $request->course_id)->get();
        $courseCentre = array();
        foreach ($registered_learners as $value)
        {
            $learner = Learner::where('id', '=', $value->learner_id)->first();
            $centre = Centre::where('id', '=', $learner->centre_id)->first();

            $learnerCourseCentre = new LearnersPerCentreAndCourse();
            $learnerCourseCentre->learner = $learner->name . ' ' . $learner->surname;
            $course = Course::where('id', '=', $request->course_id)->first();
            $subject = Subject::where('id', '=', $course->subject_id)->first();
            $learnerCourseCentre->course = 'Grade ' . $course->grade . ' - ' . $subject->name;
            $learnerCourseCentre->centre = $centre->name;
            array_push($courseCentre, $learnerCourseCentre);
        }
        return view('reports.learnersPerCourseRep', ['courseCentre' => $courseCentre]);
    }

    public function learnersPerformance()
    {
        $courses = Course::where('id', '>', 0)->get();

        return view('reports.learnersPerformance', ['courses' => $courses]);
    }

    public function learnersPerformanceRep(Request $request)
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        if ($user->admin == 'Y')
            $sql = "select l.name, surname, grade, subject_id, avg(marksReceived) as marks from sessions ses, courses c,
              subjects s, learners l where ses.course_id = $request->course_id and ses.course_id = c.id and c.subject_id = 
              s.id and ses.learner_id = l.id group by l.name, surname, grade, subject_id";
        else {
            $learner = Learner::where('name', '=', $user->name)
                ->where('surname', '=', $user->surname)->first();

            $sql = "select l.name, surname, grade, subject_id, avg(marksReceived) as marks from sessions ses, courses c,
              subjects s, learners l where ses.course_id = $request->course_id and ses.course_id = c.id and c.subject_id = 
              s.id and ses.learner_id = l.id and ses.learner_id = $learner->id group by l.name, surname, grade, subject_id";
        }
        $sessions = DB::select($sql);

        return view('reports.learnersPerformRep', ['sessions' => $sessions]);
    }
}
class CoursesPerSubject
{
    public $subject;
    public $course_created;
}
class LearnersPerCentreAndCourse
{
    public $learner;
    public $course;
    public $centre;
}

