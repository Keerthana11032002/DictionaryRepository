<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//new Route
Route::get('/app_list_api',[App\Http\Controllers\Api\ApiController::class,'App']);

Route::any('/category_list_by_app_id',[App\Http\Controllers\Api\ApiController::class,'Category']);

Route::post('/sub_category_list',[App\Http\Controllers\Api\ApiController::class,'SubCategory']);

Route::post('/dictionary_list_by_category_id',[App\Http\Controllers\Api\ApiController::class,'DictionaryCategoryList']);

Route::post('/dictionary_list_by_sub_category_id',[App\Http\Controllers\Api\ApiController::class,'DictionarySubCategoryList']);

Route::post('/dictionary_detail',[App\Http\Controllers\Api\ApiController::class,'Dictionary']);

Route::any('/dictionary_search',[App\Http\Controllers\Api\ApiController::class,'paginate']);

// Route::any('/common_search',[App\Http\Controllers\Api\ApiController::class,'search']);

// Route::any('/updated_questions',[App\Http\Controllers\Api\ApiController::class,'version']);


// Route::post('/add_app_list_api',[App\Http\Controllers\Api\ApiController::class,'store']);

// Route::get('/category_list_api',[App\Http\Controllers\Api\ApiCategoryController::class,'index']);

// Route::get('/sub_category_list_api',[App\Http\Controllers\Api\ApiSubCategoryController::class,'index']);

// Route::get('/question_list_api',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'store']);

// // Route::any('/Mapped_app_list_api/{id}',[App\Http\Controllers\Api\ApiMappedAppCategoryController::class,'index']);


// // Route::post('/sub_category_list',[App\Http\Controllers\Api\ApiSubCategoryController::class,'create']);

// // Route::post('/question_list_by_category_id',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'index']);

// Route::post('/question_list_by_sub_category_id',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'create']);

// Route::post('/question_detail',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'show']);


//method not allowed error

// Route::get('/question_list_by_sub_category_id',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'error']);

// Route::get('/question_list_by_category_id',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'error']);

// Route::get('/sub_category_list',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'error']);

// Route::get('/category_list_by_app_id',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'error']);

// Route::get('/question_detail',[App\Http\Controllers\Api\ApiQuestionCategoryController::class,'error']);
