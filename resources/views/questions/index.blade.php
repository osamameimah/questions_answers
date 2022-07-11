@extends('layouts.default')
@section('title')
    {{ __('Questions') }} <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">{{ __('New Question') }}</a>
@endsection

@section('content')

<x-message/>
{{-- @if(Session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}
    </div>
@endif --}}


    @foreach ($questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('questions.show', ['question' => $question->id]) }}">
                        {{ $question->title }} </a></h5>
                <div class="text-muted mb-4">
                    {{ __('Asked') }} : {{ $question->created_at->diffForHumans() }} 
                    ,{{ __('By') }}: {{ $question->user->name }}
                    ,{{ __('Answers') }}: {{ $question->answers_count}} 
                </div>
                <p class="card-text">{{ Str::words($question->description, 30) }}</p>
<div>Tags: {{ implode(', ',$question->tags()->pluck('name')->toArray()) }}</div> 
                
            </div>
            @if (Auth::id() == $question->user_id)

                <div class="cart-footer">
                    <div class="d-flex justify-content-between"> 
<a href="{{ route('questions.edit',$question->id) }}" class="btn btn-sm btn-success">{{ __('Edit') }}</a>
<form action="{{ route('questions.destroy',$question->id) }}" method="post">
@csrf
@method('delete')
<button type="submit" class="btn btn-sm btn-danger ">{{ __('Delete') }}</button>
</form>
                </div>
                </div>
            @endif

        </div>
    @endforeach
    {{ $questions->withQueryString()->links() }}
@endsection
