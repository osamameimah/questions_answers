<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
  class ChangePasswordController extends Controller
{
    //

    public function create(){
        return view('change-password');
    }

    public function store(Request $request){
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

 
        
$user = Auth::user();

$user->forceFill([
'password' => Hash::make($request->input('password')),
])->save();

return redirect()->route('password.change')->with('success','password changed');
    }
}
