<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Question;
use Session;

class adminController extends Controller
{
    //
    public function adminLogin(){

        if(session()->has('ADMIN_LOGIN')){
            return redirect('/admin');
        }else{
            return view('login_page');
        }
        
    }


    public function adminAuth(Request $request){
         
        $admindata = DB::table('admin_user')->where(['mail'=>$request->email])->get();

        if (isset($admindata[0])) {
            if (Hash::check($request->pass,$admindata[0]->password )) {
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$admindata[0]->id);
                $request->session()->put('ADMIN_NAME',$admindata[0]->name);

                
                return redirect('/admin');           
                // return view('adminpage',['qustions'=>$qus]);
            }else{
                $request->session()->flash('passerror','password is wrong');
                return redirect('/');  
            }
        }else{
            $request->session()->flash('mailerror','Entered wrong mail id');
            return redirect('/');
        }       
    }

    public function adminpage(){
        $qus = Question::where('admin_id',Session::get('ADMIN_ID'))->get(); 
        return view('adminpage',['data'=>$qus]);
    }
}
