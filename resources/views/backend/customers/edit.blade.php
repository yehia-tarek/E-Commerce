@extends('backend.layouts.master')

@section('title', __('Edit Customer'))

@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header">{{ __('Edit Customer') }}</div>
            <div class="card-body">
                <x-backend.form.base-form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                            :value="$customer->name"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="email"
                                            name="email"
                                            label="{{ __('Email') }}"
                                            required
                                            placeholder="{{ __('Enter customer email') }}"
                                            :value="$customer->email"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="date"
                                            name="birth_date"
                                            label="{{ __('Birth Date') }}"
                                            required
                                            :value="$customer->birth_date->format('Y-m-d')"
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
                                            :selected="$customer->gender"
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
                                    <h5 class="card-title mb-0">{{ __('Change Password') }}</h5>
                                    <small class="text-muted">{{ __('Leave blank if you don\'t want to change the password') }}</small>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="password"
                                            name="password"
                                            label="{{ __('New Password') }}"
                                            placeholder="{{ __('Enter new password') }}"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-backend.form.input
                                            type="password"
                                            name="password_confirmation"
                                            label="{{ __('Confirm New Password') }}"
                                            placeholder="{{ __('Confirm new password') }}"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Update Customer') }}</button>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </x-backend.form.base-form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
