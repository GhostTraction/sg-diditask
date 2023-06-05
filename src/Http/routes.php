<?php


Route::group([
    'namespace' => 'DiDiTask\Seat\SeatDiDiTask\Http\Controllers',
    'prefix' => 'diditask',
], function () {

    Route::group([
        'middleware' => ['web', 'auth'],
    ], function () {

        Route::get('/', [
            'as' => 'diditask.publishTask',
            'uses' => 'DiDiTaskController@publishTask',
            'middleware' => 'can:diditask.request',
        ]);

        Route::get('/acceptTask', [
            'as' => 'diditask.acceptTask',
            'uses' => 'DiDiTaskController@acceptTask',
            'middleware' => 'can:diditask.request',
        ]);

        Route::get('/acceptTask/{kill_id}/{action}', [
            'as' => 'diditask.changeStatus',
            'uses' => 'DiDiTaskController@changeStatus',
            'middleware' => 'can:diditask.request',
        ])->where(['action' => 'Success|Abandon|Delete']);

    });
});
