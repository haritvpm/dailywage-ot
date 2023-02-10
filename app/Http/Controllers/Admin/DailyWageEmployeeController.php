<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDailyWageEmployeeRequest;
use App\Http\Requests\StoreDailyWageEmployeeRequest;
use App\Http\Requests\UpdateDailyWageEmployeeRequest;
use App\Models\Category;
use App\Models\DailyWageEmployee;
use App\Models\Designation;
use App\Models\Section;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DailyWageEmployeeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('daily_wage_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyWageEmployees = DailyWageEmployee::with(['designation', 'category', 'section'])->get();

        return view('admin.dailyWageEmployees.index', compact('dailyWageEmployees'));
    }

    public function create()
    {
        abort_if(Gate::denies('daily_wage_employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designations = Designation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dailyWageEmployees.create', compact('categories', 'designations', 'sections'));
    }

    public function store(StoreDailyWageEmployeeRequest $request)
    {
        $dailyWageEmployee = DailyWageEmployee::create($request->all());

        return redirect()->route('admin.daily-wage-employees.index');
    }

    public function edit(DailyWageEmployee $dailyWageEmployee)
    {
        abort_if(Gate::denies('daily_wage_employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designations = Designation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dailyWageEmployee->load('designation', 'category', 'section');

        return view('admin.dailyWageEmployees.edit', compact('categories', 'dailyWageEmployee', 'designations', 'sections'));
    }

    public function update(UpdateDailyWageEmployeeRequest $request, DailyWageEmployee $dailyWageEmployee)
    {
        $dailyWageEmployee->update($request->all());

        return redirect()->route('admin.daily-wage-employees.index');
    }

    public function show(DailyWageEmployee $dailyWageEmployee)
    {
        abort_if(Gate::denies('daily_wage_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyWageEmployee->load('designation', 'category', 'section');

        return view('admin.dailyWageEmployees.show', compact('dailyWageEmployee'));
    }

    public function destroy(DailyWageEmployee $dailyWageEmployee)
    {
        abort_if(Gate::denies('daily_wage_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyWageEmployee->delete();

        return back();
    }

    public function massDestroy(MassDestroyDailyWageEmployeeRequest $request)
    {
        DailyWageEmployee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
