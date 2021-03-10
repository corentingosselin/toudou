<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Share\ShareController;
use App\Http\Controllers\Task\TaskController;

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




// check if user is auth
Route::middleware(['auth'])->group(function () {

    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects');

    Route::post('/projects', [ProjectController::class, 'store'])
        ->name('projects');

    Route::delete('/projects/delete/{id}', [ProjectController::class, 'delete'])
        ->name('projects.delete');

    Route::put('/projects', [ProjectController::class, 'share'])
        ->name('projects');

    Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete'])
        ->name('tasks.delete');

    Route::post('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::put('/tasks/update/{id}', [TaskController::class, 'update'])
        ->name('tasks.update');



    Route::get('/project/{id}', [ProjectController::class, 'show'])
        ->name('project');

    Route::get('/share/{id}', [ShareController::class, 'index'])
        ->name('share');
    Route::post('/share', [ShareController::class, 'share'])
        ->name('share.create');
    Route::delete('/share/delete/{i}', [ShareController::class, 'delete'])
        ->name('share.delete');
    Route::put('/share/update/{i}', [ShareController::class, 'update'])
        ->name('share.update');

    Route::get('autocomplete', [ShareController::class, 'autocomplete'])
        ->name('autocomplete');
});


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

require __DIR__ . '/auth.php';
