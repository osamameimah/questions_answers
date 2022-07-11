 @extends('layouts.default')
 @section('title')
{{ __('Create New Roles') }}
@endsection
 @section('content')
@include('roles._form',[
    'action'=>route('roles.store'),
    'update'=>false
])

    @endsection