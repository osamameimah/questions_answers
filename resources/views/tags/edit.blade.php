{{-- <x-dashboard-layout> --}}
 @extends('layouts.default')
@section('content')
 @include('tags._form',[
    'action' => '/tags/' . $tag->id,
    'update'=>true
])

@endsection
{{-- </x-dashboard-layout> --}}
