<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    //
    public function index(){
        $users = Auth::user()->email;
        $questions = Question::where('user_id',Auth::user()->id)->count();
        $answers = Answer::where('user_id', Auth::user()->id)->count();
return view('dashboard-user',['users'=>$users,'questions'=>$questions,'answers'=>$answers]);
    }
}
