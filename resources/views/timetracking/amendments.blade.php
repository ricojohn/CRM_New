@extends('layouts.layout')


@section('content')
  <div class="mb-12 row g-6">
    <div class="col-md-6 col-lg-4">
        {{-- Amendment Form --}}
        @livewire('amendment.amendment-form')
    </div>
    <div class="col-md-6 col-lg-8">
        <!-- Hoverable Table rows -->
      
        <!--/ Hoverable Table rows -->
    </div>
  </div>
  
@endsection