@extends('layouts.admin')
@section('content')
@can('ar_model_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ar-models.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.arModel.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.arModel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ArModel">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.arModel.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.arModel.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.arModel.fields.code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arModels as $key => $arModel)
                        <tr data-entry-id="{{ $arModel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $arModel->id ?? '' }}
                            </td>
                            <td>
                                {{ $arModel->name ?? '' }}
                            </td>
                            <td>
                                {{ $arModel->code ?? '' }}
                            </td>
                            <td>
                                @can('ar_model_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ar-models.show', $arModel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ar_model_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ar-models.edit', $arModel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ar_model_delete')
                                    <form action="{{ route('admin.ar-models.destroy', $arModel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ar_model_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ar-models.massDestroy') }}",
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
  let table = $('.datatable-ArModel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection