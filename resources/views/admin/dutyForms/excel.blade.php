<div >
<table>
    <thead>
    <tr>
        @foreach($monthcols as $key => $month)
        <th style="text-align: center" colspan={{$month}}>{{$key}}</th>
        @endforeach
        <th style="text-align: center">Sum</th>
    </tr>
    </thead>
    <tbody>
  
        <tr>
        @foreach($dates as $d)
            <td style="text-align: center">{{ $d->day }}</td>
        @endforeach
        <td style="text-align: center">=SUM(A2:D2)</td>
        </tr>
  
    </tbody>
</table>
</div>
