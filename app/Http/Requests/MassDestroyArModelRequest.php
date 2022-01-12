<?php

namespace App\Http\Requests;

use App\Models\ArModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArModelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ar_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ar_models,id',
        ];
    }
}
