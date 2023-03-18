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
    function num2alpha($n)
    {
        for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
            $r = chr($n%26 + 0x41) . $r;
        return $r;
    }
    function grandtotalformula(int $sl)
    {
       $col = 7;
       $rowstart = 4; 
       $rowend = $sl + $rowstart  ; 
      
       return "=SUM(" . $this->num2alpha($col) . $rowstart . ':' . $this->num2alpha($col) . $rowend . ')';
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
            'grandtotalformula' => $this->grandtotalformula(count($this->dataforcategory)),
        ]

        );
    }
    public function title(): string
    {
        return 'Consolidated';
    }

}
