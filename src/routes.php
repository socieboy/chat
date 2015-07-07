<?php

// Redirect to get the user session loaded.

get('auth/redirected/session', 'App\Http\Controllers\Auth\AuthController@loadUserSession');



Route::group(['prefix' => 'api/chat', 'namespace' => 'Socieboy\Chat\Controllers'], function ()
{

    // Get all online sessions with out the authenticated user session.
    get('/users/online', 'UsersController@online');

    // Return an user by the ID
    post('/users/get-user', 'UsersController@getUser');

    // get all messages for a conversation.
    post('/messages', 'MessagesController@index');

    // Store a new message on the database and broadcast to the addressee user.
    post('/messages/store', 'MessagesController@store');

});