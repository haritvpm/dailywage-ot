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
  
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        @foreach($dates as $d)
            <td style="text-align: center">{{ $d->day }}</td>
        @endforeach
        <td style="text-align: center">=SUM(A2:D2)</td>
        <td ></td>
        <td ></td>
        </tr>
  
    </tbody>
</table>
</div>
