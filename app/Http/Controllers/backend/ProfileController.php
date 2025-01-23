<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Admin\IAdminService;
use App\Http\Requests\Backend\Profile\ProfileRequest;
use App\Http\Requests\Backend\Profile\UpdatePasswordRequest;

class ProfileController extends Controller
{

    public function __construct(
        private IAdminService $adminService,
    ) {}

    public function index()
    {
        return view('backend.profile');
    }

    public function update(ProfileRequest $request)
    {
        $this->adminService->update(auth()->user()->id, $request->validated());

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->adminService->updatePassword(auth()->user()->id, $request->validated());

        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
