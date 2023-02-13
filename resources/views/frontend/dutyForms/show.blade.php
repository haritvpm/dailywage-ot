@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.dutyForm.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.duty-forms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.form_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\DutyForm::FORM_TYPE_SELECT[$dutyForm->form_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->date->date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.session') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->session->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->employee->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.total_hours') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->total_hours }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.owned_by') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->owned_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyForm.fields.section_name') }}
                                    </th>
                                    <td>
                                        {{ $dutyForm->section_name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.duty-forms.index') }}">
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