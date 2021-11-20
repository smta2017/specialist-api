<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('order', 'OrderCrudController');
    Route::crud('order-state', 'OrderStateCrudController');
    Route::crud('special-type', 'SpecialTypeCrudController');
    Route::crud('customer-address', 'CustomerAddressCrudController');
    Route::crud('area', 'AreaCrudController');
    Route::crud('user-type', 'UserTypeCrudController');
    Route::crud('city', 'CityCrudController');
    Route::crud('order-comment', 'OrderCommentCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('plan', 'PlanCrudController');
    Route::crud('subscription', 'SubscriptionCrudController');
    Route::crud('slider', 'SliderCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('review', 'ReviewCrudController');
    Route::crud('specialist-area', 'SpecialistAreaCrudController');
    Route::crud('slider-image', 'SliderImageCrudController');
}); // this should be the absolute last line of this file