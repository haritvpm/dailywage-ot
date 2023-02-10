@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dailyWageEmployee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-wage-employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.id') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.name') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->ten }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.designation') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->designation->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.category') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->category->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.section') }}
                        </th>
                        <td>
                            {{ $dailyWageEmployee->section->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-wage-employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection