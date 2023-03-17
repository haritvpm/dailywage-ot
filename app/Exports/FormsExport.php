<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\DutyForm;
use App\Models\Calender;
use App\Models\Session;
use App\Models\Category;
use App\Models\DutyFormItem;


class FormsExport implements WithMultipleSheets
{
           
    public function __construct(
                                )
    {
      
    }

    function num2alpha($n)
    {
        for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
            $r = chr($n%26 + 0x41) . $r;
        return $r;
    }

    function sumformula(int $sl, $dates)
    {
       $row = $sl + 5; //
       $lastdatecol = 4+count($dates)-1;
       return "=SUM(E" . $row . ':' . num2alpha($lastdatecol) . $row . ')';
    }
    
    function tohoursformula(int $sl, $dates)
    {
       $row = $sl + 5; 
       $hourscol = 4+count($dates);
       return "=ROUNDDOWN(" . num2alpha($hourscol) . $row . '/8,0)';
    }
    function torupeesformula(int $sl, $dates, $wage)
    {
       $row = $sl + 5; 
       $dayscol = 4+count($dates)+1;
       return "=" . num2alpha($dayscol) . $row . '*' . $wage;
    }
    function totalformula(int $sl, $dates)
    {
       $fromcol = 6;
       $lastrow = $sl + 5; 
       $otcol = 4+count($dates)+2;

       return "=SUM(" . num2alpha($otcol) . $fromcol . ':' . num2alpha($otcol) . $lastrow . ')';
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        $session = Session::where('status', 'active')->latest()->first();

        $dates = Calender::selectRaw('id, date, type, year(date) AS year, DATE_FORMAT(date, \'%b\') AS monthname, MONTH(date) month , DAYOFMONTH(date) AS day')
        ->where('session_id',  $session->id)
        ->orderBy('date', 'asc')
        ->get();
      //  dump($dates );
        
        $monthcols =  $dates->groupBy('monthname')->map->count();
        $categories = Category::all();
      
       

        $formitems = DutyFormItem::with(['form','date', 'employee', 'form.employee', 'form.date'])
                        ->whereHas('form', function($f) use($session){
                            $f->where('session_id', $session->id)
                              ->where('owned_by_id', auth()->user()->id);
                        })
                        ->get();
       

        $data = array();
        $empinfo = array();

        foreach ($formitems as $item) {
            if( $item->form->form_type == 'oneday-multiemp' )
            {   
                $key = $item->employee->displayname;
                if(!array_key_exists($key, $data)) {
                    foreach ($dates as $date) {
                        $data[$key][$date->id] = '';
                    }
                }

               // $data[$key][$item->form->date_id] = $item->total_hours;
                $empinfo[$key]['category_id'] = $item->employee->category_id;
                $empinfo[$key]['name'] = $item->employee->name;
                $empinfo[$key]['ten'] = $item->employee->ten;
                $empinfo[$key]['desig'] = $item->employee->designation->title;
                $empinfo[$key]['wage'] = $item->employee->designation->wage;
                $empinfo[$key]['data'][$item->form->date_id] = $item->total_hours;

            } else {

                $key = $item->form->employee->displayname;
                if(!array_key_exists($key, $data)) { //fill with sorted dateid
                    foreach ($dates as $date) {
                        $data[$key][$date->id] = '';
                    }
                }

              //  $data[$key][$item->date_id] = $item->total_hours;
                $empinfo[$key]['category_id']  = $item->form->employee->category_id;
                $empinfo[$key]['name']  = $item->form->employee->name;
                $empinfo[$key]['ten']  = $item->form->employee->ten;
                $empinfo[$key]['desig']  = $item->form->employee->designation->title;
                $empinfo[$key]['wage']  = $item->form->employee->designation->wage;
                $empinfo[$key]['data'][$item->date_id] = $item->total_hours;
            }
            
        }
        
        //sort by category so we get continuous index for each category
        $dataforcategory = [];
        foreach ($categories as $category) {
            foreach ($empinfo as $key => $value) {
                if(  $value['category_id']  == $category->id ){
                    $dataforcategory [$category->id][$key] = $value;
                }
            }
        }
        

        $sheets = [];
        $sheets[] = new FormsExportConsolidatedSheet(
                        $dates, 
                        $monthcols, 
                        $session,
                        $data,  $empinfo 
                    );
        foreach ($categories as $category) {
          
            $sheets[] = new FormsExportCategorySheet($category,
                                                            $dates, 
                                                            $monthcols, 
                                                            $session,
                                                            $dataforcategory[$category->id] 
        
                                );
        }

        return $sheets;
    }

}
