@extends('layouts.default')
@section('content')
 <a href="/roles/create" class="btn btn-primary">Add New</a>

<x-message/>

        <table class="table">
            <thead>

                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    {{-- <th>abilities</th> --}}
                     <th>{{ __('Created_at') }}</th>
                    <th>{{ __('Updated_at') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        {{-- <td>{{ $role->abilities }}</td> --}}
                         <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>
  <div class="btn-group" role="group" aria-label="Basic example">

<a href="{{ route('roles.edit',$role->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>

<form action="{{ route('roles.destroy',$role->id )}}" method="POST">
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
 
