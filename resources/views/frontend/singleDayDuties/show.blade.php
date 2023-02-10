@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.singleDayDuty.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.single-day-duties.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.singleDayDuty.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $singleDayDuty->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.singleDayDuty.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $singleDayDuty->date->date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.singleDayDuty.fields.total_hours') }}
                                    </th>
                                    <td>
                                        {{ $singleDayDuty->total_hours }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.singleDayDuty.fields.owned_by') }}
                                    </th>
                                    <td>
                                        {{ $singleDayDuty->owned_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.singleDayDuty.fields.section_name') }}
                                    </th>
                                    <td>
                                        {{ $singleDayDuty->section_name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.single-day-duties.index') }}">
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