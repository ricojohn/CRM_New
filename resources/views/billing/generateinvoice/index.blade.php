@extends('layouts.layout')


@section('content')
  <div class="row invoice-add">
    @livewire('billing.generate-invoice')
  </div>
@endsection