<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\UserSubject;
use App\Enums\Status;
use App\Http\Requests\CourseSubjectRequest;
class CourseSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($courseId)
    {
        $course = $this->findCourse($courseId);
        $subjectOfCourse=$course->subject()->get();
        $subjects = Subject::all()->toArray();
        foreach($subjectOfCourse as $sc) {
            foreach ($subjects as $key=> $s){
                if($sc->id==$s['id']){
                    unset($subjects[$key]);
                    break;
                }
            }
        }
        return view('server.course.subject',compact('course','subjects','subjectOfCourse'));
        
    }
    public function status(Request $req){
        $subject = CourseSubject::updateStatus($req->courseId,$req->subjectId);
        $html = view('server.course.status')->with(compact('subject'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req,$courseId)
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req,$courseId)
    {
        $course = $this->findCourse($courseId);
        $subject = Subject::find($req->subjectId);
        $position = 0;
        $subjects=$course->subject()->get()->toArray();
        if(!empty($subjects)){
            $position = $course->subject()->max('position');
        }
        $course->subject()->attach($req->subjectId, ['started_at'=>$req->startedAt,'position'=> ++$position]);
        $status = Status::Start;
        $html = view('server.course.subjectAjax')->with(compact('courseId','subject','req','status'))->render(); 
        return response()->json(['success' => true, 'html' => $html]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($courseId,$subjectId)
    {
        
        $subject = Subject::with('courseSubject')->find($subjectId);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        return view('server.course.editSubject',compact('subject','courseId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sortSubject(Request $req){
        CourseSubject::sortSubject($req);
        return response()->json(['success' => true]);
    }
    public function update(CourseSubjectRequest $req, $courseId,$subjectId)
    {
        $subject = CourseSubject::updateDate($req, $courseId,$subjectId);
        if($subject){
            return back()->with('msg', __('messages.update.success'));
        }else{
            return back()->with('msg', __('messages.update.fail'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseId,$subjectId)
    {
       $course = $this->findCourse($courseId);
        $del=$course->subject()->detach($subjectId);
        if($del){
            return back()->with('msg', __('messages.delete.success'));
        }else{
            return back()->with('msg', __('messages.delete.fail'));
        }
    }
}
