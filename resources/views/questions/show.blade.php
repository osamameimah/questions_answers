@extends('layouts.default')
@section('title')
    {{ __('Questions') }} <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">{{ __('New Question') }}</a>
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $question->title }}</h5>
            <div class="text-muted mb-4">
                {{ __('Asked') }} : {{ $question->created_at->diffForHumans() }} 
                ,{{ __('By') }}: {{ $question->user_name }}
            </div>

            <p class="card-text">{{ $question->description }}</p>
<div>
<ul class="inline-list">
@foreach ($question->tags as $tag)
    <li><span class="">{{ $tag->name }}</span></li>
@endforeach
</ul>
</div>


        </div>
    </div>

    <section>
        <h3>{{ $question->answers->count() }} {{ __('Answers') }}</h3>
        @forelse ($answers as $answer)
            <div class="card mb-3">
                <div class="card-body">
                    @if ($answer->best_answer ==1)
                        <span class="badge bg-success">{{ __('Best') }}</span>
                    @endif
                    <p class="card-text">{{ $answer->description }}</p>
                    <div class="text-muted mb-4">
                        {{ __('Asked') }} : {{ $answer->created_at->diffForHumans() }} 
                        {{-- ,{{ __('By') }}: {{ $answer->user->name }} --}}
                    </div>
                    @auth
                        @if ($answer->best_answer ==0 && Auth::id() == $question->user_id)
                        <form action="{{ route('answers.best',$answer->id) }}" method="post">
@csrf
@method('put')
<button type="submit" class="btn btn-success">{{ __('Mark as best answer') }}</button>
                        </form>
                            
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <div class="mb-3">
                <p class="">{{ __('No answer!') }}</p>
            </div>
        @endforelse
        {{-- @auth --}}

        <hr>
        <h4>{{ __('Send Your Answer') }}</h4>
        <form action="{{ route('answers.store') }}" method="post">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}"/>
            <div class="form-group mb-3">
                <div>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">  {{ old('description') }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror

                </div>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Submit Answer') }}</button>
            </div>
        </form>
        {{-- @endauth --}}
@guest
    <a href="{{ route('login') }}">{{ __('Login to answer!') }}</a>
@endguest
    </section>
@endsection
