<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDutyFormRequest;
use App\Http\Requests\StoreDutyFormRequest;
use App\Http\Requests\UpdateDutyFormRequest;
use App\Models\Calender;
use App\Models\DailyWageEmployee;
use App\Models\DutyForm;
use App\Models\Session;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DutyFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('duty_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyForms = DutyForm::with(['date', 'session', 'employee', 'owned_by', 'created_by'])->get();

        return view('admin.dutyForms.index', compact('dutyForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('duty_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dutyForms.create', compact('dates', 'employees', 'owned_bies', 'sessions'));
    }

    public function store(StoreDutyFormRequest $request)
    {
        $dutyForm = DutyForm::create($request->all());

        return redirect()->route('admin.duty-forms.index');
    }

    public function edit(DutyForm $dutyForm)
    {
        abort_if(Gate::denies('duty_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dutyForm->load('date', 'session', 'employee', 'owned_by', 'created_by');

        return view('admin.dutyForms.edit', compact('dates', 'dutyForm', 'employees', 'owned_bies', 'sessions'));
    }

    public function update(UpdateDutyFormRequest $request, DutyForm $dutyForm)
    {
        $dutyForm->update($request->all());

        return redirect()->route('admin.duty-forms.index');
    }

    public function show(DutyForm $dutyForm)
    {
        abort_if(Gate::denies('duty_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyForm->load('date', 'session', 'employee', 'owned_by', 'created_by');

        return view('admin.dutyForms.show', compact('dutyForm'));
    }

    public function destroy(DutyForm $dutyForm)
    {
        abort_if(Gate::denies('duty_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyDutyFormRequest $request)
    {
        DutyForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
