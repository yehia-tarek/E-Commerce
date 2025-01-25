<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Services\User\IUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\CustomerStoreRequest;
use App\Http\Requests\Backend\User\CustomerUpdateRequest;

class CustomersController extends Controller
{
    public function __construct(private IUserService $userService) {}
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.customers.index');
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(CustomerStoreRequest $request)
    {
        try {
            $this->userService->create($request->all());
            return redirect()->route('customers.index')->with('success', 'Customer created successfully');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('customers.index')->with('error', 'Customer creation failed');
        }
    }

    public function edit($id)
    {
        $customer = User::find($id);
        return view('backend.customers.edit', compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, $id)
    {
        try {
            $customer = $this->userService->update($request->all(), $id);
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('customers.index')->with('error', 'Customer update failed');
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('customers.index')->with('error', 'Customer deletion failed');
        }
    }
}
