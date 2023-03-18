<?php

namespace App\Exports;
// namespace App\Exports\Sheets;

use App\Models\DutyForm;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Calender;
use App\Models\Session;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormsExportConsolidatedSheet implements FromView, WithTitle, ShouldAutoSize
{
    public function __construct(
                            protected $categories,
                            protected $dates, 
                            protected $monthcols, 
                            protected $session,
                            protected $dataforcategory )
    {
       
    }
    
    public function view(): View
    {
            
        return view('admin.dutyForms.excel-consolidated',
        [
            'monthcols' => $this->monthcols,
            'dates' => $this->dates,
            'session' => $this->session,
            'categories' => $this->categories,
            'dataforcategory' => $this->dataforcategory,
        ]

        );
    }
    public function title(): string
    {
        return 'Consolidated';
    }

}
