<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Traits\UploadFile;
class SubjectController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findId($id)
    {
        return Subject::find($id);
    }
    public function index()
    {
        $subjects = Subject::index();
        return view('server.subject.index',compact('subjects'));
        
    }
    public function detail($id)
    {
       $subject = $this->findId($id);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        return view('server.su.detail',compact('subject'));
        
    }
    public function finish(Request $req){
        $subject = $this->findId($req->id);
        if(!blank($subject)){
            $subject->finish = !($subject->finish);
            $subject->save();
        }
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('server.subject.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $req)
    {
        $temp = $req->except(['_token']);
        if($req->hasfile('img')){
            $image=$req->file('img');
            $temp['img'] = $this->upload($image);
        }
        $insert = Subject::create($temp);

        if(isset($insert)){
             return redirect()->route('server.subject.task.index',[$insert->id]);
        }else{
            return back()->with('msg', __('messages.add.fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = $this->findId($id);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        return view('server.subject.edit',compact('subject')); 
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
    public function update(SubjectRequest $req, $id)
    {
       $subject = $this->findId($id);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        $temp = $req->except(['_token']);
        if($req->hasfile('img')){
            $image=$req->file('img');
            if($subject->img!=null){
                $img = $subject->img;
                $path = public_path('upload/' . $img);
                if(file_exists($path)){
                    unlink(public_path('upload/' . $img));
                }
            }
            $image = $req->file('img');
            $temp['img'] = $this->upload($image);

        }
        $update = $subject->update($temp);
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
    public function destroy($id)
    {
        $subject = $this->findId($id);
        if(blank($subject)){
            return back()->with('msg', __('messages.oop!'));
        }
        $subject->delete();
        return back()->with('msg', __('messages.delete.success'));
    }
}
