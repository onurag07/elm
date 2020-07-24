<?php

namespace App\Http\Controllers;
use App\User;
use App\Leave;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {

        $user=auth()->user();
        return view('user.profile',compact('user'));

    }

    public function update(ProfileRequest $request)
    {

        auth()->user()->update($request->all());
        return redirect()->back();

    }

    public function profileApproval(){

        $user=auth()->user();
        $profile=User::Where('status',0)->get();

        return view('admin.userprofile',compact('user','profile'));
    }

    public function approval(Request $request){

        if($request->status == 2){
            User::where('id',$request->id)->delete();
            Leave::where('user_id',$request->id)->delete();
        }
        if($request->status == 1){
            User::where('id',$request->id)->update([
                'status'=>$request->status,
            ]);
        }
        return redirect()->back();

    }

    public function activeprofile()
    {
        $user=auth()->user();
        $profile=User::Where('status',1)->where('role','user')->get();
        return view('admin.activeprofile',compact('user','profile'));

    }
}
