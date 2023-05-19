<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
** First way to  seperate group by roles
*/
Route::middleware(['auth','verified'])
        ->prefix('student')
        ->name('student.')
        ->group(function(){
            Route::get('timetable', [\App\Http\Controllers\Student\TimetableController::class,'index'])
    ->name('timetable');

});



/*
** Second way by creating seperate file group inside group
*/

Route::middleware(['auth','verified'])->group(function(){
    Route::prefix('teacher')
            ->name('teacher.')
            ->group(function (){
                            Route::get('timetable', [\App\Http\Controllers\Teacher\TimetableController::class,'index'])
    ->name('timetable');
            });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});  



/*
** Third way by creating seperate file
*/
require __DIR__.'/auth.php';
// require __DIR__.'/teacher.php';


