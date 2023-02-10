<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySingleDayDutyRequest;
use App\Http\Requests\StoreSingleDayDutyRequest;
use App\Http\Requests\UpdateSingleDayDutyRequest;
use App\Models\Calender;
use App\Models\SingleDayDuty;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SingleDayDutyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('single_day_duty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDuties = SingleDayDuty::with(['date', 'owned_by', 'created_by'])->get();

        return view('frontend.singleDayDuties.index', compact('singleDayDuties'));
    }

    public function create()
    {
        abort_if(Gate::denies('single_day_duty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.singleDayDuties.create', compact('dates', 'owned_bies'));
    }

    public function store(StoreSingleDayDutyRequest $request)
    {
        $singleDayDuty = SingleDayDuty::create($request->all());

        return redirect()->route('frontend.single-day-duties.index');
    }

    public function edit(SingleDayDuty $singleDayDuty)
    {
        abort_if(Gate::denies('single_day_duty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $singleDayDuty->load('date', 'owned_by', 'created_by');

        return view('frontend.singleDayDuties.edit', compact('dates', 'owned_bies', 'singleDayDuty'));
    }

    public function update(UpdateSingleDayDutyRequest $request, SingleDayDuty $singleDayDuty)
    {
        $singleDayDuty->update($request->all());

        return redirect()->route('frontend.single-day-duties.index');
    }

    public function show(SingleDayDuty $singleDayDuty)
    {
        abort_if(Gate::denies('single_day_duty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDuty->load('date', 'owned_by', 'created_by');

        return view('frontend.singleDayDuties.show', compact('singleDayDuty'));
    }

    public function destroy(SingleDayDuty $singleDayDuty)
    {
        abort_if(Gate::denies('single_day_duty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDuty->delete();

        return back();
    }

    public function massDestroy(MassDestroySingleDayDutyRequest $request)
    {
        SingleDayDuty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
