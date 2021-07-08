<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $subject = Subject::find($id);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        else{
            return view('server.subject.task.index',compact('subject'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req,$id)
    {

        $subject = Subject::find($id);
        if(blank($subject)){
            return response()->json(['success' => false]);
        }
        $position = 0;
        if(!blank($subject->task()->get())){
            $position = $subject->task()->max('position');
        }
        $temp=$req->only(['name','detail']);
        $temp['subject_id'] = $id;
        $temp['position'] =++$position;
        $task = Task::create($temp);
        if(isset($task)){
             $html = view('server.subject.task.addTask')->with(compact('task','id'))->render();
            return response()->json(['success' => true, 'html' => $html]);
        }else{
            return response()->json(['success' => false]);
        }
        
    }

    public function sortTask(Request $req){
        $arr = explode(',', $req->ids);
        for($i=0; $i<count($arr); $i++){
            Task::where('id',$arr[$i])->update(['position'=>$i]);
        }
        return response()->json(['success' => true]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subjectId,$taskId)
    {
        $s = Subject::find($subjectId);
        $task = Task::find($taskId);
        if(blank($s)){
            return back()->with('msg', __('messages.oop!'));
        }
        if(blank($task)){
            return back()->with('msg', __('messages.oop!'));
        }
        return view('server.subject.task.edit',compact('task','subjectId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $req, $subjectId, $taskId)
    {
        $subject = Subject::find($subjectId);
        $task = Task::find($taskId);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        if(blank($task)){
            return back()->with('msg', __('messages.oop!'));
        }
        $temp = $req->except(['_token']);
        $update = $task->update($temp);
        if($update){
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
    public function destroy($subjectId, $taskId)
    {
        $task = Task::find($taskId);
        if(blank($task)){
            return back()->with('msg', __('messages.oop!'));
        }
        $del=$task->delete();
        if($del){
            return back()->with('msg', __('messages.delete.success'));
        }else{
            return back()->with('msg', __('messages.delete.fail'));
        }
    }
}
