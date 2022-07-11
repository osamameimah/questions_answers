<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

use function GuzzleHttp\Promise\all;

class UserProfileController extends Controller
{
    //
    public function edit()
    {
        // $user = User::find(2);
        return view('user-profile', [
            'user' => Auth::user(),
            // 'user' => $user,
            'countries' => Countries::getNames(App::currentLocale()),

        ]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
          $request->validate([
             'first_name' => ['required', 'string'],
             'last_name' => ['required', 'string'],
        'birthday' => ['date', 'before:today'],
        
         'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        'profile_photo' => ['nullable', 'image', 'dimensions:min_width=200,min_height=200', 'max:512000'],


        ]);
 
        $previous = $user->profile_photo_path;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('/', [
                'disk' => 'public'
            ]);

            $request->merge([
                'profile_photo_path' => $path,
            ]);
        }
        
        
// $request->merge([
// 'user_id'=>Auth::user()->id,
// ]);
        $request->merge([
            'name' => $request->input('first_name') . " " . $request->input('last_name'),
        ]);

        $user->update($request->except('email'));

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            
                // 'first_name' => $request->input('first_name'),
                // 'last_name' => $request->input('last_name'),
                // 'birthday' => $request->input('birthday'),
                $request->all(),
            
        );


        if ($previous && $previous != $user->profile_photo_path) {
            Storage::disk('public')->delete($previous);
        }
        return redirect('profile')->with('success', 'profile updated');
    }
}
