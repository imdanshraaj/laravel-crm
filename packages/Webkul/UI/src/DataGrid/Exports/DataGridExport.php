<?php

namespace Webkul\UI\DataGrid\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataGridExport implements FromView, ShouldAutoSize
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(protected $gridData) {}

    /**
     * Method to create a blade view for export.
     */
    public function view(): View
    {
        $columns = [];

        foreach ($this->gridData as $key => $gridData) {
            $columns = array_keys((array) $gridData);

            break;
        }

        return view('ui::export.temp', [
            'columns' => $columns,
            'records' => $this->gridData,
        ]);
    }
}
