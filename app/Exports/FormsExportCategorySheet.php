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
    
    public function view(): View
    {       
        return view('admin.dutyForms.excel-category',
                        [
                            'category_title' => $this->category->title,
                            'monthcols' => $this->monthcols,
                            'dates' => $this->dates,
                            'session' => $this->session,
                            'data' =>  $this->dataforcategory,
                           
                        ]

                        );
    }

     /**
     * @return string
     */
    public function title(): string
    {
        return $this->category->title;
    }
}
