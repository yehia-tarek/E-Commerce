@extends('backend.layouts.master')

@section('title', __('Customers'))

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Customers</div>
            <div class="card-body">
                <x-backend.ajax-data-table :headers="['#', 'Name', 'Email', 'Birth Date', 'Gender',  'Created At', 'Actions']" id="usersTable" :createPermission="'user-create'" :ajax="route('customers.index')"
                    :createRoute="route('customers.create')" :order="[[5, 'desc']]" :columns="[
                        ['data' => 'DT_RowIndex', 'name' => 'id'],
                        ['data' => 'name', 'name' => 'name'],
                        ['data' => 'email', 'name' => 'email'],
                        ['data' => 'birth_date', 'name' => 'birth_date'],
                        ['data' => 'gender', 'name' => 'gender'],
                        ['data' => 'created_at', 'name' => 'created_at'],
                        ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                    ]" />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
