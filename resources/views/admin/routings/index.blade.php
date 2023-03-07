@extends('layouts.admin')

@section('content')
    <h3 class="page-title">@lang('cruds.routing.title')</h3>
    @can('user_access')
    <p>
        <a href="{{ route('admin.routings.create') }}" class="btn btn-success">@lang('global.create')</a>
        
    </p>
    @endcan

    

    <div class="card">
        

        <div class="card-body">
            <table class="table table-bordered table-striped datatable datatable-routings">
                <thead>
                    <tr>
                    <th width="10">

</th>
                        <th>@lang('cruds.routing.fields.user')</th>
                        <th>@lang('cruds.routing.fields.route')</th>
                        <th>@lang('cruds.routing.fields.last_forwarded_to')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($routings) > 0)
                        @foreach ($routings as $routing)
                            <tr data-entry-id="{{ $routing->id }}">
                              
                            <td>

</td>
                                <td field-key='user'>{{ $routing->user->name ?? '' }}</td>
                                <td field-key='route'>{{ $routing->route?->name }}</td>
                                <td field-key='last_forwarded_to'>{{ $routing->last_forwarded_to }}</td>
                                                                <td>
                                   <!--  @can('user_access')
                                    <a href="{{ route('admin.routings.show',[$routing->id]) }}" class="btn btn-xs btn-primary">@lang('global.view')</a>
                                    @endcan -->
                                    @can('user_access')
                                    <a href="{{ route('admin.routings.edit',[$routing->id]) }}" class="btn btn-xs btn-info">@lang('global.edit')</a>
                                    @endcan
                                    @can('user_access')
                                    <form action="{{ route('admin.routings.destroy', $routing->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
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
  let table = $('.datatable-routings:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection