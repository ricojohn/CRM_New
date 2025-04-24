@extends('layouts.layout')


@section('content')
  <div class="mb-12 row g-6">
    <div class="col-lg-6">
        @livewire('roles.roles')
    </div>
    <div class="col-lg-6">
      @livewire('roles.roles')
  </div>
  </div>
@endsection