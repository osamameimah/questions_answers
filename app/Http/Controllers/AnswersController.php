<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Notifications\AnswerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AnswersController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'int', 'exists:questions,id'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        $request->merge([
            'user_id' => Auth::id()
        ]);
        $question = Question::findOrFail($request->input('question_id'));
        // $answer = $question->answers()->create($request->all());
        // $answer = $question->answers()->create([$request->all()]);
        $answer = $question->answers()->create([
            'description'=>$request->input('description'),


        ]);
        $user = Auth::user();
        $question->user->notify(new AnswerNotification($question,$user));
        // Notification::send($user,new AnswerNotification($question,$user));

        return redirect()->route('questions.show', $question->id)->with('success', 'Answer Added!');
    }

public function best(Request $request,$id){
    $answer = Answer::findOrFail($id);
    $question = $answer->question;
    if($answer->question->user_id != Auth::id()){
        abort(403);
    }
    $question->answers()->update([
 'best_answer'=>0
    ]);
    $answer->forceFill([
'best_answer' =>1,
    ])->save();
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Answer market as best!');

}
    
}
