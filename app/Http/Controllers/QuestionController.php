<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Session;

class QuestionController extends Controller
{
    //
    public function addqustion(Request $_request){
        
        $_request->validate([
            'qus'=>'required',
            'ans'=>'required',
            'times'=>'required|numeric',
        ]);

        $qus= new Question();
        $qus->qus=$_request->qus;
        $qus->ans=$_request->ans;
        $qus->allotted_time=$_request->times;
        $qus->admin_id=Session::get('ADMIN_ID');
        $qus->status=0;
        $qus->save();

        $_request->session()->flash('alertmsg','Question Added');
        $_request->session()->flash('alertcolor','success');

        $qus = Question::where('admin_id',Session::get('ADMIN_ID'))->get();  
        return redirect('/admin')->with( 'data' , $qus );  
    }
}
