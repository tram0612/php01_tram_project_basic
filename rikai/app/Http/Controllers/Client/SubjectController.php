<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubject;
use App\Models\Task;
use App\Models\UserTask;
use App\Models\Subject;
use App\Enums\Status;
use App\Enums\Finish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($courseId,$subjectId)
    {
        $subject = Subject::find($subjectId);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
         // $tasks = Task::with(['userTask' => function ($query) {
         //                $query->where('user_id', Auth::id());
         //            }])->where('subject_id',$subjectId)->orderBy('position')->get();
        $tasks = $subject->task()->with('userTask')->get();
        //dd($tasks);
        return view('client.course.subject.index',compact('subject','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req,$courseId,$subjectId)
    {
        $subject = UserSubject::find($req->id);
        if(blank($subject)){
            return response()->json(['success' => false]);
        }

        if($subject->status==Status::Start){
            $subject->status = Status::Finish;
        }
        else{
           $subject->status = Status::Start; 
        }
        $subject->save();
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
