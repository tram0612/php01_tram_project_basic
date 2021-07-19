<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubject;
use App\Models\Subject;
use App\Enums\Status;
use Illuminate\Support\Facades\Auth;
class SubjectController extends Controller
{
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
        $tasks = $subject->task()->with(['userTask' => function ($query) {
                           $query->where('user_id', Auth::id());
              }])->get();
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
        $userSubject = UserSubject::find($req->id);
        if(blank($userSubject)){
            return response()->json(['success' => false]);
        }
        $update=false;
        if($userSubject->status==Status::Start){
            $update = $userSubject->update(['status'=>Status::Finish]);
        }else{
            $update = $userSubject->update(['status'=>Status::Start]);
        }
        if($update){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
        
    }

    
}
