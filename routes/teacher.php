<?php
Route::middleware(['auth','verified'])
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function(){
            Route::get('timetable', [\App\Http\Controllers\Teacher\TimetableController::class,'index'])
    ->name('timetable');

});