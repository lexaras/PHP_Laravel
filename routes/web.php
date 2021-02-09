<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {return view('welcome');})->name('welcome');   //index
Route::get('/about', function () {return view('about');})->name('about');  //about\
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('/projects', [ProjectController::class, 'store']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::post('/projects/{id}/comments', [ProjectController::class, 'storeProjectComment'])->name('projects.comments.store');
//Testavimui routai
// Route::get('/db', function () {var_dump(DB::connection()->getPdo());return view('welcome');})->name('testdb');
// use App\Models\Project;
// Route::get('/bp', function () {
//     $bp = new Project();
//     $bp->title = "Pr 3";
//     $bp->credit_count = 10;
//     $bp->text = "Pr 3 text ";
//     $bp->save();
//     return Project::where('title', 'Project 1')->latest()->first();
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/{any}', function(){ print("404 - No such route, buddy!"); })->where('any', '.*'); //wrong route
