@extends('backend.layouts.master')

@section('title', __('Categories'))

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Categories</div>
            <div class="card-body">
                <x-backend.ajax-data-table :headers="['#', 'Name', 'Slug', 'parent_name','Created At', 'Actions']" id="categoriesTable" :ajax="route('categories.index')" :createPermission="'category-create'" :createRoute="route('categories.create')"
                    :order="[[4, 'desc']]" :columns="[
                        ['data' => 'DT_RowIndex', 'name' => 'id'],
                        ['data' => 'name', 'name' => 'name'],
                        ['data' => 'slug', 'name' => 'slug'],
                        ['data' => 'parent_name', 'name' => 'parent_name'],
                        ['data' => 'created_at', 'name' => 'created_at'],
                        ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                    ]" />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
