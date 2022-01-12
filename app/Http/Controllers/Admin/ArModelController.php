<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArModelRequest;
use App\Http\Requests\StoreArModelRequest;
use App\Http\Requests\UpdateArModelRequest;
use App\Models\ArModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArModelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ar_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arModels = ArModel::all();

        return view('admin.arModels.index', compact('arModels'));
    }

    public function create()
    {
        abort_if(Gate::denies('ar_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.arModels.create');
    }

    public function store(StoreArModelRequest $request)
    {
        $arModel = ArModel::create($request->all());

        return redirect()->route('admin.ar-models.index');
    }

    public function edit(ArModel $arModel)
    {
        abort_if(Gate::denies('ar_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.arModels.edit', compact('arModel'));
    }

    public function update(UpdateArModelRequest $request, ArModel $arModel)
    {
        $arModel->update($request->all());

        return redirect()->route('admin.ar-models.index');
    }

    public function show(ArModel $arModel)
    {
        abort_if(Gate::denies('ar_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.arModels.show', compact('arModel'));
    }

    public function destroy(ArModel $arModel)
    {
        abort_if(Gate::denies('ar_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyArModelRequest $request)
    {
        ArModel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
