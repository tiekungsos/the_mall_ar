<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArModelRequest;
use App\Http\Requests\UpdateArModelRequest;
use App\Http\Resources\Admin\ArModelResource;
use App\Models\ArModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArModelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ar_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArModelResource(ArModel::all());
    }

    public function store(StoreArModelRequest $request)
    {
        $arModel = ArModel::create($request->all());

        return (new ArModelResource($arModel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArModel $arModel)
    {
        abort_if(Gate::denies('ar_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArModelResource($arModel);
    }

    public function update(UpdateArModelRequest $request, ArModel $arModel)
    {
        $arModel->update($request->all());

        return (new ArModelResource($arModel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArModel $arModel)
    {
        abort_if(Gate::denies('ar_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arModel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
