<?php
Route::group(['middleware' => ['web']], function () {
    Route::get("uploader", "Hosein\Uploader\Controllers\UploaderController@index");
    Route::get("uploader/delete/{id}", "Hosein\Uploader\Controllers\UploaderController@deleteFile");
    Route::post("uploader/upload", "Hosein\Uploader\Controllers\UploaderController@upload");
});
