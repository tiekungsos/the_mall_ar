<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Message Data
    Route::post('message-datas/media', 'MessageDataApiController@storeMedia')->name('message-datas.storeMedia');
    Route::apiResource('message-datas', 'MessageDataApiController');

    // Ar Model
    Route::apiResource('ar-models', 'ArModelApiController');
});
