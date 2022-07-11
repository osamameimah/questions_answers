<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $answers = Answer::all();
        return $answers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            'description' => $request->input('description'),


        ]);
        $user = Auth::user();
 
return $answer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $answer = Answer::findOrFail($id);
        return $answer->load('tags', 'user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::destroy($id);
        return [
            'message' => 'Answer deleted',
        ];
    }
}
