<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('Login');
});

// Dashboard
Route::get('/Admin.Dashboard', [DashboardController::class, 'showPieChart'])->name('pieChart');

//Signup, login users
Route::post('/createUser',[UserController::class,'createUser'])->name('createUser');
Route::post('/loginUser',[UserController::class,'loginUser'])->name('loginUser');
Route::post('/logoutUser',[UserController::class,'logoutUser'])->name('logoutUser');

//Adding roles
Route::get('/Admin.Role',[RoleController::class,'getRoles'])->name('getRoles');
Route::post('/addRole',[RoleController::class,'addRole'])->name('addRole');
Route::get('/editRole/{id}',[RoleController::class,'editRole'])->name('editRole');
Route::put('/updateRole/{id}',[RoleController::class,'updateRole'])->name('updateRole');
Route::delete('/deleteRole/{id}',[RoleController::class,'deleteRole'])->name('deleteRole');

//users crud
Route::get('/Admin.User',[UserController::class,'getUser'])->name('getUser');
Route::post('/addUser',[UserController::class,'addUser'])->name('addUser');
Route::get('/editUser/{id}',[UserController::class,'editUser'])->name('editUser');
Route::put('/updateUser/{id}',[UserController::class,'updateUser'])->name('updateUser');
Route::delete('/deleteUser/{id}',[UserController::class,'deleteUser'])->name('deleteUser');

//Adding categories
Route::get('/Admin.Category',[CategoryController::class,'getCategory'])->name('getCategory');
Route::post('/addCategory',[CategoryController::class,'addCategory'])->name('addCategory');
Route::get('/editCategory/{id}',[CategoryController::class,'editCategory'])->name('editCategory');
Route::put('/updateCategory/{id}',[CategoryController::class,'updateCategory'])->name('updateCategory');
Route::delete('/deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('deleteCategory');

//expenses
Route::get('/User.Expense',[ExpenseController::class,'getExpense'])->name('getExpense');
Route::post('/addExpense',[ExpenseController::class,'addExpense'])->name('addExpense');
Route::get('/editExpense/{id}',[ExpenseController::class,'editExpense'])->name('editExpense');
Route::put('/updateExpense/{id}',[ExpenseController::class,'updateExpense'])->name('updateExpense');
Route::delete('/deleteExpense/{id}',[ExpenseController::class,'deleteExpense'])->name('deleteExpense');