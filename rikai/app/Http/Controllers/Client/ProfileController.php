<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\UploadFile;
class ProfileController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $user = $this->findUser($id);
        return view('client.profile',compact('user')); 
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if($id!=Auth::id()){
            return back()->with('msg', __('messages.oop!'));
        }
        $user = $this->findUser($id);
        $temp = $req->except(['_token']);
        if($req->password!=null){
            $temp['password'] = bcrypt($req->password);
        }else{
           unset($temp['password']);
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
            $temp['avatar'] = $this->upload($image);

        }
        $update = $user->update($temp);
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
        //
    }
}
