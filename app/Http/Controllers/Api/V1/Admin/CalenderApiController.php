<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalenderRequest;
use App\Http\Requests\UpdateCalenderRequest;
use App\Http\Resources\Admin\CalenderResource;
use App\Models\Calender;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
class CalenderApiController extends Controller
{
    public function index()
    {
      //  abort_if(Gate::denies('calender_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dates = Calender::with(['session'])
            ->whereHas('session', function($s){
                $s->where('status','active');
            })
            ->orderby('date')
            ->get()
            ->map(function ($d) {
                //return Carbon::createFromFormat('d/m/Y', $d->date)->format('Y/m/d');
                return [ 'id' =>  $d->id, 
                        'date'=> Carbon::createFromFormat('d/m/Y', $d->date)->format('M d,Y'),
                        'session_id' => $d->session->id,
                        'session_name' => $d->session->name,
                    ];
                //return  Carbon::createFromFormat('d/m/Y', $d)->format('M d, Y');
                
            });
        
        // dump($dates);
        return new CalenderResource($dates );

    }

    public function store(StoreCalenderRequest $request)
    {
        $calender = Calender::create($request->all());

        return (new CalenderResource($calender))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Calender $calender)
    {
        abort_if(Gate::denies('calender_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CalenderResource($calender->load(['session']));
    }

    public function update(UpdateCalenderRequest $request, Calender $calender)
    {
        $calender->update($request->all());

        return (new CalenderResource($calender))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Calender $calender)
    {
        abort_if(Gate::denies('calender_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calender->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
