<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // DIRECT LIST PAGE
    public function list () {
        $order = Order::select('orders.*' , 'users.name as user_name')
                ->leftJoin('users' , 'users.id' , 'orders.user_id')
                ->orderBy('created_at' , 'desc')
                ->when(request('searchKey') , function ($query) {
                    $query->orwhere('user_id' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('users.name' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.order_code' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.total_price' , 'like' , '%'.request('searchKey').'%');
                })
                ->get();
        return view ('admin.order.list' , compact('order'));
    }

    // SORT WITH AJAX
    public function changeStatus (Request $request) {
        $order = Order::select('orders.*' , 'users.name as user_name')
                ->leftJoin('users' , 'users.id' , 'orders.user_id')
                ->orderBy('created_at' , 'desc')
                ->when(request('searchKey') , function ($query) {
                    $query->orwhere('user_id' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('users.name' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.order_code' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.total_price' , 'like' , '%'.request('searchKey').'%');
                });
                if($request->orderStatus == 'all') {
                    $order = $order->get();
                }else {
                    $order = $order->where('status' , $request->orderStatus)->get();
                }
                return view ('admin.order.list' , compact('order'));
    }

    // CHANGE STATUS WITH AJAX
    public function ajaxChangeStatus (Request $request) {
        Order::where('order_id' , $request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*' , 'users.name as user_name')
                ->leftJoin('users' , 'users.id' , 'orders.user_id')
                ->orderBy('created_at' , 'desc')
                ->when(request('searchKey') , function ($query) {
                    $query->orwhere('user_id' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('users.name' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.order_code' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('orders.total_price' , 'like' , '%'.request('searchKey').'%');
                })
                ->get();
    }

    // GETTING ORDER CODE TO SHOW PRODUCTS
    public function listInfo ($orderCode) {
        $orderData = Order::where('order_code' , $orderCode)->first();
        $orderList = OrderList::select('order_lists.*' , 'users.name as user_name' , 'products.name as product_name' , 'products.image as product_image')
                    ->leftJoin('users' , 'users.id' , 'order_lists.user_id')
                    ->leftJoin('products' , 'products.product_id' , 'order_lists.product_id')
                    ->where('order_code' , $orderCode)
                    ->get();
        return view('admin.order.productList' , compact ('orderList','orderData'));
    }
}
