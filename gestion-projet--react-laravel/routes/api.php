<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TachesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Taches routes with auth:sanctum middleware
// We ensure that all these routes require authentication via Laravel Sanctum
// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('taches', TachesController::class)->except([
//         'create', 'edit'
//     ]);
// });


// GET /taches for listing all taches (index method).
// POST /taches for creating a new tache (store method).
// GET /taches/{tache} for showing a specific tache (show method).
// PUT/PATCH /taches/{tache} for updating a specific tache (update method).
// DELETE /taches/{tache} for deleting a specific tache (destroy method).

Route::resource('taches', TachesController::class)->except([
    'create', 'edit'
]);
