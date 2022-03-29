<?php

use Illuminate\Support\Facades\Route;

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
    Route::crud('degree', 'DegreeCrudController');
    Route::crud('application', 'ApplicationCrudController');
    Route::crud('state', 'StateCrudController');
    Route::crud('region', 'RegionCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('field', 'FieldCrudController');
    Route::crud('job', 'JobCrudController');
}); // this should be the absolute last line of this file