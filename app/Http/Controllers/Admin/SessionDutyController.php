<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySessionDutyRequest;
use App\Http\Requests\StoreSessionDutyRequest;
use App\Http\Requests\UpdateSessionDutyRequest;
use App\Models\DailyWageEmployee;
use App\Models\Session;
use App\Models\SessionDuty;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionDutyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('session_duty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDuties = SessionDuty::with(['employee', 'session', 'owned_by', 'created_by'])->get();

        return view('admin.sessionDuties.index', compact('sessionDuties'));
    }

    public function create()
    {
        abort_if(Gate::denies('session_duty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sessionDuties.create', compact('employees', 'owned_bies', 'sessions'));
    }

    public function store(StoreSessionDutyRequest $request)
    {
        $sessionDuty = SessionDuty::create($request->all());

        return redirect()->route('admin.session-duties.index');
    }

    public function edit(SessionDuty $sessionDuty)
    {
        abort_if(Gate::denies('session_duty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = DailyWageEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessionDuty->load('employee', 'session', 'owned_by', 'created_by');

        return view('admin.sessionDuties.edit', compact('employees', 'owned_bies', 'sessionDuty', 'sessions'));
    }

    public function update(UpdateSessionDutyRequest $request, SessionDuty $sessionDuty)
    {
        $sessionDuty->update($request->all());

        return redirect()->route('admin.session-duties.index');
    }

    public function show(SessionDuty $sessionDuty)
    {
        abort_if(Gate::denies('session_duty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDuty->load('employee', 'session', 'owned_by', 'created_by');

        return view('admin.sessionDuties.show', compact('sessionDuty'));
    }

    public function destroy(SessionDuty $sessionDuty)
    {
        abort_if(Gate::denies('session_duty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDuty->delete();

        return back();
    }

    public function massDestroy(MassDestroySessionDutyRequest $request)
    {
        SessionDuty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
