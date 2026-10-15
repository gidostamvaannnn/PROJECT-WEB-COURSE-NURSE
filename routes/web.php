<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', [LandingController::class, 'index'])->name('landing');

// ==========================================
// AUTH ROUTES (Guest only)
// ==========================================
// Register flow (Publicly accessible)
Route::get('/register', [RegisterController::class, 'showEmailForm'])->name('register');
Route::post('/register', [RegisterController::class, 'sendOtp'])->name('register.send-otp');
Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('verify-otp');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify-otp.submit');
Route::post('/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend-otp');
Route::get('/create-password', [RegisterController::class, 'showPasswordForm'])->name('create-password');
Route::post('/create-password', [RegisterController::class, 'createPassword'])->name('create-password.submit');

// Login (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// PROFILE ROUTES (Auth only, no profile check)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ==========================================
// USER ROUTES (Auth + Profile Complete)
// ==========================================
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':user', \App\Http\Middleware\EnsureProfileComplete::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Videos
    Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
    Route::post('/videos/{video}/progress', [VideoController::class, 'updateProgress'])->name('videos.progress');

    // Questionnaires
    Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show'])->name('questionnaires.show');
    Route::post('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'submit'])->name('questionnaires.submit');
    Route::get('/questionnaire-results/{attempt}', [QuestionnaireController::class, 'result'])->name('questionnaires.result');

    // Schedule / Streak Calendar
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

    // Certificate
    Route::post('/certificate/generate', [CertificateController::class, 'generate'])->name('certificate.generate');
    Route::get('/certificate/{certificate}', [CertificateController::class, 'show'])->name('certificate.show');
});

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [Admin\UserController::class, 'show'])->name('users.show');
        Route::post('/users/{user}/verify', [Admin\UserController::class, 'verify'])->name('users.verify');
        Route::post('/users/{user}/reject', [Admin\UserController::class, 'reject'])->name('users.reject');
        Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

        // Courses
        Route::resource('/courses', Admin\CourseController::class)->except(['show']);

        // Videos (nested under courses)
        Route::get('/courses/{course}/videos', [Admin\VideoController::class, 'index'])->name('courses.videos.index');
        Route::get('/courses/{course}/videos/create', [Admin\VideoController::class, 'create'])->name('courses.videos.create');
        Route::post('/courses/{course}/videos', [Admin\VideoController::class, 'store'])->name('courses.videos.store');
        Route::get('/courses/{course}/videos/{video}/edit', [Admin\VideoController::class, 'edit'])->name('courses.videos.edit');
        Route::put('/courses/{course}/videos/{video}', [Admin\VideoController::class, 'update'])->name('courses.videos.update');
        Route::delete('/courses/{course}/videos/{video}', [Admin\VideoController::class, 'destroy'])->name('courses.videos.destroy');

        // Questionnaires (nested under courses)
        Route::get('/courses/{course}/questionnaires', [Admin\QuestionnaireController::class, 'index'])->name('courses.questionnaires.index');
        Route::get('/courses/{course}/questionnaires/create', [Admin\QuestionnaireController::class, 'create'])->name('courses.questionnaires.create');
        Route::post('/courses/{course}/questionnaires', [Admin\QuestionnaireController::class, 'store'])->name('courses.questionnaires.store');
        Route::get('/courses/{course}/questionnaires/{questionnaire}/edit', [Admin\QuestionnaireController::class, 'edit'])->name('courses.questionnaires.edit');
        Route::put('/courses/{course}/questionnaires/{questionnaire}', [Admin\QuestionnaireController::class, 'update'])->name('courses.questionnaires.update');
        Route::delete('/courses/{course}/questionnaires/{questionnaire}', [Admin\QuestionnaireController::class, 'destroy'])->name('courses.questionnaires.destroy');

        // Questions (nested under questionnaires)
        Route::get('/questionnaires/{questionnaire}/questions', [Admin\QuestionController::class, 'index'])->name('questionnaires.questions.index');
        Route::get('/questionnaires/{questionnaire}/questions/create', [Admin\QuestionController::class, 'create'])->name('questionnaires.questions.create');
        Route::post('/questionnaires/{questionnaire}/questions', [Admin\QuestionController::class, 'store'])->name('questionnaires.questions.store');
        Route::get('/questionnaires/{questionnaire}/questions/{question}/edit', [Admin\QuestionController::class, 'edit'])->name('questionnaires.questions.edit');
        Route::put('/questionnaires/{questionnaire}/questions/{question}', [Admin\QuestionController::class, 'update'])->name('questionnaires.questions.update');
        Route::delete('/questionnaires/{questionnaire}/questions/{question}', [Admin\QuestionController::class, 'destroy'])->name('questionnaires.questions.destroy');
    });
