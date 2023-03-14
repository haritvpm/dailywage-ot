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


@endphp

<div >
<table>
    <thead>
    <tr> <th style="text-align: center" colspan={{count($dates)+7}}>OVERTIME STATEMENT OF DAILY WAGES  </th>    </tr>
    <tr>       <th style="text-align: center" colspan={{count($dates)+7}}> {{$category}} </th>        </tr>
    <tr>
        <th rowspan='3'>Sl.</th>
        <th rowspan='3'>Name</th>
        <th rowspan='3'>TEN</th>
        <th rowspan='3'>Desig</th>
        <th style="text-align: center" colspan={{count($dates)}}> OT Duty (In Hours)</th>
        <th rowspan='3' style="text-align: center">Hours</th>
        <th rowspan='3' style="text-align: center">Days</th>
        <th rowspan='3' style="text-align: center">OT<br>Wages</th>
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
        <td>{{$loop->iteration}}</td>
        <td>{{$key}}</td>
        <td></td>
        <td></td>
             @foreach($value as $h)
            <td style="text-align: center">{{ $h }}</td>
            @endforeach
        <td style="text-align: center">{{sumformula($loop->iteration, $dates)}}</td>
        <td ></td>
        <td ></td>
        </tr>
        @endforeach
  
    </tbody>
</table>
</div>
