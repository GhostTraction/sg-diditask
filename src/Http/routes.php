<?php


Route::group([
    'namespace' => 'DiDiTask\Seat\SeatDiDiTask\Http\Controllers',
    'prefix' => 'diditask',
], function () {

    Route::group([
        'middleware' => ['web', 'auth'],
    ], function () {

        Route::get('/', [
            'as' => 'diditask.minelist',
            'uses' => 'DiDiTaskController@getMineDkp',
            'middleware' => 'can:diditask.request',
        ]);

        Route::get('/commodity', [
            'as' => 'diditask.commodity',
            'uses' => 'DiDiTaskController@commodity',
            'middleware' => 'can:diditask.request',
        ]);
    });
});
