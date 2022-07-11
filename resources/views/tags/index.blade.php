
{{-- <x-dashboard-layout> --}}
@extends('layouts.default')
@section('content')
    <h2 class="mb-4">{{ __('Tags List') }}</h2>
<a href="/tags/create" class="btn btn-primary">{{ __('Add New') }}</a>

<x-message/>

        <table class="table">
            <thead>

                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Slug') }}</th>
                    <th>{{ __('Created_at') }}</th>
                    <th>{{ __('Updated_at') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                        <td>
  <div class="btn-group" role="group" aria-label="Basic example">

<a href="/tags/{{ $tag->id }}/edit" class="btn btn-primary">{{ __('Edit') }}</a>

<form action="{{ route('tags.destroy',$tag->id )}}" method="POST">
 @csrf
 @method('delete')
 <button type="submit" class="btn btn-danger ">{{ __('Delete') }}</button>
</form>
  </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
@endsection
    {{-- </x-dashboard-layout> --}}


