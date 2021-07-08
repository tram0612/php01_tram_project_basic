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
class UserTaskController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findTask($id){
        $task = UserTask::find($id);
        if(blank($task)){
            abort(response()->json(['success' => false])) ;
        }
        else{
            return $task;
        }
    }
    
    public function store(Request $request)
    {
        $task = UserTask::create([
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
            'comment' => $request->comment,
            'status'  => Status::Start,
        ]);
        if($task){
           $html = view('client.course.subject.addTask')->with(compact('task'))->render(); 
            return response()->json(['success' => true, 'html' => $html]); 
        }
        else{
             return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->findTask($id);
        if($task->status==Status::Start){
            $task->status = Status::Finish;
        }
        else{
           $task->status = Status::Start; 
        }
        $task->save();
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
        $task = $this->findTask($id);
        $temp = $request->only(['comment']);
        $update = $task->update($temp);
        if($update){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->findTask($id);
        $task->delete();
        return response()->json(['success' => true]);
    }
}
