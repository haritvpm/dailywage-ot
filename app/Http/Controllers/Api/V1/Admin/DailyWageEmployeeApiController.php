<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDailyWageEmployeeRequest;
use App\Http\Requests\UpdateDailyWageEmployeeRequest;
use App\Http\Resources\Admin\DailyWageEmployeeResource;
use App\Models\DailyWageEmployee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DailyWageEmployeeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daily_wage_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyWageEmployeeResource(DailyWageEmployee::with(['designation', 'category', 'section'])->get());
    }

    public function store(StoreDailyWageEmployeeRequest $request)
    {
        $dailyWageEmployee = DailyWageEmployee::create($request->all());

        return (new DailyWageEmployeeResource($dailyWageEmployee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DailyWageEmployee $dailyWageEmployee)
    {
        abort_if(Gate::denies('daily_wage_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyWageEmployeeResource($dailyWageEmployee->load(['designation', 'category', 'section']));
    }

    public function update(UpdateDailyWageEmployeeRequest $request, DailyWageEmployee $dailyWageEmployee)
    {
        $dailyWageEmployee->update($request->all());

        return (new DailyWageEmployeeResource($dailyWageEmployee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DailyWageEmployee $dailyWageEmployee)
    {
        abort_if(Gate::denies('daily_wage_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyWageEmployee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
