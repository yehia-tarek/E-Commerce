<?php

namespace App\Services\DataTables;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoriesDataTable
{
    public function build()
    {
        $query = Category::select(
            [
                "categories.id",
                "categories.name",
                "categories.slug",
                "categories.created_at",
                "parent.name as parent_name",
            ]
        )->leftJoin('categories as parent', "categories.parent_id", "=", "parent.id");

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($row) {
                return $this->actionsColumn($row);
            })
            ->rawColumns(['id','actions'])
            ->make(true);
    }

    public function actionsColumn($row)
    {
        $editBtn = '<a href="' . route('categories.edit', $row->id) . '" class="btn btn-outline-primary btn-sm me-2" title="Edit Category">
                    <i class="fas fa-edit"></i> Edit
                </a>';

        $deleteBtn = '<form action="' . route('categories.destroy', $row->id) . '" method="POST" class="d-inline">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm(\'Are you sure you want to delete this Category?\')"
                        title="Delete Category">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>';

        return '<div class="btn-group" role="group">' . $editBtn . $deleteBtn . '</div>';
    }
}
