<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // AJAX DATA
    public function pizzaList (Request $request) {
        // logger($request->all());
        if($request->status == 'asc') {
            $data = Product::orderBy('created_at' , 'asc')->get();
        }else {
            $data = Product::orderBy('created_at' , 'desc')->get();
        }
        return response()->json($data,200);
    }

    // RETURN PIZZA ADD TO CART LIST
    public function addToCart (Request $request) {
        $data = $this->getCartList($request);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete' ,
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    // ORDER LIST
    public function order (Request $request) {
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'] ,
                'product_id' => $item['product_id'] ,
                'qty' => $item['qty'] ,
                'total' => $item['total'] ,
                'order_code' => $item['order_code'] ,
            ]);
            $total += $data->total ;
        }

        Cart::where( 'user_id' , Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id ,
            'order_code' => $data->order_code ,
            'total_price' => $total+3000
        ]);

        $response = [
            'status' => 'true' ,
            'message' => 'Order Complete'
        ];
        return response()->json($response,200);
    }

    // CLEAR ALL CART
    public function clearCart () {
        Cart::where('user_id' , Auth::user()->id)->delete();
    }

    // clearCurrentProduct
    public function clearCurrentProduct (Request $request) {
        Cart::where('user_id' , Auth::user()->id)
            ->where('product_id' , $request->productId)
            ->where('cart_id' , $request->orderId)
            ->delete();

        $response = [
            'status' => 'true' ,
            'message' => 'Clear Current Product Complete'
        ];
        return response()->json($response,200);
    }

    // INCREASE VIEW COUNT
    public function increaseViewCount (Request $request) {
        $pizza = Product::where('product_id' , $request->productId)->first();
        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];
        Product::where('product_id' , $request->productId)->update($viewCount);
    }

    // GET CART LIST
    private function getCartList($request) {
        return [
            'user_id' => $request->userId ,
            'product_id' => $request->pizzaId ,
            'qty' => $request->count ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
    }
}
