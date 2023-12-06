<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all products
    public function productList () {
        $products = Product::get();
        return response()->json($products, 200);
    }

    // get all categories
    public function categoryList () {
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    // get all carts
    public function cartList () {
        $carts = Cart::get();
        return response()->json($carts, 200);
    }

    // get all contacts
    public function contactList () {
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }

    // get all orders
    public function orderList () {
        $orders = Order::get();
        return response()->json($orders, 200);
    }

    // get all orderLists
    public function orderListList () {
        $orderLists = OrderList::get();
        return response()->json($orderLists, 200);
    }

    // get all ratings
    public function ratingList () {
        $ratings = Rating::get();
        return response()->json($ratings, 200);
    }

    // get all users
    public function userList () {
        $users = User::get();
        return response()->json($users, 200);
    }

    // create category
    public function createCategory (Request $request) {
        $data = [
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];

        $categoryList = Category::create($data);
        return response()->json($categoryList, 200);
    }

    // create contact
    public function createContact (Request $request) {
        $data = [
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message ,
            'subject' => $request->subject ,
            'user_id' => $request->userId ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now() ,
        ];

        $contactList = Contact::create($data);
        return response()->json($contactList, 200);
    }

    // delete category
    public function deleteCategory (Request $request) {
        $data = Category::where('category_id' , $request->categoryId)->first();

        if(isset($data)) {
            Category::where('category_id' , $request->categoryId)->delete();
            return response()->json(['status' => true , 'message' => 'deleted successfully!']);
        }
        return response()->json(['status' => false , 'message' => 'There is no category!']);
    }

    // delete category with get method
    public function deleteCategoryGet ($id) {
        $data = Category::where('category_id' , $id)->first();

        if(isset($data)) {
            Category::where('category_id' , $id)->delete();
            return response()->json(['status' => true , 'message' => 'deleted successfully!']);
        }
        return response()->json(['status' => false , 'message' => 'There is no category!']);
    }

    // edit category details
    public function editCategoryDetails (Request $request) {
        $data = Category::where('category_id' , $request->categoryId)->first();

        if(isset($data)) {
            return response()->json(['status' => true , 'category' => $data]);
        }
        return response()->json(['status' => false , 'category' => 'There is no category!'], 500);
    }

    // edit category details with get method
    public function editCategoryDetailsGet ($id) {
        $data = Category::where('category_id' , $id)->first();

        if(isset($data)) {
            return response()->json(['status' => true , 'category' => $data]);
        }
        return response()->json(['status' => false , 'category' => 'There is no category!'], 500);
    }

    // category update
    public function categoryUpdate (Request $request) {
        $data = [
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now() ,
        ];

        $dbSource = Category::where('category_id' , $request->categoryId)->first();

        if(isset($dbSource)) {
            $categoryUpdate = Category::where('category_id' , $request->categoryId)->update($data);
            return response()->json($categoryUpdate, 200);
        }

        return response()->json(['status' => false , 'message' => 'there is no category!'], 500);
    }
}
