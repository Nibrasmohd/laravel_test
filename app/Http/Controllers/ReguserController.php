<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Reguser;
use App\models\Question;
use App\models\Userresult;
use Session;

class ReguserController extends Controller
{
    //
    public function loginuser(){

        if(session()->has('USER_LOGIN')){
            return redirect('/home');
        }else{
            return view('loginuser');
        }
    }


    public function userAuth(Request $request){
         
        $userdata = DB::table('regusers')->where(['usermail'=>$request->usermail])->get();

        if (isset($userdata[0])) {
            if (Hash::check($request->userpass,$userdata[0]->userpass )) {
                $request->session()->put('USER_LOGIN',true);
                $request->session()->put('USER_ID',$userdata[0]->id);
                $request->session()->put('USER_NAME',$userdata[0]->username);
 
                return redirect('/home'); 

            }else{
                $request->session()->flash('userpasserrror','password is wrong');
                return redirect('/loginuser');  
            }
        }else{
            $request->session()->flash('usermailerror','Entered wrong mail id');
            return redirect('/loginuser');
        }       
    }

    public function homepage(){
        
        $qus = Question::where('status',0)->first();

        if(count(Question::where('status',0)->get()) != 0){
            return view('homepage',['qus'=>$qus]);
        }else{
            $user = Question::where('admin_id', '=', Session::get('ADMIN_ID'))->first();
            if ($user == null) {
                return view('homepage',['qusadmin'=>'NO QUESTIONS UPLOADED']);
            }else{
                $score = count(Userresult::where(['status'=>1,'user_id'=>Session::get('USER_ID')])->get());
                return view('homepage',['score'=>$score,'tot'=>count(Question::get())]);
            }
            
        }

    }

    public function checkans(Request $request){
        
        
        $ansget = $request->enterdans;
        $ansright = Question::find($request->qusid);
        $statuss='';
        

        if(strtolower($ansget) == strtolower($ansright->ans) ){
            $statuss=1;
        }else{
            $statuss=0;
        }
        $user = new Userresult;
        $user->user_id = Session::get('USER_ID');
        $user->qus_id = $request->qusid;
        $user->status = $statuss;
        $user->save();
        

        DB::table('questions')->where(['id'=>$ansright->id])->update(['status'=>1]);
        return redirect('/home');
           
    }

    public function tryagian(){

        DB::table('questions')->update(['status'=>0]);
        DB::table('userresults')->where(['user_id'=>Session::get('USER_ID')])->delete();



        return redirect('/home');
    }
}
