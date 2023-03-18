<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormsExportCategorySheet implements FromView, WithTitle, ShouldAutoSize
{
    public function __construct(protected $category,
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
    function pagetotalformula(int $sl, $dates)
    {
       $fromcol = 6;
       $lastrow = $sl + 5; 
       $otcol = 4+count($dates)+2;

       return "=SUM(" . $this->num2alpha($otcol) . $fromcol . ':' . $this->num2alpha($otcol) . $lastrow . ')';
    }

    public function view(): View
    {       
        return view('admin.dutyForms.excel-category',
                        [
                            'category_title' => $this->category?->longtitle ?? $this->category->title ,
                            'monthcols' => $this->monthcols,
                            'dates' => $this->dates,
                            'session' => $this->session,
                            'data' =>  $this->dataforcategory,
                            'pagetotalformula'=>  $this->pagetotalformula( count($this->dataforcategory), $this->dates ),
                        ]

                        );
    }

     /**
     * @return string
     */
    public function title(): string
    {
        return ($this->category->title);
    }
}
