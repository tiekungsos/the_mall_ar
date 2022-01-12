<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMessageDataRequest;
use App\Http\Requests\UpdateMessageDataRequest;
use App\Http\Resources\Admin\MessageDataResource;
use App\Models\MessageData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageDataApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('message_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageDataResource(MessageData::with(['model'])->get());
    }

    public function store(StoreMessageDataRequest $request)
    {
        $messageData = MessageData::create($request->all());

        return (new MessageDataResource($messageData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MessageData $messageData)
    {
        abort_if(Gate::denies('message_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageDataResource($messageData->load(['model']));
    }

    public function update(UpdateMessageDataRequest $request, MessageData $messageData)
    {
        $messageData->update($request->all());

        return (new MessageDataResource($messageData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MessageData $messageData)
    {
        abort_if(Gate::denies('message_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $messageData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
