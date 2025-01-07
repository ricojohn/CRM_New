@extends('layouts.layout')

@section('content')
<!-- Toast with Placements -->
  <div
    class="m-2 bs-toast toast toast-placement-ex"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-bs-delay="2000">
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-medium">Status</div>
      <small>0 mins</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body"></div>
  </div>
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