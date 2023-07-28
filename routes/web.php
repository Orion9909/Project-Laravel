<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
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
    // return view('welcome');
    //fetch all users
    $users =  DB::select("SELECT * FROM users");
    
    // create new user
    // $user = DB::insert("INSERT INTO users (name, email, password) VALUES (?,?,?)",
    //     [
    //         'Aki',
    //         'shupaoshu0@gmail.com',
    //         'password',
    //     ]    
    // );

    // update user
    // $user = DB::update("UPDATE users SET email=? WHERE id=?",
    //     [
    //         'askdjfie34@gmail.com',
    //         2,
    //     ]
    // );

    // delete user
    // $user = DB::delete("DELETE FROM users WHERE id=?", [2]);
    dd($users);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
