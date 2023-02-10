@extends('layouts.admin')
@section('content')
@can('single_day_duty_item_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.single-day-duty-items.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.singleDayDutyItem.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.singleDayDutyItem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SingleDayDutyItem">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.fn_from') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.fn_to') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.an_from') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.an_to') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.total_hours') }}
                        </th>
                        <th>
                            {{ trans('cruds.singleDayDutyItem.fields.form') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($singleDayDutyItems as $key => $singleDayDutyItem)
                        <tr data-entry-id="{{ $singleDayDutyItem->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $singleDayDutyItem->id ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->employee->ten ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->fn_from ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->fn_to ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->an_from ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->an_to ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->total_hours ?? '' }}
                            </td>
                            <td>
                                {{ $singleDayDutyItem->form->section_name ?? '' }}
                            </td>
                            <td>
                                @can('single_day_duty_item_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.single-day-duty-items.show', $singleDayDutyItem->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('single_day_duty_item_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.single-day-duty-items.edit', $singleDayDutyItem->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('single_day_duty_item_delete')
                                    <form action="{{ route('admin.single-day-duty-items.destroy', $singleDayDutyItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('single_day_duty_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.single-day-duty-items.massDestroy') }}",
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
  let table = $('.datatable-SingleDayDutyItem:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection