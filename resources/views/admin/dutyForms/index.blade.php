@extends('layouts.admin')
@section('content')

  

<div class="card">
    <div class="card-header">
        {{ trans('cruds.dutyForm.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DutyForm">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.form_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.session') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.total_hours') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.owned_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.dutyForm.fields.section_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dutyForms as $key => $dutyForm)
                        <tr data-entry-id="{{ $dutyForm->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dutyForm->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DutyForm::FORM_TYPE_SELECT[$dutyForm->form_type] ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->date->date ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->session->name ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->employee->ten ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->total_hours ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->owned_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $dutyForm->section_name ?? '' }}
                            </td>
                            <td>
                                @can('duty_form_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.duty-forms.show', $dutyForm->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                              <!--   @can('duty_form_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.duty-forms.edit', $dutyForm->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan -->

                               <!--  @can('duty_form_delete')
                                    <form action="{{ route('admin.duty-forms.destroy', $dutyForm->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan -->

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], [])

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-DutyForm:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection