<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class profileController extends Controller
{
    //update profile
    public function profileUpdate(Request $request)
    {
        # code...
        $data=$this->getProfileData($request);
        $this->dataValidatior($data);
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['success'=>'Successfully Updated']);
    }

    public function restartPassword(Request $request)
    {
        # code...
        $this->pwValidation($request->toArray());
        if(Hash::check($request->old_pw,Auth::user()->password)){
            $newPw=Hash::make($request->new_pw);
            User::where('id',Auth::user()->id)->update(['password'=>$newPw]);
            return back()->with(['success'=>'Successfully Changed Password']);
        }else{
            return back()->with(['error'=>'Old Password is wrong']);
        }



    }
    //get profile data
    private function getProfileData($data)
    {
        # code...
        return [
            'firstName'=>$data->fname,
            'secondName'=>$data->lastName
        ];
    }

    //profil validation
    private function dataValidatior($data)
    {
        # code...
        return Validator::make($data,[
            'firstName'=>'required',
            'secondName'=>'required',
        ])->validate();
    }
    // password validation
    private function pwValidation($data)
    {
        # code...
        return Validator::make($data,[
            'old_pw'=>'required',
            'new_pw'=>'required|min:8',
            'confirm_pw'=>'required|min:8|same:new_pw'
        ])->validate();
    }
}
