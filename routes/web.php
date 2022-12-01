<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SiteController;
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
Route::get('/dictionary/{slug?}', [App\Http\Controllers\WebController::class, 'dictionaries']);
Route::post('/letters', [App\Http\Controllers\WebController::class, 'letters']);
Route::post('/dictionary_words', [App\Http\Controllers\WebController::class, 'words']);
Route::get('/dictionary/{from?}/{main?}', [App\Http\Controllers\WebController::class, 'wordlist']);

Route::get('/language_site/{from?}', [App\Http\Controllers\SiteController::class, 'category']);
Route::get('/search_site/{from?}', [App\Http\Controllers\SiteController::class, 'dictionary']);
Route::get('/letter_site/{from?}', [App\Http\Controllers\SiteController::class, 'letter']);
Route::get('/word_site/{from?}', [App\Http\Controllers\SiteController::class, 'word']);

Route::get('/sitemap', [App\Http\Controllers\SiteController::class, 'map']);

Route::get('/english', function () {
    return view('website.english_dictionary');
});

Route::get('/api', function () {
    return view('admin.api.api_route_list');
});

Route::get('auth/login', function () {
    return view('auth.login');
});

// Route::get('/add_app', function () {return view('add_app');});

// Route::get('/add_category', function () {return view('add_category');});

// 

// Route::get('/important', [App\Http\Controllers\QuestionController::class,'important']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('/app_list',[AppController::class,'show']);

// Route::post('/insert', [App\Http\Controllers\AppController::class,'store']);

// Route::any('/mapped_app/{id}',[App\Http\Controllers\AppController::class,'edit']);



// //category_list

// Route::get('/category_list',[App\Http\Controllers\CategoryController::class,'show']);

// Route::post('/category.insert', [App\Http\Controllers\CategoryController::class,'store']);

// Route::get('/sub_category_list',[App\Http\Controllers\SubCategoryController::class,'show']);

// Route::get('/add_sub_category',[App\Http\Controllers\SubCategoryController::class,'add']);

// Route::post('/insert_sub_category', [App\Http\Controllers\SubCategoryController::class,'store']);

// Route::get('/questions_list',[App\Http\Controllers\QuestionController::class,'show']);

// Route::get('/add_question',[App\Http\Controllers\QuestionController::class,'add']);

// Route::post('/subcat', [App\Http\Controllers\SubCategoryController::class, 'subCat']);


// // Route::post('/EditsubCat', [App\Http\Controllers\SubCategoryController::class, 'EditsubCat']);


// Route::post('/insert_question', [App\Http\Controllers\QuestionController::class,'store']);

// Route::post('/app_status_update', [App\Http\Controllers\AppController::class, 'active']);

// Route::post('/category_status_update', [App\Http\Controllers\CategoryController::class, 'active']);

// Route::post('/sub_category_status_update', [App\Http\Controllers\SubCategoryController::class, 'active']);

// //DELETE

// Route::post('/delete_app/{id}',[App\Http\Controllers\AppController::class,'delete']);

// Route::post('/delete_category/{id}',[App\Http\Controllers\CategoryController::class,'delete']);

// Route::post('/delete_sub_category/{id}',[App\Http\Controllers\SubCategoryController::class,'delete']);

// Route::post('/delete_question/{id}',[App\Http\Controllers\QuestionController::class,'delete']);


// //edit
// Route::any('/edit_app/{id}',[App\Http\Controllers\AppController::class,'EditApp']);

// Route::any('/edit_category/{id}',[App\Http\Controllers\CategoryController::class,'EditCategory']);

// Route::any('/edit_sub_category/{id}',[App\Http\Controllers\SubCategoryController::class,'EditSubCategory']);

// Route::any('/edit_question/{id}',[App\Http\Controllers\QuestionController::class,'EditQuestion']);


// //edit_blade
// Route::any('/edit_app_list/{id}',[App\Http\Controllers\AppController::class,'EditAppList']);

// Route::post('/edit_category_list/{id}',[App\Http\Controllers\CategoryController::class,'EditCatList']);

// Route::post('/edit_sub_category_list/{id}',[App\Http\Controllers\SubCategoryController::class,'EditSubCatList']);

// Route::post('/edit_questions_list/{id}',[App\Http\Controllers\QuestionController::class,'EditQuestionList']);

// //ckeditor
// Route::post('ckeditor/image_upload', [App\Http\Controllers\QuestionController::class, 'upload'])->name('upload');

// Route::view('/auth/passwoed','auth.passwords.email')->name('password.request');
// // Managed URL 
// Route::get('/edit_app',[AppController::class,'show']);

Route::get('add-to-log', 'App\Http\Controllers\HomeController@myTestAddToLog');


Route::group(['prefix' => 'admin'], function() 
{
	Route::group(['middleware' => 'admin.guest'], function()
    {
		Route::view('/login','admin.login')->name('admin.login');
		Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
	});
	
	Route::group(['middleware' => 'admin.auth'], function()
    {
		// Route::get('/app_list',[AppController::class,'show'])->name('admin.dashboard');

        Route::get('/dashboard', [App\Http\Controllers\AdminController::class,'dashboard'])->name('admin/dashboard');
        
        Route::get('/admin_add_app', [App\Http\Controllers\AppController::class,'Add_list']);

        Route::get('/app_list',[AppController::class,'show'])->name('admin.dashboard');

        Route::post('/insert', [App\Http\Controllers\AppController::class,'store'])->name('admin.insert');

        Route::any('/edit_app/{id}',[App\Http\Controllers\AppController::class,'EditApp'])->name('admin.edit');

        Route::post('/delete_app/{id}',[App\Http\Controllers\AppController::class,'delete'])->name('admin.delete');

        Route::any('/edit_app_list/{id}',[App\Http\Controllers\AppController::class,'EditAppList'])->name('admin.update');

        Route::any('/mapped_app/{id}',[App\Http\Controllers\AppController::class,'edit'])->name('admin.mapping');

        Route::post('/update_map_cat/{id}',[App\Http\Controllers\MappedApp::class,'insert'])->name('admin.mapping_cat');

        Route::post('/app_status_update', [App\Http\Controllers\AppController::class, 'active'])->name('admin.app.status');

        Route::get('/category_list',[App\Http\Controllers\CategoryController::class,'show'])->name('category.list');

        Route::get('/add_option',[App\Http\Controllers\CategoryController::class,'showlist']);

        Route::get('/add_category', [App\Http\Controllers\CategoryController::class,'Add_list']);

        Route::get('/add_option', [App\Http\Controllers\CategoryController::class,'Add_option']);

        Route::post('/category.insert', [App\Http\Controllers\CategoryController::class,'store']);

        Route::post('/option.insert', [App\Http\Controllers\CategoryController::class,'option']);

        Route::post('/edit_category_list/{id}',[App\Http\Controllers\CategoryController::class,'EditCatList']);

        Route::any('/edit_category/{id}',[App\Http\Controllers\CategoryController::class,'EditCategory']);

        Route::post('/delete_category/{id}',[App\Http\Controllers\CategoryController::class,'delete']);

        Route::post('/category_status_update', [App\Http\Controllers\CategoryController::class, 'active']);

        Route::get('/file-export/{category_id}', [App\Http\Controllers\CategoryController::class, 'fileExport'])->name('file-export');

        //profile update
        Route::get('/profile_update', function () {return view('admin.accounts.profile_update');});
        
        Route::any('/home','App\Http\Controllers\AdminController@profileUpdate')->name('profileupdate');

        Route::post('/uploadFile', 'App\Http\Controllers\CategoryController@uploadFile');


        //subcategory

        // Route::post('/edit_sub_category_list/{id}',[App\Http\Controllers\SubCategoryController::class,'EditSubCatList']);

        // Route::post('/insert_sub_category', [App\Http\Controllers\SubCategoryController::class,'store']);

        // Route::any('/edit_sub_category/{id}',[App\Http\Controllers\SubCategoryController::class,'EditSubCategory']);

        // Route::post('/delete_sub_category/{id}',[App\Http\Controllers\SubCategoryController::class,'delete']);

        // Route::post('/sub_category_status_update', [App\Http\Controllers\SubCategoryController::class, 'active']);

        // Route::get('/add_sub_category',[App\Http\Controllers\SubCategoryController::class,'add']);

        // Route::get('/sub_category_list',[App\Http\Controllers\SubCategoryController::class,'show'])->name('admin.subcat');

        // Route::post('/subcat', [App\Http\Controllers\SubCategoryController::class, 'subCat']);

        //question

        Route::post('/image_upload', [App\Http\Controllers\QuestionController::class, 'upload'])->name('upload');

        Route::post('/edit_questions_list/{id}',[App\Http\Controllers\QuestionController::class,'EditQuestionList']);

        Route::any('/edit_question/{id}',[App\Http\Controllers\QuestionController::class,'EditQuestion']);

        Route::post('/delete_question/{id}',[App\Http\Controllers\QuestionController::class,'delete']);

        Route::post('/insert_question', [App\Http\Controllers\QuestionController::class,'store']);

        Route::get('/questions_list',[App\Http\Controllers\QuestionController::class,'show'])->name('admin.question');

        Route::get('/add_question',[App\Http\Controllers\QuestionController::class,'add']);

        Route::post('/question_status_update', [App\Http\Controllers\QuestionController::class, 'active']);

        //Accounts list
        
        Route::get('/superadmin',[App\Http\Controllers\AdminController::class,'superadmin'])->name('superadmin');
        
        Route::get('/admin_add_sub_admin',[App\Http\Controllers\AdminController::class,'add']);

        Route::post('/admin_insert',[App\Http\Controllers\AdminController::class,'insert']);

        Route::any('/edit_admin/{id}',[App\Http\Controllers\AdminController::class,'edit']);

        Route::any('/edit_admin_list/{id}',[App\Http\Controllers\AdminController::class,'editlist']);

        Route::post('/user_status_update', [App\Http\Controllers\AdminController::class, 'active']);

        Route::post('/delete_admin/{id}',[App\Http\Controllers\AdminController::class,'delete']);

        Route::get('/logActivity', 'App\Http\Controllers\HomeController@logActivity');

        Route::post('/activitydelete',[App\Http\Controllers\AdminController::class,'activitydelete']);

        route::post('/manage/{id}',[App\Http\Controllers\AdminController::class,'manage']);

        // Dictonary
        
        Route::post('/edit_dictionary_list/{id}',[App\Http\Controllers\DictionaryController::class,'EditQuestionList']);

        Route::any('/edit_dictionary/{id}',[App\Http\Controllers\DictionaryController::class,'EditQuestion']);

        Route::post('/delete_dictionary/{id}',[App\Http\Controllers\DictionaryController::class,'delete']);

        Route::post('/insert_dictionary', [App\Http\Controllers\DictionaryController::class,'store']);

        Route::get('/dictionary',[App\Http\Controllers\DictionaryController::class,'show']);

        Route::get('/add_dictionary',[App\Http\Controllers\DictionaryController::class,'add']);

        Route::post('/dictionary_status_update', [App\Http\Controllers\DictionaryController::class, 'active']);
	}
    );

    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
});