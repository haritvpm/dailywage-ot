@php

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
    <tr>       <th style="text-align: center" colspan={{count($dates)+7}}> {{$category_title}} </th>        </tr>
    <tr>
        <th rowspan='3' style="text-align: center">Sl.</th>
     
        <th rowspan='3'>TEN</th>  
        <th rowspan='3'>Name</th>
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
  
        @foreach($data as $key => $emp)
        <tr>
        <td style="text-align: center">{{$loop->iteration}}</td>
        <td>{{ $emp['ten'] }}</td>
        <td>{{ $emp['name'] }}</td>
        <td>{{ $emp['desig'] }}</td>
        @foreach($dates as $d)
            <td style="text-align: center">{{ $emp['data'][ $d->id] ?? ''}}</td>
        @endforeach
        <td style="text-align: center">{{$emp['sumformula']}}</td>
        <td style="text-align: center">{{$emp['tohoursformula']}}</td>
        <td style="text-align: center">{{$emp['torupeesformula']}}</td>
        </tr>
        @endforeach
        <tr>
        <td colspan={{count($dates)+6}} style="text-align: right">Total</td>
       
        <td style="text-align: center">{{totalformula( count($data) , $dates)}}</td>
        </tr>
    </tbody>
</table>
</div>
