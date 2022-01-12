<?php

namespace App\Http\Requests;

use App\Models\MessageData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMessageDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('message_data_create');
    }

    public function rules()
    {
        return [
            'from' => [
                'string',
                'nullable',
            ],
            'to' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
