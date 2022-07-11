@extends('layouts.default')
@section('title','Edit Roles')
 

@section('content')
@include('roles._form',[
    'action' =>route('roles.update',$role->id),
    'update'=>true
])

    @endsection