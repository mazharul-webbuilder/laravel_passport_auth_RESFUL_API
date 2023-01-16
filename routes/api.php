<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function (){
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    //category
   Route::get('categories', [MainController::class, 'categories']);
   Route::post('category/store', [MainController::class, 'categoryStore']);
   Route::get('category/{category_id}', [MainController::class, 'categoryShow']);
   Route::put('category/{category_id}/update', [MainController::class, 'categoryUpdate']);
   Route::delete('category/{category_id}/delete', [MainController::class, 'categoryDelete']);

   //sub category
   Route::get('sub-categories', [MainController::class, 'subCategories']);
   Route::post('sub-category/store', [MainController::class, 'subCategoryStore']);
   Route::get('sub-category/{subcategory_id}', [MainController::class, 'subCategoryShow']);
   Route::put('sub-category/{subcategory_id}/update', [MainController::class, 'subCategoryUpdate']);
   Route::delete('sub-category/{subcategory_id}/delete', [MainController::class, 'subCategoryDelete']);
});
