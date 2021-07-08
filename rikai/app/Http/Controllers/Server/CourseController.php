<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\CourseSubject;
use App\Http\Traits\UploadFile;
use App\Http\Requests\CourseRequest;
use App\Enums\Status;
use App\Models\UserSubject;
class CourseController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::index();
        return view('server.course.index',compact('courses'));
    }

    
    public function finish(Request $req){
        $course = $this->findCourse($id);
        $course->finish = !($course->finish);
        $course->save();
        return response()->json(['success' => true]);
    }
    public function detail($id){
        $course = $this->findId($id);
        return view('server.course.detail',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('server.course.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $req)
    {
        $temp = $req->except(['_token']);
        if($req->hasfile('img')){
            $image=$req->file('img');
            $temp['img'] = $this->upload($image);
        }
        $insert = Course::create($temp);
        if(isset($insert)){
            return redirect()->route('server.course.subject.index',[$insert->id]);
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
        $course = $this->findCourse($id);
        return view('server.course.edit',compact('course')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function progress($courseId,$userId)
    {
        $subjects = UserSubject::findSubjectForUser($courseId,$userId);
        return view('server.course.user.progress',compact('subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $req, $id)
    {
        $course = $this->findCourse($id);
        $temp = $req->except(['_token']);
        if($req->hasfile('img')){
            $image=$req->file('img');
            if($course->img!=null){
                $img = $course->img;
                $path = public_path('upload/' . $img);
                if(file_exists($path)){
                    unlink(public_path('upload/' . $img));
                }
            }
            $image = $req->file('img');
            $temp['img'] = $this->upload($image);

        }
        $update = $course->update($temp);
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
        $course = $this->findCourse($id);
        if($course->img!=null){
            $img =$course->img;
            $path = public_path('upload/' . $img);
            if(file_exists($path)){
                unlink(public_path('upload/' . $img));
            }
        }
        $course->delete();
        return back()->with('msg', __('messages.delete.success'));
    }
    
   
}
