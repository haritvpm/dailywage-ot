<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCalenderRequest;
use App\Http\Requests\StoreCalenderRequest;
use App\Http\Requests\UpdateCalenderRequest;
use App\Models\Calender;
use App\Models\Session;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalenderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('calender_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calenders = Calender::with(['session'])->get();

        return view('admin.calenders.index', compact('calenders'));
    }

    public function create()
    {
        abort_if(Gate::denies('calender_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.calenders.create', compact('sessions'));
    }

    public function store(StoreCalenderRequest $request)
    {
        $calender = Calender::create($request->all());

        return redirect()->route('admin.calenders.index');
    }

    public function edit(Calender $calender)
    {
        abort_if(Gate::denies('calender_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $calender->load('session');

        return view('admin.calenders.edit', compact('calender', 'sessions'));
    }

    public function update(UpdateCalenderRequest $request, Calender $calender)
    {
        $calender->update($request->all());

        return redirect()->route('admin.calenders.index');
    }

    public function show(Calender $calender)
    {
        abort_if(Gate::denies('calender_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calender->load('session');

        return view('admin.calenders.show', compact('calender'));
    }

    public function destroy(Calender $calender)
    {
        abort_if(Gate::denies('calender_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $calender->delete();

        return back();
    }

    public function massDestroy(MassDestroyCalenderRequest $request)
    {
        Calender::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
