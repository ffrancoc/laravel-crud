<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CrudController::class, "index"])->name("crud.index");
Route::post('/create-producto', [CrudController::class, "create"])->name("crud.create");
Route::post('/update-producto', [CrudController::class, "update"])->name("crud.update");
Route::get('/delete-producto-{id}', [CrudController::class, "delete"])->name("crud.delete");