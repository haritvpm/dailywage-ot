<?php

namespace App\Exports;

use App\Models\DutyForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Calender;
use App\Models\Session;

class FormsExport implements FromView
{
    public function view(): View
    {
        
        $session = Session::where('status', 'active')->latest()->first();

        $dates = Calender::selectRaw('date, type, year(date) AS year, DATE_FORMAT(date, \'%b\') AS monthname, MONTH(date) month , DAYOFMONTH(date) AS day')
        ->where('session_id',  $session->id)
        ->orderBy('date', 'asc')
        ->get();
        
        $monthcols =  $dates->groupBy('monthname')->map->count();;

        return view('admin.dutyForms.excel', compact('monthcols', 'dates','session'));
    }

}
