@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sessionDutyItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.session-duty-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.id') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.fn_from') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->fn_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.fn_to') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->fn_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.an_from') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->an_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.an_to') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->an_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.total_hours') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->total_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.date') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->date->date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sessionDutyItem.fields.form') }}
                        </th>
                        <td>
                            {{ $sessionDutyItem->form->section_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.session-duty-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection