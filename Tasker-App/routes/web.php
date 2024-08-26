<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Tasks
Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::get('/createTask', [TaskController::class, 'create'])->name('task.create');
Route::post('/storeTasks', [TaskController::class, 'store'])->name('task.store');
Route::patch('/task/{id}/update', [TaskController::class, 'update'])->name('task.update');
Route::get('/task/{id}/show', [TaskController::class, 'show'])->name('task.show');
Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::delete('/deleteTask/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

//RegisterController
Route::get('/register', [RegisterController::class, 'register'])->name('Auth.register');
Route::post('/registerUser', [RegisterController::class, 'RegisterUser'])->name('Auth.registerUser');

//LogoutController
Route::post('/logout', [LogoutController::class, 'destroy'])->name('Auth.logout');

//loginController
Route::get('/login', [LoginController::class, 'loginForm'])->name('Auth.login');
Route::post('/loginUser', [LoginController::class, 'login'])->name('Auth.loginUser');

//ProjectController
Route::get('/project', [ProjectController::class, 'create'])->name('project.create');
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
Route::post('/project', [ProjectController::class, 'store'])->middleware('auth')->name('project.store');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
Route::get('project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::patch('project/{id}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

//tagController
Route::post('/tag', [tagController::class, 'store'])->name('tag.store');
Route::post('/tag/{id}/edit', [tagController::class, 'edit'])->name('tag.edit');
Route::patch('/task/{id}', [tagController::class, 'update'])->name('tag.update');
Route::delete('/task/{id}', [tagController::class, 'destroy'])->name('tag.destroy');


//notificationcontroller
Route::get('/notifications', [NotificationsController::class, 'index'])->name('notification.index');
Route::post('/notifications/{id}', [NotificationsController::class, 'markAsRead'])->name('notification.markasread');
Route::post('/notifications/markallasread', [NotificationsController::class, 'markAllAsRead'])->name('notification.markallasread');
Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy'])->name('notification.destroy');

//LandingController
Route::get('/landing', [LandingPageController::class, 'create'])->name('Landing.create');

//commentsController
Route::get('/comments', [CommentsController::class,  'index'])->name('comments.index');
Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::delete('/comment/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');

//categoriesController
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::patch('/categories/{category}/edit', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.delete');


//attachmentsController
Route::post('/attachment', [AttachmentsController::class, 'store'])->name('attchment.store');
Route::delete('/attachment/{attachment}', [AttachmentsController::class, 'destroy'])->name('attachment.delete');
Route::get('/attachments/{attachment}/download', [AttachmentsController::class, 'download'])->name('attachment.download');


require __DIR__ . '/auth.php';
