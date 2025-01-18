<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Services\Role\IRoleService;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Backend\Role\RoleStoreRequest;
use App\Http\Requests\Backend\Role\RoleUpdateRequest;

class RoleController extends Controller implements HasMiddleware
{
    public function __construct(protected IRoleService $roleService) {}

    public static function middleware(): array
    {
        return [
            new Middleware('permission:role-list', only: ['index']),
            new Middleware('permission:role-create', only: ['create', 'store']),
            new Middleware('permission:role-edit', only: ['edit', 'update']),
            new Middleware('permission:role-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = $this->roleService->all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        $groupedPermissions = Permission::all(['name', 'group_name'])->groupBy('group_name');
        return view('backend.roles.create', compact('groupedPermissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        try {
            $role = $this->roleService->create($request->all());
            return redirect()
                ->route('roles.index')
                ->with('success', __('messages.role.created'));
        } catch (Exception $e) {
            report($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.error.general'));
        }
    }

    public function edit($name)
    {
        $role = $this->roleService->getByName($name);
        $groupedPermissions = Permission::all(['name', 'group_name'])->groupBy('group_name');
        return view('backend.roles.edit', compact('role', 'groupedPermissions'));
    }

    public function update(RoleUpdateRequest $request, $name)
    {
        try {
            $role = $this->roleService->update($request->all(), $name);
            return redirect()
                ->route('roles.index')
                ->with('success', __('messages.role.updated'));
        } catch (Exception $e) {
            report($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.error.general'));
        }
    }

    public function destroy($name)
    {
        try {
            $this->roleService->delete($name);
            return redirect()
                ->route('roles.index')
                ->with('success', __('messages.role.deleted'));
        } catch (Exception $e) {
            report($e);
            return redirect()
                ->back()
                ->with('error', __('messages.error.general'));
        }
    }
}
