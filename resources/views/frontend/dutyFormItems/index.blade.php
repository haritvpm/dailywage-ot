@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('duty_form_item_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.duty-form-items.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.dutyFormItem.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dutyFormItem.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-DutyFormItem">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.form') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.fn_from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.fn_to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.an_from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.an_to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dutyFormItem.fields.total_hours') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dutyFormItems as $key => $dutyFormItem)
                                    <tr data-entry-id="{{ $dutyFormItem->id }}">
                                        <td>
                                            {{ $dutyFormItem->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->form->form_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->date->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->employee->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->employee->ten ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->fn_from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->fn_to ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->an_from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->an_to ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dutyFormItem->total_hours ?? '' }}
                                        </td>
                                        <td>
                                            @can('duty_form_item_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.duty-form-items.show', $dutyFormItem->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('duty_form_item_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.duty-form-items.edit', $dutyFormItem->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('duty_form_item_delete')
                                                <form action="{{ route('frontend.duty-form-items.destroy', $dutyFormItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('duty_form_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.duty-form-items.massDestroy') }}",
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
  let table = $('.datatable-DutyFormItem:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection