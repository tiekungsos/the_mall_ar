<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMessageDataRequest;
use App\Http\Requests\StoreMessageDataRequest;
use App\Http\Requests\UpdateMessageDataRequest;
use App\Models\MessageData;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MessageDataController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('message_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $messageDatas = MessageData::all();

        return view('admin.messageDatas.index', compact('messageDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('message_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.messageDatas.create');
    }

    public function store(StoreMessageDataRequest $request)
    {
        $messageData = MessageData::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $messageData->id]);
        }

        return redirect()->route('admin.message-datas.index');
    }

    public function edit(MessageData $messageData)
    {
        abort_if(Gate::denies('message_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.messageDatas.edit', compact('messageData'));
    }

    public function update(UpdateMessageDataRequest $request, MessageData $messageData)
    {
        $messageData->update($request->all());

        return redirect()->route('admin.message-datas.index');
    }

    public function show(MessageData $messageData)
    {
        abort_if(Gate::denies('message_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.messageDatas.show', compact('messageData'));
    }

    public function destroy(MessageData $messageData)
    {
        abort_if(Gate::denies('message_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $messageData->delete();

        return back();
    }

    public function massDestroy(MassDestroyMessageDataRequest $request)
    {
        MessageData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('message_data_create') && Gate::denies('message_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MessageData();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
