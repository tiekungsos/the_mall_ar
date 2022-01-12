<?php

namespace App\Http\Requests;

use App\Models\ArModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateArModelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ar_model_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'code' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
