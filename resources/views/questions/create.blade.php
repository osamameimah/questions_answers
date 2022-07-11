@extends('layouts.default')

@section('title', 'New Question')

@section('content')
    {{-- @if (Session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}
        </div>
    @endif --}}
    <x-message/>
    

    <form action="{{ route('questions.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="title">{{ __('Title') }}</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="title"
                    value="{{ old('title') }}" />
                @error('title')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="description">{{ __('Description') }}</label>
            <div>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">  {{ old('description') }}</textarea>
                @error('description')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="description">{{ __('Tags') }}</label>
            <div>
                @foreach ($tags as $tag)
                    
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->id }}">
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
{{ $tag->name }}
                    </label>
                </div>
                   @endforeach
 
            </div>
        </div>

        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Ask Question') }}</button>
        </div>

    </form>

@endsection
