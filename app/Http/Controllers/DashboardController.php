<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $users = User::count();
        $questions = Question::count();
        $answers  = Answer::count();
        return view('dashboard',['users'=>$users,'questions'=>$questions,'answers'=>$answers]);
    }
}
