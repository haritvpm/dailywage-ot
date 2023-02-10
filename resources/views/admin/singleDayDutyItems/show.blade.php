@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.singleDayDutyItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.single-day-duty-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.id') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.employee') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->employee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.fn_from') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->fn_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.fn_to') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->fn_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.an_from') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->an_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.an_to') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->an_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.total_hours') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->total_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.form') }}
                        </th>
                        <td>
                            {{ $singleDayDutyItem->form->section_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.single-day-duty-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection