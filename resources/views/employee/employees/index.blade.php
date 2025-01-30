@extends('layouts.layout')


@section('content')
  <div class="mb-12 row g-6">
    <div class="col-lg-8">
        @livewire('employee.employees.employee-table')
    </div>
    <div class="col-lg-4">
        @livewire('employee.employees.department-table')
    </div>
  </div>
@endsection