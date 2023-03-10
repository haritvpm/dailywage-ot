@php
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
@endphp

<div >
<table>
    <thead>
    <tr> <th style="text-align: center" colspan={{count($dates)+7}}>OVERTIME STATEMENT OF DAILY WAGES  </th>    </tr>
    <tr>       <th style="text-align: center" colspan={{count($dates)+7}}> {{$category}} </th>        </tr>
    <tr>
        <th rowspan='3' style="text-align: center">Sl.</th>
        <th rowspan='3'>Name</th>
        <th rowspan='3'>TEN</th>
        <th rowspan='3'>Desig</th>
        <th style="text-align: center" colspan={{count($dates)}}> OT Duty (In Hours)</th>
        <th rowspan='3' style="text-align: center">Hours</th>
        <th rowspan='3' style="text-align: center">Days</th>
        <th rowspan='3' style="text-align: center">OT</th>
    </tr>

    <tr>
    
        @foreach($monthcols as $key => $month)
           <th style="text-align: center" colspan={{$month}}>{{$key}}</th>
        @endforeach
       
    </tr>
    <tr>
    
            @foreach($dates as $d)
            <th style="text-align: center">{{$d->day}}</th>
            @endforeach
    
    </tr>

    </thead>
    <tbody>
  
        @foreach($data as $key => $value)
        <tr>
        <td style="text-align: center">{{$loop->iteration}}</td>
        <td>{{ $empinfo[$key]['name'] }}</td>
        <td>{{ $empinfo[$key]['ten'] }}</td>
        <td>{{ $empinfo[$key]['desig'] }}</td>
             @foreach($value as $h)
            <td style="text-align: center">{{ $h }}</td>
            @endforeach
        <td style="text-align: center">{{sumformula($loop->iteration, $dates)}}</td>
        <td style="text-align: center">{{tohoursformula($loop->iteration, $dates)}}</td>
        <td style="text-align: center">{{torupeesformula($loop->iteration, $dates,  $empinfo[$key]['wage'])}}</td>
        </tr>
        @endforeach
        <tr>
        <td colspan={{count($dates)+6}} style="text-align: right">Total</td>
       
        <td style="text-align: center">{{totalformula( count($data) , $dates)}}</td>
        </tr>
    </tbody>
</table>
</div>
