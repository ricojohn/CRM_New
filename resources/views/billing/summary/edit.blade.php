@extends('layouts.layout')


@section('content')
  <div class="mb-12 row ">
    <div class="col-lg-12">
      @livewire('billing.edit-summary', ['invoice_id' => $invoice_id])
    </div>
  </div>
@endsection