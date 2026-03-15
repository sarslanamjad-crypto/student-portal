<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// Simple API endpoints demonstrating Web APIs, platform APIs, and SQL-injection concepts.
// These are lightweight and intentionally minimal. Throttle added to show a platform constraint.
Route::prefix('api')->middleware(['api', 'throttle:60,1'])->group(function () {
    Route::get('/students', [\App\Http\Controllers\Api\StudentApiController::class, 'index']);
    Route::get('/students/{student}', [\App\Http\Controllers\Api\StudentApiController::class, 'show']);
    Route::get('/students/search', [\App\Http\Controllers\Api\StudentApiController::class, 'search']);
    // Vulnerable demo route: register only in local environment for safe demonstration.
    if (app()->environment('local')) {
        Route::get('/students/search-vuln', [\App\Http\Controllers\Api\StudentApiController::class, 'searchVulnerable']);
    }
    Route::get('/students/export/csv', [\App\Http\Controllers\Api\StudentApiController::class, 'exportCsv']);
});

Route::resource('courses', CourseController::class);

Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::post('/courses/{course}/drop', [CourseController::class, 'drop'])->name('courses.drop');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('dashboard');
});
