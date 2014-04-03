<?php

Route::group(['prefix' => 'laraphrases'], function()
{
    Route::post('remote-update', ['before' => 'csrf', 'uses' => 'LaraphraseController@postRemoteUpdate']);
});