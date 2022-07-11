<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

public function index(){
    $user = Auth::user();
    // $user->notifications;

    return view('notifications',[
        'notifications'=>$user->notifications,
    ]);
}

}
