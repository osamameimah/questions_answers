 
{{-- <x-dashboard-layout> --}}
  @extends('layouts.default')
  {{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot> --}}
  @section('content')
  <div class="row">
    <div class="col-lg-4 col-6">
       <div class="small-box bg-info">
        <div class="inner " style="padding: 20px;">
          <h3 style="text-align: center">{{ $questions }}</h3>
          
          <h2 style="text-align: center">{{ __('All Questions') }}</h2>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-bag"></i>
        </div> --}}
       </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner" style="padding: 20px;">
          <h3 style="text-align: center">{{ $answers }}</h3>
          
          <h2 style="text-align: center">{{ __('All Answers') }}</h2>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div> --}}
       </div>
    </div>
     <div class="col-lg-4 col-6">
       <div class="small-box bg-warning">
        <div class="inner" style="padding: 20px;">
          <h3 style="text-align: center">{{ $users }}</h3>
          
          <h2 style="text-align: center"> {{ __('User Registrations') }}</h2>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-person-add"></i>
        </div> --}}
       </div>
    </div>
   </div>
 
@endsection
{{-- </x-dashboard-layout> --}}
