<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

 require __DIR__ . '/auth.php';
Route::group([
    'middleware' => [Localization::class]
], function () {
    //dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    //dashboard user
    Route::get('dashboard/user', [DashboardUserController::class, 'index'])->middleware(['auth'])->name('dashboard-user');

    Route::resource('tags', TagsController::class);
    Route::resource('roles',RoleController::class)->middleware('user.type:user');
     Route::resource('questions', QuestionsController::class)->middleware('auth');
    Route::get('/', [QuestionsController::class, 'index']);

    Route::get('profile', [UserProfileController::class, 'edit'])->name('profile')->middleware('auth');
    Route::put('profile', [UserProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    Route::post('answer', [AnswersController::class, 'store'])->name('answers.store')->middleware('auth');
    Route::put('answer/{id}/best', [AnswersController::class, 'best'])->name('answers.best')->middleware('auth');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('auth');

    Route::get('password/change', [ChangePasswordController::class, 'create'])->name('password.change');
    Route::post('password/change', [ChangePasswordController::class, 'store'])->name('password.store');
});

 

// <?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Rule;
// use Symfony\Component\Intl\Countries;
// use Symfony\Component\Intl\Languages;

// use function GuzzleHttp\Promise\all;

// class UserProfileController extends Controller
// {
//     //
//     public function edit()
//     {
//         // $user = User::find(2);
//         return view('user-profile', [
//             'user' => Auth::user(),
//             // 'user' => $user,
//             'countries' => Countries::getNames('en'),

//         ]);
//     }
//     public function update(Request $request)
//     {
//         $user = Auth::user();
//         $request->validate([
//             'first_name' => ['required', 'string'],
//             'last_name' => ['required', 'string'],
//             'birthday' => ['date', 'before:today'],
//             'name' => ['required', 'string'],
//             'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
//             'profile_photo' => ['nullable', 'image', 'dimensions:min_width=200,min_height=200', 'max:512000'],
//             'city' => ['required'],
//             'country' => ['required'],

//         ]);
        
//         $previous = $user->profile_photo_path;

//          if ($request->hasFile('profile_photo')) {
//             $file = $request->file('profile_photo');
//             $path = $file->store('/', [
//                 'disk' => 'public'
//             ]);
//         }
//         $request->merge([
//             'profile_photo_path' => $path,
//         ]);

//         $request->merge([
//             'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
//         ]);

//         $user->update($request->all());
//         $user->profile()->updateOrCreate([
//             ['user_id' => $user->id],
//             [
//                 // 'first_name' => $request->input('first_name'),
//                 // 'last_name' => $request->input('last_name'),
//                 // 'birthday' => $request->input('birthday'),
// $request->all(),
//             ]
//         ]);


//         if ($previous && $previous != $user->profile_photo_path) {
//             Storage::disk('public')->delete($previous);
//         }
//         return redirect('profile')->with('success', 'profile updated');
//     }
// }
