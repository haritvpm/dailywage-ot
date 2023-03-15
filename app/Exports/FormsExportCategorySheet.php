<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithTitle;

class FormsExportCategorySheet implements FromView, WithTitle, ShouldAutoSize
{
    public function __construct(protected $category,
                                protected $dates, 
                                protected $monthcols, 
                                protected $session,
                                protected $data, protected  $empinfo )
    {
       
    }
    
    public function view(): View
    {
        $dataforcategory = null;
        foreach ($this->data as $key => $value) {
            if( $this->empinfo[$key]['category_id']  == $this->category->id ){
                $dataforcategory [$key] = $value;
            }
        }
        dump($dataforcategory);
        return view('admin.dutyForms.excel',
                        [
                            'category' => $this->category->title,
                            'monthcols' => $this->monthcols,
                            'dates' => $this->dates,
                            'session' => $this->session,
                            'data' => $dataforcategory,
                            'empinfo' => $this->empinfo,
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
