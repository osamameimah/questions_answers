<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $questions = Question::leftJoin('users','questions.user_id','=' , 'users.id')->select([
        //     'questions.*',
        //     'users.name as user_name',
        // ])->orderBy('created_at','DESC')->paginate(3);

            // $search = request('search');
            $search =$request->input('search');
        // $questions = Question::where('title',$search)->get(); 

        $questions = Question::with('user')->withCount('answers')->when($search,function($query,$search){$query->where('title','LIKE',"%${search}%");})->latest()->paginate(3);
// $questions = Question::with('user')->withCount('answers')->where('title', 'LIKE', "%${search}%")->latest()->paginate(3);

         return view('questions.index', ['questions' => $questions ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::all();

        return view('questions.create',['tags'=>$tags]);
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
            'title' => ['required', 'string', 'max:255','min:3'],
            'description' => ['required', 'string'],
            'tags'=>['required','array'],


        ]);
        //     $question = new Question();
        //     $question->title = $request->input('title');
        //     $question->description = $request->input('description');
        //     $question->slug = Str::slug($request->input('name'));
        //     $question->save();
        // }
        $request->merge([
            'user_id' => Auth::id(),
            'status' =>'open',
        ]);
        DB::beginTransaction();
try{
        $question = Question::create($request->all());
        $question->tags()->sync($request->input('tags'));
        DB::commit();
        }
        catch (Throwable $e){
DB::rollBack();
throw $e;
        }    
        return redirect()->route('questions.index')->with('success','The questions is added!');
        // session()->flash('success', 'Questions added !');
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
        $question = Question::leftJoin('users', 'questions.user_id', '=', 'users.id')->select([
            'questions.*',
            'users.name as user_name',
        ])->findOrFail($id);
        $answers = $question->answers()->with('user')->latest()->get();
        return view('questions.show', ['question' => $question,'answers'=>$answers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = Question::findOrFail($id);
        $tags = Tag::all();
        
        $question_tags = $question->tags()->pluck('id')->toArray();
        return view('questions.edit', ['question' => $question,'tags'=>$tags,'question_tags'=>$question_tags]);
 
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
        // $question = Question::findOrFail($id);
        // $question->title = $request->input('title');
        // $question->description = $request->input('description');
        $question = Question::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255','min:3'],
            'description' => ['required', 'string'],
            'status' =>['in:open,closed'],
            'tags'=>['required','array'],

        ]);

        DB::beginTransaction();
        try {
        $question->update($request->all());
        $question->tags()->sync($request->input('tags'));
        DB::commit();
        } 
        catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }   

        return redirect()->route('questions.index')->with('success', 'The questions is updated!');
     }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Question::destroy($id);
        return redirect()->route('questions.index')->with('success', 'The questions is deleted!');;
        // session()->flash('success', 'Questions deleted !');
    }
}
