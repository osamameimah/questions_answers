<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagsController extends Controller
{
    //
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    
        
     

    public function index()
    {
        Gate::authorize('tags.view');

        $tags = Tag::all();
        return view('tags.index', ['title' => 'Tags List', 'tags' => $tags]);
        // session()->get('success');
    }

    public function create()
    {
        Gate::authorize('tags.create');

        $tag = new Tag();
        return view('tags.create', ['tag' => $tag]);
    }
    public function store(Request $request)
    {
        Gate::authorize('tags.create');

        $request->validate([
            'name' => 'required|max:255|min:3|unique:tags,name,except,id',

        ]);
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->slug = Str::slug($request->input('name'));
        $tag->save();
        session()->flash('success', 'the tag is created successfully!');
        return redirect('/tags');

        //$tags = Tag::create($request->all())

    }
    public function edit($id)
    {
        Gate::authorize('tags.edit');
        $tag = Tag::find($id);
        if ($tag == null) {
            abort(404);
        }

        return view('tags.edit', ['tag' => $tag]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('tags.update');

        $request->validate([
            // 'name' => 'required|max:255|min:3|unique:tags,name,$id',
            'name'=>['required','string','between:2,255',"unique:tags,name,$id",Rule::notIn('php')]

        ]);
        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->slug = Str::slug($request->input('name'));
        $tag->save();
        session()->flash('success', 'The slug is updated successfully!');
        return redirect('/tags');
    }

    public function destroy($id)
    {
        Gate::authorize('tags.delete');

        $tag = Tag::find($id);
        $tag->delete();
        session()->flash('success', 'The slug is deleted successfully!');
        // session()->put('success','deleted');
        return redirect('/tags');
    }
}
