<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ProjectCategoryController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('blogs', BlogController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('blog-comments', BlogCommentController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('experiences', ExperienceController::class);
        Route::resource('qualifications', QualificationController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('project-categories', ProjectCategoryController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('tools', ToolController::class);
        Route::resource('social-links', SocialLinkController::class);
        Route::resource('messages', MessageController::class);
        Route::resource('users', UserController::class);
    });
