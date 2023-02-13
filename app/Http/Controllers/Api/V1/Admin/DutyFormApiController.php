<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDutyFormRequest;
use App\Http\Requests\UpdateDutyFormRequest;
use App\Http\Resources\Admin\DutyFormResource;
use App\Models\DutyForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DutyFormApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('duty_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DutyFormResource(DutyForm::with(['date', 'session', 'employee', 'owned_by', 'created_by'])->get());
    }

    public function store(StoreDutyFormRequest $request)
    {
        $dutyForm = DutyForm::create($request->all());

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DutyForm $dutyForm)
    {
        abort_if(Gate::denies('duty_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DutyFormResource($dutyForm->load(['date', 'session', 'employee', 'owned_by', 'created_by']));
    }

    public function update(UpdateDutyFormRequest $request, DutyForm $dutyForm)
    {
        $dutyForm->update($request->all());

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DutyForm $dutyForm)
    {
        abort_if(Gate::denies('duty_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dutyForm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
