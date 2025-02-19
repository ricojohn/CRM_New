@extends('layouts.layout')


@section('content')
  <div class="mb-12 row g-6">
      <div class="col-lg-12">
          @livewire('client.quotation-builder.quotation-table')
      </div>
  </div>
@endsection