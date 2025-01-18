@extends('backend.layouts.master')

@section('title', __('Create Role'))

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ __('Name') }}</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ __('Permissions') }}</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input @error('permissions') is-invalid @enderror" type="checkbox" id="selectAll">
                                    <label class="form-check-label" for="selectAll">
                                        {{ __('Select All Permissions') }}
                                    </label>
                                </div>
                                <div class="row g-3">
                                    @foreach ($groupedPermissions as $group => $permissions)
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="form-check">
                                                        <input class="form-check-input group-select-all" type="checkbox"
                                                            id="group{{ $group }}" data-group="{{ $group }}">
                                                        <label class="form-check-label text-capitalize"
                                                            for="group{{ $group }}">
                                                            {{ __('Select All') }} {{ $group }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($permissions as $permission)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input permission-checkbox"
                                                                        type="checkbox" name="permissions[]"
                                                                        value="{{ $permission->name }}"
                                                                        id="permission{{ $permission->name }}"
                                                                        data-group="{{ $group }}">
                                                                    <label class="form-check-label"
                                                                        for="permission{{ $permission->name }}">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create Role') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const permissionGroups = {};
            const selectAllCheckbox = document.getElementById('selectAll');

            // Cache DOM elements and group permissions
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                const group = checkbox.dataset.group;
                if (!permissionGroups[group]) {
                    permissionGroups[group] = {
                        checkboxes: [],
                        selectAll: document.querySelector(`#group${group}`)
                    };
                }
                permissionGroups[group].checkboxes.push(checkbox);
            });

            // Update group "Select All" checkbox state
            function updateGroupSelectAll(group) {
                const groupData = permissionGroups[group];
                groupData.selectAll.checked = groupData.checkboxes.every(cb => cb.checked);

                // Update main select all if all groups are selected
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = Object.values(permissionGroups)
                        .every(group => group.checkboxes.every(cb => cb.checked));
                }
            }

            // Handle group "Select All" checkboxes
            document.querySelectorAll('.group-select-all').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const group = this.id.replace('group', '');
                    const groupData = permissionGroups[group];

                    groupData.checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });

                    if (selectAllCheckbox) {
                        updateGroupSelectAll(group);
                    }
                });
            });

            // Handle individual permission checkboxes
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateGroupSelectAll(this.dataset.group);
                });
            });

            // Handle main "Select All" checkbox
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    Object.values(permissionGroups).forEach(group => {
                        group.selectAll.checked = this.checked;
                        group.checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });
                });
            }
        });
    </script>
@endpush
