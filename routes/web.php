<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReputationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HiddenPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

//strona główna
Route::get('/', function () {
    return view('welcome');
})->name('home');

//rejestracja
Route::get('/rejestracja', [RegistrationController::class, 'showForm'])->name('registration.form');
Route::post('/rejestracja', [RegistrationController::class, 'register'])->name('registration.submit');

//logowanie
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', function () {
    Auth::logout(); // Wylogowanie użytkownika
    return redirect('/'); // Przekierowanie na stronę główną
})->name('logout');

//po zalogowaniu jako admin
Route::get('/admin/choice', [AdminController::class, 'choice'])->name('admin.choice');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/forum', function () {
    return view('forum');
})->name('forum');

//narzędzia admina
Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users');
Route::post('/admin/users/{user}/make-admin', [UserManagementController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
Route::post('/admin/users/{user}/ban', [UserManagementController::class, 'banUser'])->name('admin.users.ban');
Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
Route::post('/admin/threads/{thread}/close', [AdminController::class, 'closeThread'])->name('admin.threads.close');
Route::get('/admin/posts-threads', [AdminController::class, 'managePostsAndThreads'])->name('admin.posts_threads');
Route::delete('/admin/threads/{thread}', [AdminController::class, 'deleteThread'])->name('admin.threads.delete');


//forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/threads/{thread}', [ForumController::class, 'showThread'])->name('forum.threads.show');
Route::post('/forum/threads', [ForumController::class, 'createThread'])->name('forum.threads.create');
Route::post('/forum/threads/{thread}/posts', [ForumController::class, 'createPost'])->name('forum.posts.create');
Route::post('/threads/{thread}/close', [ForumController::class, 'closeThread'])->name('threads.close');
Route::post('/posts/{post}/vote', [ReputationController::class, 'vote'])->name('posts.vote');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
Route::get('/news', [NewsController::class, 'index'])->name('news');
//profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/users/{nick}', [ProfileController::class, 'show'])->name('users.profile');

//obserwowanie i ukrywanie
Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');
Route::post('/users/{user}/hide', [HiddenPostController::class, 'hide'])->name('users.hide');
Route::post('/users/{user}/unhide', [HiddenPostController::class, 'unhide'])->name('users.unhide');

