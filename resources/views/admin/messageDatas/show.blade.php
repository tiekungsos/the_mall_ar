@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.messageData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.message-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.messageData.fields.id') }}
                        </th>
                        <td>
                            {{ $messageData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.messageData.fields.from') }}
                        </th>
                        <td>
                            {{ $messageData->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.messageData.fields.to') }}
                        </th>
                        <td>
                            {{ $messageData->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.messageData.fields.message') }}
                        </th>
                        <td>
                            {!! $messageData->message !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.messageData.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $messageData->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.message-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection