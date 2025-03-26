<?php

namespace App\DataTables\Employee;

use Carbon\Carbon;
use App\Models\Customer;
use App\Enums\CustomerStatus;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CustomersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', 'employee.customers.partials.actions')
            ->addColumn('action_status', function ($customer) {
                if (!$customer->action) {
                    return '<span class="badge bg-dark text-dark-fg">No Action</span>';
                }
    
                $status = $customer->action->action->value ?? null;
                return match (CustomerStatus::from($status)) {
                    CustomerStatus::CALL => '<span class="badge bg-azure text-azure-fg">Call</span>',
                    CustomerStatus::VISIT => '<span class="badge bg-lime text-lime-fg">Visit</span>',
                    CustomerStatus::FOLLOW_UP => '<span class="badge bg-yellow text-yellow-fg">Follow Up</span>',
                    default => '<span class="badge bg-red text-red-fg">Unknown</span>',
                };
            })
            ->rawColumns(['action_status','actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->where('employee_id', Auth::guard('employee')->user()->id)->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customer-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('email'),
            Column::make('action_status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Customer_' . date('YmdHis');
    }
}
