<?php

namespace App\Http\Requests;

use App\Models\MessageData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMessageDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('message_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:message_datas,id',
        ];
    }
}
