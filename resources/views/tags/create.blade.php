{{-- <x-dashboard-layout> --}}
    @extends('layouts.default')
<x-slot name='title'>
    {{ __('Create new tags') }}
    @section('content')
@include('tags._form',[
    'action'=>'/tags',
    'update'=>false
])
@endsection
{{-- </x-dashboard-layout> --}}