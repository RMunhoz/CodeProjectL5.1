<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * Ao testar no postman utilizar Headers
 */
Route::post('oauth/access_token', function(){
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('/', function(){
   return view('app');
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('client', 'ClientController', ['except'=>['create', 'edit']]);
    Route::resource('project', 'ProjectController', ['except'=>['create', 'edit']]);

    Route::group(['prefix'=>'project'], function(){

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');

        Route::get('{id}/task', 'ProjectTasksController@index');
        Route::post('{id}/task', 'ProjectTasksController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTasksController@show');
        Route::put('{id}/task/{taskId}', 'ProjectTasksController@update');
        Route::delete('{id}/task/{taskId}', 'ProjectTasksController@destroy');

        Route::get('{id}/members', 'ProjectController@showMembers');

        Route::get('{id}/file', 'ProjectFileController@index');
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');

    });

});




