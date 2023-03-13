<?php

namespace App\Exports;
// namespace App\Exports\Sheets;

use App\Models\DutyForm;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Calender;
use App\Models\Session;
use Maatwebsite\Excel\Concerns\WithTitle;

class FormsExportConsolidatedSheet implements FromView, WithTitle
{
    public function __construct(
                            protected $dates, 
                            protected $monthcols, 
                            protected $session,
                            protected $data )
    {
       
    }
    
    public function view(): View
    {
            
        return view('admin.dutyForms.excel',
        [
            'monthcols' => $this->monthcols,
            'dates' => $this->dates,
            'session' => $this->session,
        ]

        );
    }
    public function title(): string
    {
        return 'Consolidated';
    }

}
