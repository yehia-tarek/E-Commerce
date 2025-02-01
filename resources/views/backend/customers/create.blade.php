@extends('backend.layouts.master')

@section('title', __('Create Customer'))

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
            <div class="card-header">{{ __('Create Customer') }}</div>
            <div class="card-body">
                <x-backend.form.base-form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Basic Information Card -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Basic Information') }}</h5>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            name="name"
                                            label="{{ __('Name') }}"
                                            required
                                            placeholder="{{ __('Enter customer name') }}"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="email"
                                            name="email"
                                            label="{{ __('Email') }}"
                                            required
                                            placeholder="{{ __('Enter customer email') }}"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="date"
                                            name="birth_date"
                                            label="{{ __('Birth Date') }}"
                                            required
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.select
                                            name="gender"
                                            label="{{ __('Gender') }}"
                                            required
                                            :options="[
                                                'male' => __('Male'),
                                                'female' => __('Female')
                                            ]"
                                            placeholder="{{ __('Select gender') }}"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Card -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Security') }}</h5>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="password"
                                            name="password"
                                            label="{{ __('Password') }}"
                                            required
                                            placeholder="{{ __('Enter password') }}"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="password"
                                            name="password_confirmation"
                                            label="{{ __('Password Confirmation') }}"
                                            required
                                            placeholder="{{ __('Confirm password') }}"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Create Customer') }}</button>
                        </div>
                    </div>
                </x-backend.form.base-form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
