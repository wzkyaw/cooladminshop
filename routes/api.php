<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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

Route::get('product/list' , [RouteController::class , 'productList']);
Route::get('category/list' , [RouteController::class , 'categoryList']);
Route::get('cart/list' , [RouteController::class , 'cartList']);
Route::get('contact/list' , [RouteController::class , 'contactList']);
Route::get('order/list' , [RouteController::class , 'orderList']);
Route::get('orderList/list' , [RouteController::class , 'orderListList']);
Route::get('rating/list' , [RouteController::class , 'ratingList']);
Route::get('user/list' , [RouteController::class , 'userList']);

Route::post('create/category' , [RouteController::class , 'createCategory']);
Route::post('create/contact' , [RouteController::class , 'createContact']);
Route::post('delete/category' , [RouteController::class , 'deleteCategory']);
Route::post('edit/category/details' , [RouteController::class , 'editCategoryDetails']);
Route::post('category/update' , [RouteController::class , 'categoryUpdate']);

Route::get('delete/category/{id}' , [RouteController::class , 'deleteCategoryGet']);
Route::get('edit/category/details/{id}' , [RouteController::class , 'editCategoryDetailsGet']);

/**
 *
 * product list
 * localhost:8000/api/product/list (GET)
 *
 * category list
 * localhost:8000/api/category/list (GET)
 *
 * cart list
 * localhost:8000/api/cart/list (GET)

 * contact list
 * localhost:8000/api/contact/list (GET)

 * order list
 * localhost:8000/api/order/list (GET)

 * orderList list
 * localhost:8000/api/orderList/list (GET)

 * rating list
 * localhost:8000/api/rating/list (GET)

 * user list
 * localhost:8000/api/user/list (GET)
 *
 * create category
 * localhost:8000/api/create/category (POST)
 * body{
 *    name : '',
 * }
 *
 * create contact
 * localhost:8000/api/create/contact (POST)
 * body{
 *    name : '' ,
 *    email : '' ,
 *    message : '' ,
 *    subject : '' ,
 *    userId : ''
 * }
 *
 * delete category
 * localhost:8000/api/delete/category (POST)
 * body{
 *    categoryId : '' ,
 * }
 *
 * delete category
 * localhost:8000/api/delete/category/1 (GET)
 *
 * edit category details
 * localhost:8000/api/edit/category/details (POST)
 * body{
 *    categoryId : '' ,
 * }
 *
 * edit category details with get
 * localhost:8000/api/edit/category/details/1 (GET)
 *
 * update category
 * localhost:8000/api/update/category (POST)
 * body{
 *    name : '' ,
 *    categoryId : '' ,
 * }
 *
 */
