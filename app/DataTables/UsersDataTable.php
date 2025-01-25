<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($row) {
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
            })
            ->addColumn('DT_RowIndex', function ($row) {
                return $row->DT_RowIndex + 1;
            })
            ->editColumn('last_login', function ($row) {
                return ($row->last_login) ? $row->last_login->format('d-m-Y H:i:s') : '-';
            })
            ->editColumn('birth_date', function ($row) {
                return $row->birth_date ? $row->birth_date->format('d-m-Y') : '-';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('d-m-Y H:i:s') : '-';
            })
            ->addColumn('gender', function ($row) {
                return $row->gender == 'male' ? '<span class="badge bg-primary">Male</span>' : '<span class="badge bg-danger">Female</span>';
            })
            ->rawColumns(['action', 'gender']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bfrltip',
                'select' => [
                    'style' => 'os',
                    'selector' => 'td:first-child',
                ],
            ])
            ->minifiedAjax()
            ->orderBy(3)
            ->buttons(
                Button::make('add'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reload'),
            );
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No'),
            Column::make('name'),
            Column::make('email'),
            Column::make('birth_date'),
            Column::make('gender'),
            Column::make('last_login'),
            Column::make('created_at'),
            Column::make('action'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
