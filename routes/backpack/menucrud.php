<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'admin'],
], function () {
    Route::crud('menu-item', 'MenuItemCrudController');

});
