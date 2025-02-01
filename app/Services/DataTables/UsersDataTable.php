<?php

namespace App\Services\DataTables;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UsersDataTable
{
    public function build()
    {
        return DataTables::of(User::query())
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('birth_date', function ($row) {
                return $row->birth_date->format('Y-m-d');
            })
            ->editColumn('gender', function ($row) {
                return $row->gender == 'male' ? '<span class="badge bg-primary">Male</span>' : '<span class="badge bg-danger">Female</span>';
            })
            ->addColumn('actions', function ($row) {
                return $this->actionsColumn($row);
            })
            ->rawColumns(['actions', 'id', 'gender'])
            ->make(true);
    }

    public function actionsColumn($row)
    {
        $editBtn = '<a href="' . route('customers.edit', $row->id) . '" class="btn btn-outline-primary btn-sm me-2" title="Edit Customer">
                    <i class="fas fa-edit"></i> Edit
                </a>';

        $deleteBtn = '<form action="' . route('customers.destroy', $row->id) . '" method="POST" class="d-inline">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm(\'Are you sure you want to delete this user?\')"
                        title="Delete Customer">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>';

        return '<div class="btn-group" role="group">' . $editBtn . $deleteBtn . '</div>';
    }
}
