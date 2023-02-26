<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDutyFormItemRequest;
use App\Http\Requests\StoreDutyFormItemRequest;
use App\Http\Requests\UpdateDutyFormItemRequest;
use App\Models\Calender;
use App\Models\DailyWageEmployee;
use App\Models\DutyForm;
use App\Models\DutyFormItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DutyFormItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('duty_form_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyFormItems = DutyFormItem::with(['form', 'date', 'employee', 'created_by'])->get();

        return view('admin.dutyFormItems.index', compact('dutyFormItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('duty_form_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forms = DutyForm::pluck('form_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dutyFormItems.create', compact('dates', 'employees', 'forms'));
    }

    public function store(StoreDutyFormItemRequest $request)
    {
        $dutyFormItem = DutyFormItem::create($request->all());

        return redirect()->route('admin.duty-form-items.index');
    }

    public function edit(DutyFormItem $dutyFormItem)
    {
        abort_if(Gate::denies('duty_form_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forms = DutyForm::pluck('form_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dutyFormItem->load('form', 'date', 'employee', 'created_by');

        return view('admin.dutyFormItems.edit', compact('dates', 'dutyFormItem', 'employees', 'forms'));
    }

    public function update(UpdateDutyFormItemRequest $request, DutyFormItem $dutyFormItem)
    {
        $dutyFormItem->update($request->all());

        return redirect()->route('admin.duty-form-items.index');
    }

    public function show(DutyFormItem $dutyFormItem)
    {
        abort_if(Gate::denies('duty_form_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyFormItem->load('form', 'date', 'employee', 'created_by');

        return view('admin.dutyFormItems.show', compact('dutyFormItem'));
    }

    public function destroy(DutyFormItem $dutyFormItem)
    {
        abort_if(Gate::denies('duty_form_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyFormItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyDutyFormItemRequest $request)
    {
        DutyFormItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
