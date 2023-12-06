<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ChangeUserController;

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

// LOG IN , REGISTER
Route::middleware([ 'admin_auth' ])->group( function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
} );

// Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {
        // CATEGORY LIST PAGE
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('products/list' , [ ProductsController::class , 'productsList' ])->name('products#list');
            // CRUD START
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('category#update');
        });

        // ADMIN ACCOUNT
        Route::prefix('admin')->group(function () {
            // password
            Route::get('change/passwordPage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            // ACCOUNT PROFILE AND INFO
            Route::get('account/details' , [ AdminController::class , 'details' ])->name('admin#details');
            Route::get('edit' , [ AdminController::class , 'edit' ])->name('admin#edit');
            Route::post('update/{id}' , [ AdminController::class , 'update' ])->name('admin#update');

            // ADMIN LIST
            Route::get('list' , [ AdminController::class , 'list' ])->name('admin#list');
            Route::get('delete/{id}' , [ AdminController::class , 'delete' ])->name('admin#delete');

            // Change ROLE PAGE
            Route::get('change/role/{id}' , [AdminController::class , 'changeRole'])->name('admin#changeRole');

            // CHANGE ROLE
            Route::post('change/{id}' , [AdminController::class , 'change'])->name('admin#change');

            // AJAX CHANGE ROLE STATUS
            Route::get('ajax/change/status' , [AdminController::class , 'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');

            // USER LIST DELETE
            Route::get('userList/delete/{id}' , [AdminController::class , 'userListDelete'])->name('admin#userListDelete');

            // USER LIST EDIT
            Route::get('userList/edit/page/{id}' , [AdminController::class , 'userListEdit'])->name('admin#userListEdit');

            // USER LIST UPDATE
            Route::post('userList/update/{id}' , [AdminController::class , 'updateUserList'])->name('admin#userListUpdate');

            // CONTACT INFO BY USING FORM POST SUBMIT
            Route::get('contact/list/page' , [ContactController::class , 'contactListPage'])->name('admin#contactListPage');
            Route::get('contact/edit/page/{id}' , [ContactController::class , 'contactEditPage'])->name('admin#contactEditPage');
            Route::get('contact/delete/{id}' , [ContactController::class , 'contactDelete'])->name('admin#contactDelete');

            // Route::post('list' , [ContactController::class , 'list'])->name('user#contactList');
        });

        // PRODUCTS LIST PAGE
        Route::prefix('products')->group( function () {
            Route::get('list' , [ ProductController::class , 'list' ])->name('products#list');
            Route::get('create' , [ ProductController::class , 'createPage' ])->name('products#createPage');
            Route::post('create' , [ ProductController::class , 'create' ])->name('products#create');
            Route::get('delete/{id}' , [ ProductController::class , 'delete' ])->name('products#delete');
            Route::get('edit/{id}' , [ ProductController::class , 'edit' ])->name('products#edit');
            Route::get('update/{id}' , [ ProductController::class , 'updatePage' ])->name('products#updatePage');
            Route::post('update' , [ ProductController::class , 'update' ])->name('products#update');
        });

        // ORDER LIST PAGE
        Route::prefix('order')->group( function () {
            Route::get('list' , [ OrderController::class , 'list' ])->name('order#list');
            Route::get('change/list' , [ OrderController::class , 'changeStatus' ])->name('order#changeList');
            Route::get('ajax/change/status' , [OrderController::class , 'ajaxChangeStatus'])->name('order#changeStatus');
            Route::get('listInfo/{orderCode}' , [OrderController::class , 'listInfo'])->name('order#listInfo');
        });

        // CHANGE USER ACCOUNT TO ADMIN
        Route::prefix('user')->group( function () {
            Route::get('list' , [ ChangeUserController::class , 'userList' ])->name('user#list');
            Route::get('change/status' , [ChangeUserController::class , 'changeStatus'])->name('user#changeStatus');
        });
    });

    // USER
    // HOME PAGE
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('/homePage' , [UserController::class , 'home'])->name('user#home');
        Route::get('filter/{id}' ,[UserController::class , 'filter'])->name('user#filter');
        Route::get('history' ,[UserController::class , 'history'])->name('user#history');
        Route::get('order/page' , [ UserController::class , 'orderPage' ])->name('user#orderPage');

        // PASSWORD
        Route::prefix('password')->group( function () {
            Route::get('change' , [UserController::class , 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change' , [UserController::class , 'changePassword'])->name('user#changePassword');
        } );

        // PROFILE ACCOUNT INFO...
        Route::prefix('account')->group( function () {
            Route::get('change' , [UserController::class , 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}' , [UserController::class , 'accountChange'])->name('user#accountChange');
        } );

        // AJAX DATA
        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list' , [AjaxController::class , 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart' , [AjaxController::class , 'addToCart'])->name('ajax#addToCart');
            Route::get('order' , [AjaxController::class , 'order'])->name('ajax#order');
            Route::get('clear/cart' , [AjaxController::class , 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product' , [AjaxController::class , 'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount' , [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
            // Route::get('clear/orderList' , [AjaxController::class , 'clearOrderList'])->name('ajax#clearOrderList');
        });

        // PIZZA DETAILS PAGE
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}' , [UserController::class , 'pizzaDetails'])->name('user#pizzaDetails');
        });

        // CART DETAILS PAGE
        Route::prefix('cart')->group(function () {
            Route::get('list' , [UserController::class , 'cartList'])->name('user#cartList');
        });

        // CONTACT INFO BY USING AJAX
        // Route::prefix('contact')->group(function () {
        //     Route::get('list' , [ContactController::class , 'list'])->name('user#contactList');
        // });

        // CONTACT INFO BY USING FORM POST SUBMIT
        Route::prefix('contact')->group(function () {
            Route::get('list/page' , [ContactController::class , 'listPage'])->name('user#contactListPage');
            Route::post('list' , [ContactController::class , 'list'])->name('user#contactList');
        });
    });

    // Third Way
    // category list page
    // Route::group(['prefix' => 'category' , 'middleware' => 'admin_auth'] , function () {
    //     Route::get('list' , [CategoryController::class , 'list'])->name('category#list');
           // CRUD Start
    //     Route::get('create/page' , [ CategoryController::class , 'createPage' ])->name('category#createPage');
    //     Route::post('create' , [ CategoryController::class , 'create' ])->name('category#create');
    //     Route::get('delete/{id}' , [ CategoryController::class , 'delete' ])->name('category#delete');
    //     Route::get('edit/{id}' , [ CategoryController::class , 'edit' ])->name('category#edit');
    //     Route::post('update/{id}' , [ CategoryController::class , 'update' ])->name('category#update');
    // });
});

Route::get('webTesting' , function () {
    $data = Category::get();
    return response()->json($data, 200);
});
