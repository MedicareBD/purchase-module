<?php

namespace Modules\Purchase\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\Purchase\Entities\Purchase;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', fn ($model) => format_date($model->created_at))
            ->addColumn('action', 'purchase::action')
            ->setRowId('id');
    }

    public function query(Purchase $model): QueryBuilder
    {
        return $model->customersScope()->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customer-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom(config('custom.table.dom'))
            ->orderBy(1)
            ->stateSave()
            ->autoWidth()
            ->responsive()
            ->addTableClass(config('custom.table.class'))
            ->parameters([
                'scrollY' => true,
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')
                ->data('DT_RowIndex')
                ->printable(false)
                ->exportable(false)
                ->orderable(false)
                ->title('#'),
            //Column::make('name')->title(__("Name")),
            Column::make('created_at')->title(__('Created At')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Action'),
        ];
    }

    protected function filename(): string
    {
        return 'Purchases_'.date('YmdHis');
    }
}
