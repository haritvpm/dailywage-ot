@extends('layouts.admin')
@section('content')
@can('daily_wage_employee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.daily-wage-employees.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dailyWageEmployee.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DailyWageEmployee', 'route' => 'admin.daily-wage-employees.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dailyWageEmployee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DailyWageEmployee">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.designation') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.section') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyWageEmployees as $key => $dailyWageEmployee)
                        <tr data-entry-id="{{ $dailyWageEmployee->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dailyWageEmployee->id ?? '' }}
                            </td>
                            <td>
                                {{ $dailyWageEmployee->name ?? '' }}
                            </td>
                            <td>
                                {{ $dailyWageEmployee->ten ?? '' }}
                            </td>
                            <td>
                                {{ $dailyWageEmployee->designation->title ?? '' }}
                            </td>
                            <td>
                                {{ $dailyWageEmployee->category->title ?? '' }}
                            </td>
                            <td>
                                {{ $dailyWageEmployee->section->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DailyWageEmployee::STATUS_SELECT[$dailyWageEmployee->status] ?? '' }}
                            </td>
                            <td>
                                @can('daily_wage_employee_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.daily-wage-employees.show', $dailyWageEmployee->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('daily_wage_employee_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.daily-wage-employees.edit', $dailyWageEmployee->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('daily_wage_employee_delete')
                                    <form action="{{ route('admin.daily-wage-employees.destroy', $dailyWageEmployee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('daily_wage_employee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.daily-wage-employees.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-DailyWageEmployee:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection