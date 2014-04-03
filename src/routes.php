<?php

Route::group(['prefix' => 'laraphrases'], function()
{
    $canEdit = Config::get('laraphrases::phrase.can_edit');
    Route::post('remote-update', ['before' => ['csrf', $canEdit()], 'uses' => 'LaraphraseController@postRemoteUpdate']);
});