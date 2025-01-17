<?php

namespace App\Http\Controllers\Backend\Auth;

use Exception;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\Admin\IAdminService;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Backend\Admins\AdminStoreRequest;
use App\Http\Requests\Backend\Admins\AdminUpdateRequest;

class AdminsController  extends Controller implements HasMiddleware
{
    public function __construct(protected IAdminService $adminService) {}

    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin-list', only: ['index']),
            new Middleware('permission:admin-create', only: ['create', 'store']),
            new Middleware('permission:admin-edit', only: ['edit', 'update']),
            new Middleware('permission:admin-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $admins = $this->adminService->all(
            ['id', 'name', 'email'],
            ['roles' => function ($query) {
                $query->select('name');
            }]
        );
        return view('backend.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all(['name']);
        return view('backend.admins.create', compact('roles'));
    }

    public function store(AdminStoreRequest $request)
    {
        try {
            $admin = $this->adminService->create($request->all());

            return redirect()
                ->route('admins.index')
                ->with('success', __('messages.admin.created'));
        } catch (Exception $e) {
            report($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.error.general'));
        }
    }

    public function edit($id)
    {
        $admin = $this->adminService->getById($id);
        $roles = Role::all(['name']);

        return view('backend.admins.edit', compact('admin', 'roles'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        try {
            $admin = $this->adminService->update($id, $request->all());

            return redirect()
                ->route('admins.index')
                ->with('success', __('messages.admin.updated'));
        } catch (Exception $e) {
            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.error.general'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->adminService->delete($id);

            return redirect()
                ->route('admins.index')
                ->with('success', __('messages.admin.deleted'));
        } catch (Exception $e) {
            report($e);

            return redirect()
                ->back()
                ->with('error', __('messages.error.general'));
        }
    }
}
