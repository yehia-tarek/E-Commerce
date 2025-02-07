@extends('backend.layouts.master')

@section('title', __('Create Category'))

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-header">{{ __('Create Category') }}</div>
            <div class="card-body">
                <x-backend.form.base-form :action="route('categories.store')" method="POST">
                    @csrf
                    <x-backend.form.input name="name" label="{{ __('Name') }}" required />
                    <x-backend.form.textarea name="description" label="{{ __('Description') }}" />
                    <x-backend.tree-select :categories="$categoriesTree" name="parent_id" />
                    <x-backend.form.checkbox name="is_active" label="{{ __('Active') }}" :checked="true" />

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{ __('Create Category') }}</button>
                    </div>
                </x-backend.form.base-form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
