<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // DIRECT USER HOME PAGE
    public function home () {
        $pizza = Product::orderBy('created_at' , 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id' , Auth::user()->id)->get();
        $order = Order::where('user_id' , Auth::user()->id)->get();
        return view ('user.main.home' , compact('pizza' , 'category' , 'cart' , 'order'));
    }

    // DIRECT USER CHANGE PASSWORD PAGE
    public function changePasswordPage () {
        return view ('user.password.change');
    }

    // Change Password
    public function changePassword (Request $request) {
        $this->changePasswordValidation($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        $clientHashPassword = $this->getUserPassword($request);

        if (Hash::check($request->currentPassword, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update($clientHashPassword);

            // Auth::logout();
            return back()->with(['changeSuccess' => 'Changed Password Successfully!']);
        }
        return back()->with(['notMatch' => 'The Current Password Is Not Match, try again!']);
    }

    // USER ACCOUNT CHANGE PAGE
    public function accountChangePage () {
        return view ('user.profile.account');
    }

    // UPDATE ADMIN PROFILE
    public function accountChange (Request $request , $id) {
        $this->acccountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id' , $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public' , $fileName);
            $data['image'] = $fileName;
        }

        User::where('id' , $id)->update($data);
        return back()->with(['updateSuccess' => 'Profile Updated Successfully!']);
    }

    // DERECT PIZZA DETAILS PAGE
    public function pizzaDetails ($id) {
        $pizzaData = Product::where('product_id' , $id)->first();
        $pizzaList = Product::get();
        return view ('user.main.details' , compact ('pizzaData' , 'pizzaList'));
    }

    // CART LIST PAGE
    public function cartList () {
        $cartList = Cart::select('carts.*' , 'products.name as pizza_name' , 'products.price as pizza_price' , 'products.image as pizza_image')
                    ->leftJoin('products' , 'products.product_id' , 'carts.product_id')
                    ->where('carts.user_id' , Auth::user()->id)
                    ->get();
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view ('user.main.cart' , compact('cartList' , 'totalPrice'));
    }

    // CATEGORY FILTER
    public function filter ($id) {
        $pizza = Product::where('category_id' , $id)->orderBy('created_at' , 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id' , Auth::user()->id)->get();
        $order = Order::where('user_id' , Auth::user()->id)->get();
        return view ('user.main.home' , compact('pizza' , 'category' , 'cart' , 'order'));
    }

    // DIRECT HISTORY PAGE
    public function history () {
        $order = Order::orderBy('created_at' , 'desc')
                ->select('orders.*' , 'users.name as user_name')
                ->leftJoin('users' , 'users.id' , 'orders.user_id')
                ->where('user_id' , Auth::user()->id)->get();
        return view('user.main.history', compact('order'));
    }

    // Direct Order Page
    public function orderPage () {
        $data = OrderList::select('order_Lists.*' , 'orders.status as order_status')
              ->leftJoin('orders' , 'orders.order_code' , 'order_lists.order_code')
              ->get();
            //   dd($data->toArray());
        return view('user.main.orderPage' , compact('data'));
    }

    // ACCOUNT VALIDATION CHECK
    private function acccountValidationCheck($request) {
        Validator::make($request->all() , [
            'name' => 'required' ,
            'email' => 'required' ,
            'address' => 'required' ,
            'phone' => 'required' ,
            'image' => 'mimes:png,jpg,jpeg | file' ,
            'gender' => 'required'
        ])->validate();
    }

    // GET USER DATA
    private function getUserData ($request) {
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'address' => $request->address ,
            'phone' => $request->phone ,
            'gender' => $request->gender ,
        ];
    }

    // Change Password validation
    private function changePasswordValidation ($request) {
        Validator::make($request->all(), [
            'currentPassword' => ' required | min:6 ',
            'newPassword' => 'required | min:6',
            'confirmedPassword' => 'required | min:6 | same:newPassword',
        ])->validate();
    }

    // get user password
    private function getUserPassword ($request) {
        return [
            'password' => Hash::make($request->confirmedPassword),
        ];
    }
}
