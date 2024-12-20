<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IssueController;

Route::get('/', [IssueController::class, 'index'])->name('issues.index');
Route::resource('issues', IssueController::class)->except(['index']);
