<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySessionDutyItemRequest;
use App\Http\Requests\StoreSessionDutyItemRequest;
use App\Http\Requests\UpdateSessionDutyItemRequest;
use App\Models\Calender;
use App\Models\SessionDuty;
use App\Models\SessionDutyItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionDutyItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('session_duty_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDutyItems = SessionDutyItem::with(['date', 'form', 'created_by'])->get();

        return view('admin.sessionDutyItems.index', compact('sessionDutyItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('session_duty_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $forms = SessionDuty::pluck('section_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sessionDutyItems.create', compact('dates', 'forms'));
    }

    public function store(StoreSessionDutyItemRequest $request)
    {
        $sessionDutyItem = SessionDutyItem::create($request->all());

        return redirect()->route('admin.session-duty-items.index');
    }

    public function edit(SessionDutyItem $sessionDutyItem)
    {
        abort_if(Gate::denies('session_duty_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = Calender::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $forms = SessionDuty::pluck('section_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sessionDutyItem->load('date', 'form', 'created_by');

        return view('admin.sessionDutyItems.edit', compact('dates', 'forms', 'sessionDutyItem'));
    }

    public function update(UpdateSessionDutyItemRequest $request, SessionDutyItem $sessionDutyItem)
    {
        $sessionDutyItem->update($request->all());

        return redirect()->route('admin.session-duty-items.index');
    }

    public function show(SessionDutyItem $sessionDutyItem)
    {
        abort_if(Gate::denies('session_duty_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDutyItem->load('date', 'form', 'created_by');

        return view('admin.sessionDutyItems.show', compact('sessionDutyItem'));
    }

    public function destroy(SessionDutyItem $sessionDutyItem)
    {
        abort_if(Gate::denies('session_duty_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessionDutyItem->delete();

        return back();
    }

    public function massDestroy(MassDestroySessionDutyItemRequest $request)
    {
        SessionDutyItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
