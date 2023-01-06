<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MailsController extends Controller
{
    //
    public function sendMail(Request $request){
        // Mails::create([]);
        $this->sendValid($request->toArray());
        $data=$this->messageCreationData($request);
        Mails::create($data);
        return back();
    }

//---------------------------------- Ajax -------------------------------------
    // GET MAILS
    public function getMail($sortCond='',$getData='receive'){

        $data=Mails::select('*','mails.id as mail_id','users.firstName as name','users.id as user_id','users.image as img')
            ->when($getData=='receive',function($query){
                $query->where('mails.receiver',Auth::user()->ghostmail);
            })
            ->when($getData=='send',function($query){
                $query->where('mails.sender',Auth::user()->ghostmail);
            })
            ->when($sortCond=='read',function($query){
                $query->where('mails.read_status',1);
            })->when($sortCond=='unread',function($query){
                $query->where('mails.read_status',0);
            })
            ->leftJoin('users', 'users.ghostmail', 'mails.sender')
            ->Orderby('mails.id','desc')
            ->get();

        return response()->json(["data"=>$data], 200);
    }
    public function read_status(Request $data){
        Mails::where('id',$data->mail_id)->update(['read_status'=>1]);
        return response()->json(['status'=>'success'], 200);
    }

    public function mailsAddress(Request $request){

        $check=User::where('ghostmail',$request->mail)->exists();
        $selfMailCheck=Auth::user()->ghostmail==$request->mail;
        if($check && !$selfMailCheck){
            return response()->json(['status'=>'true'], 200);
        }else{
            return response()->json(['status'=>'false'], 200);
        }

    }

    public function sort(Request $request){
        logger($request['data']);
        if($request['data']=='all'){
            return $this->getMail('all');
        }elseif ($request['data']=='read') {
            return $this->getMail('read');
        }elseif ($request['data']=='unread') {
            return $this->getMail('unread');
        }
    }
    public function sendMails(Request $request){
       if($request->sendData=='send'){
            return $this->getMail('','send');

       }
    }
    public function SendedMailview(){
        return view('user.mailboard.sended');
    }


// ------------------------------------end Ajax---------------------------------
    private function messageCreationData($request){
        return [
            'sender'=>Auth::user()->ghostmail,
            'receiver'=>$request->ghostmail_rev,
            'subject'=>$request->subject,
            'message'=>$request->message,

        ];
    }
    private function sendValid($valiData){

        Validator::make($valiData,[
            'ghostmail_rev'=>['required', 'max:255'],
            'subject'=>['max:255'],
            'message'=>['required'],
        ])->validate();
    }

}
