@extends('layouts.admin')
@section('content')
@can('session_duty_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.session-duties.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sessionDuty.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sessionDuty.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SessionDuty">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sessionDuty.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sessionDuty.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.dailyWageEmployee.fields.ten') }}
                        </th>
                        <th>
                            {{ trans('cruds.sessionDuty.fields.session') }}
                        </th>
                        <th>
                            {{ trans('cruds.sessionDuty.fields.owned_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.sessionDuty.fields.section_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessionDuties as $key => $sessionDuty)
                        <tr data-entry-id="{{ $sessionDuty->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sessionDuty->id ?? '' }}
                            </td>
                            <td>
                                {{ $sessionDuty->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $sessionDuty->employee->ten ?? '' }}
                            </td>
                            <td>
                                {{ $sessionDuty->session->name ?? '' }}
                            </td>
                            <td>
                                {{ $sessionDuty->owned_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $sessionDuty->section_name ?? '' }}
                            </td>
                            <td>
                                @can('session_duty_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.session-duties.show', $sessionDuty->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('session_duty_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.session-duties.edit', $sessionDuty->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('session_duty_delete')
                                    <form action="{{ route('admin.session-duties.destroy', $sessionDuty->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('session_duty_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.session-duties.massDestroy') }}",
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
  let table = $('.datatable-SessionDuty:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection