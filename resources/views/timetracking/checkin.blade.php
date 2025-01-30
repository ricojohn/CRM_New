@extends('layouts.layout')

@section('content')
  <div class="mb-12 row g-6">
    <div class="col-md-6 col-lg-4">
        {{-- Time Tracking --}}
      @livewire('check-in.time-tracking')
    </div>
    <div class="col-md-6 col-lg-8">
        <!-- Hoverable Table rows -->
      @livewire('check-in.check-in-out-table')
        <!--/ Hoverable Table rows -->
    </div>
    <div class="col-md-12 col-lg-12">
      <!-- Hoverable Table rows -->
    @livewire('check-in.recording-table')
      <!--/ Hoverable Table rows -->
    </div>
  </div>
  
@endsection