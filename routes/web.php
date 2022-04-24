<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomController;
use App\Models\Field;
use App\Models\Job;
use App\Models\Degree;
use App\Models\Region;
use App\Models\Department;
use App\Models\Target;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/securedfileview', [FileController::class, 'view']);

Route::get('/copy/{id}/{client}', [CustomController::class, 'copy']);

Route::post('/create', [CustomController::class, 'create']);

Route::get('/public/application', function (Request $request) {
    return view('application', [
        "ref" => $request->query('ref'),
        "fields" => Field::all(), 
        "jobs" => Job::all(), 
        "degrees" => Degree::all(), 
        "regions" => Region::all(), 
        "departments" => Department::all(),
        "targets" => Target::all()
    ]);
});