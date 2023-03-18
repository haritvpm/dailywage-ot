@php
   
    function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }

@endphp

<div >
<table>
    <thead>
    <tr> <th style="text-align: center" colspan='8'> {{addOrdinalNumberSuffix($session->assembly)}} KLA – {{addOrdinalNumberSuffix($session->session)}} SESSION</th>    </tr>
    <tr> <th style="text-align: center" colspan='8'>STATEMENT SHOWING OVERTIME ALLOWANCE TO DAILY WAGES STAFF </th>        </tr>
    <tr>
        <th style="text-align: center">Sl.</th>
        <th>TEN</th>
        <th>Name</th>
        <th>Desgn</th>
        <th style="text-align: center">OT Duty<br>(Hrs)</th>
        <th style="text-align: center">No. of  Days</th>
        <th style="text-align: center">Rate</th>
        <th style="text-align: center">Amount</th>
    </tr>

    </thead>
    <tbody>
  
        @foreach($dataforcategory as $c)
        @foreach($c as $key => $empinfo)
        
        <tr>
        <td style="text-align: center">{{$empinfo['sl'] }}</td>
        <td>{{ $empinfo['ten'] }}</td>
        <td>{{ $empinfo['name'] }}</td>
        <td>{{ $empinfo['desig'] }}</td>
        <td style="text-align: center">{{$empinfo['pagehourscelladr'] }}</td>
        <td style="text-align: center">{{$empinfo['pagedayscelladr']}}</td>
        <td style="text-align: center">{{ $empinfo['wage'] }}</td>
        <td style="text-align: center">{{$empinfo['pageamountcelladr']}}</td>
     
        </tr>
        @endforeach
        @endforeach
        <tr>
        <td colspan='7' style="text-align: right">Total</td>
        <td style="text-align: center">{{$grandtotalformula}}</td>
        </tr>
    </tbody>
</table>
</div>
