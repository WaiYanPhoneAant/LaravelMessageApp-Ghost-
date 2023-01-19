<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
