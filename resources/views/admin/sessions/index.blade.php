@extends('layouts.admin')
@section('content')
@can('session_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sessions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.session.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.session.title_singular') }} {{ trans('global.list') }}
        <br>Set 'Finished' to true so whole-session forms are available for entry
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover ">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.session.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.assembly') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.session') }}
                        </th>
                        <th>
                           Days
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.status') }}
                        </th>
                        <th>
                        {{ trans('cruds.session.fields.over') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $key => $session)
                        <tr data-entry-id="{{ $session->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $session->id ?? '' }}
                            </td>
                            <td>
                                {{ $session->name ?? '' }}
                            </td>
                            <td>
                                {{ $session->assembly ?? '' }}
                            </td>
                            <td>
                                {{ $session->session ?? '' }}
                            </td>
                            <td>
                                {{ $session->sessionCalenders->count() ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Session::STATUS_SELECT[$session->status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Session::STATUS_OVER[$session->over] ?? '' }}
                            </td>
                            <td>
                                @can('session_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('session_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sessions.edit', $session->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Session:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection