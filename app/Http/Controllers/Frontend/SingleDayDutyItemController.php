<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySingleDayDutyItemRequest;
use App\Http\Requests\StoreSingleDayDutyItemRequest;
use App\Http\Requests\UpdateSingleDayDutyItemRequest;
use App\Models\DailyWageEmployee;
use App\Models\SingleDayDuty;
use App\Models\SingleDayDutyItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SingleDayDutyItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('single_day_duty_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDutyItems = SingleDayDutyItem::with(['employee', 'form', 'created_by'])->get();

        return view('frontend.singleDayDutyItems.index', compact('singleDayDutyItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('single_day_duty_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $forms = SingleDayDuty::pluck('section_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.singleDayDutyItems.create', compact('employees', 'forms'));
    }

    public function store(StoreSingleDayDutyItemRequest $request)
    {
        $singleDayDutyItem = SingleDayDutyItem::create($request->all());

        return redirect()->route('frontend.single-day-duty-items.index');
    }

    public function edit(SingleDayDutyItem $singleDayDutyItem)
    {
        abort_if(Gate::denies('single_day_duty_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $forms = SingleDayDuty::pluck('section_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $singleDayDutyItem->load('employee', 'form', 'created_by');

        return view('frontend.singleDayDutyItems.edit', compact('employees', 'forms', 'singleDayDutyItem'));
    }

    public function update(UpdateSingleDayDutyItemRequest $request, SingleDayDutyItem $singleDayDutyItem)
    {
        $singleDayDutyItem->update($request->all());

        return redirect()->route('frontend.single-day-duty-items.index');
    }

    public function show(SingleDayDutyItem $singleDayDutyItem)
    {
        abort_if(Gate::denies('single_day_duty_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDutyItem->load('employee', 'form', 'created_by');

        return view('frontend.singleDayDutyItems.show', compact('singleDayDutyItem'));
    }

    public function destroy(SingleDayDutyItem $singleDayDutyItem)
    {
        abort_if(Gate::denies('single_day_duty_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $singleDayDutyItem->delete();

        return back();
    }

    public function massDestroy(MassDestroySingleDayDutyItemRequest $request)
    {
        SingleDayDutyItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
