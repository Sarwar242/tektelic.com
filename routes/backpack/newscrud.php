<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'admin'],
], function () {
    Route::crud('article', 'ArticleCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('blogcategory', 'BlogCategoryCrudController');/*#SID - 44-new-website-page-knowledge */
    Route::crud('blogs', 'BlogCrudController');/*#SID - 44-new-website-page-knowledge */
    Route::crud('tag', 'TagCrudController');
    Route::crud('testimonials', 'TestimonialCrudController');
    Route::crud('career', 'CareerCrudController');
});
