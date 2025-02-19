@extends('layouts.layout')


@section('content')
  <div class="mb-12 row g-6">
      <div class="col-lg-8">
          @livewire('client.client-list.client-table')
      </div>
      <div class="col-lg-4">
          @livewire('client.client-list.sales-rep')
      </div>
  </div>
@endsection