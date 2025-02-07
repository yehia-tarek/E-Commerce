@extends('backend.layouts.master')

@section('title', __('Edit Category'))

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
            <div class="card-header">{{ __('Edit Category') }}</div>
            <div class="card-body">
                <x-backend.form.base-form :action="route('categories.update', ['category' => $category->id])" method="POST">
                    @csrf
                    @method('PUT')

                    <x-backend.form.input name="name" :value="$category->name" label="{{ __('Name') }}" required />
                    <x-backend.form.textarea name="description" :value="$category->description" label="{{ __('Description') }}" />
                    <x-backend.tree-select :categories="$categoriesTree" :selected="$category->id" name="parent_id" />
                    <x-backend.form.checkbox name="is_active" :checked="$category->is_active ? true : false" label="{{ __('Active') }}" />

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
