@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.dutyFormItem.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.duty-form-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.form') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->form->form_type ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->date->date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->employee->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.fn_from') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->fn_from }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.fn_to') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->fn_to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.an_from') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->an_from }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.an_to') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->an_to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.total_hours') }}
                                    </th>
                                    <td>
                                        {{ $dutyFormItem->total_hours }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.duty-form-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection