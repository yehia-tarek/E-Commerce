@extends('backend.layouts.master')

@section('title', __('Customers'))

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Customers</div>
            <div class="card-body">
                {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover']) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
