<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Traits\UploadFile;


class UserController extends Controller
{
      use UploadFile;
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
    public function create()
    {
        return view('server.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $req)
    {
        $u = $req->except(['_token']);
        $u['password'] = bcrypt($req->password);
        
        if($req->hasfile('avatar')){
            $image=$req->file('avatar');
            $u['avatar'] = $this->upload($image);
        }
        $insert = User::create($u);

        if(isset($insert)){
            return back()->with('msg', __('messages.add.success'));
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
        $user = User::find($id);
        if(blank($user)){
            return back()->with('msg', __('messages.oop!'));
        }
        //dd($user);
        return view('server.user.profile',compact('user','id')); 
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
    public function update(UserRequest $req, $id)
    {
        $user = User::find($id);
        if(blank($user)){
            return back()->with('msg', __('messages.oop!'));
        }
        $u = $req->except(['_token']);
        if($req->password!=null){
            $u['password'] = bcrypt($req->password);
        }else{
           unset($u['password']);
        }
        if($req->hasfile('avatar')){
            $image=$req->file('avatar');
            if($user->avatar!=null){
                $img = $user->avatar;
                $path = public_path('upload/' . $img);
                if(file_exists($path)){
                    unlink(public_path('upload/' . $img));
                }
            }
            $image = $req->file('avatar');
            $u['avatar'] = $this->upload($image);

        }
        $update = $user->update($u);
        if($update){
            return back()->with('msg', __('messages.update.success'));
        }else{
            return back()->with('msg', __('messages.update.fail'));
        }
        // $user->save();
        // return redirect()->back()->with('msg',__('messages.update.success') );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(blank($user)){
            return back()->with('msg', __('messages.oop!'));
        }
        if($user->avatar!=null){
            $img = $user->avatar;
            $path = public_path('upload/' . $img);
            if(file_exists($path)){
                unlink(public_path('upload/' . $img));
            }
        }
        
        $user->delete();
        return redirect()->back()->with('msg',__('messages.delete.success'));

    }

    public function trainee(){
        $users = User::where('role',0)->paginate(5);
        return view('server.user.table',compact('users'));
    }
    public function supervisor(){
        $users = User::where('role',1)->paginate(5);
        return view('server.user.table',compact('users'));
    }

}
