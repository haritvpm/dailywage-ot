<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\DutyForm;
use App\Models\Calender;
use App\Models\Session;
use App\Models\Category;


class FormsExport implements WithMultipleSheets
{
           
    public function __construct(
                                )
    {
      
    }


    /**
     * @return array
     */
    public function sheets(): array
    {

        $session = Session::where('status', 'active')->latest()->first();

        $dates = Calender::selectRaw('date, type, year(date) AS year, DATE_FORMAT(date, \'%b\') AS monthname, MONTH(date) month , DAYOFMONTH(date) AS day')
        ->where('session_id',  $session->id)
        ->orderBy('date', 'asc')
        ->get();
        
        $monthcols =  $dates->groupBy('monthname')->map->count();
        $categories = Category::all();
      
        $data = [];
        $sheets = [];
       /* $sheets[] = new FormsExportConsolidatedSheet(
                        $this->$dates, 
                        $this->$monthcols, 
                        $this->$session,
                        $this->$data 
                    );*/

        foreach ($categories as $category) {
          
            $sheets[] = new FormsExportCategorySheet($category,
                                                            $dates, 
                                                            $monthcols, 
                                                            $session,
                                                            $data 
        
                                );
        }

        return $sheets;
    }

}
