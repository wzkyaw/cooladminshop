<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // DIRECT PRODUCTS LIST PAGE
    public function list () {
        $pizzas = Product::select('products.*' , 'categories.name as category_name')
                ->when(request('searchKey') , function ($query) {
                $query->where('products.name' , 'like' , '%'.request('searchKey').'%');
                })
                ->leftJoin('categories','products.category_id','categories.category_id')
                ->orderBy('products.created_at' , 'desc')
                ->paginate(3);
                $pizzas->appends(request()->all());
        return view ('admin.product.pizzaList' , compact('pizzas'));
    }

    // DIRECT CREATE PIZZA PAGE
    public function createPage () {
        $category = Category::select('category_id' , 'name')->get();
        return view ('admin.product.create' , compact('category'));
    }

    // CREATE PIZZA PRODUCTS
    public function create (Request $request) {
        $this->productValidationCheck($request , "create");
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public' , $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('products#list');
    }

    // DELETE PIZZA
    public function delete ($id) {
        Product::where('product_id' , $id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess' => 'Deleted Pizza Successfully!']);
    }

    // EDIT PIZZA PAGE
    public function edit ($id) {
        $pizzas = Product::select('products.*' , 'categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.category_id')
                ->where('product_id' , $id)->first();
        return view ('admin.product.details' , compact('pizzas'));
    }

    // direct update page
    public function updatePage ($id) {
        $data = Product::where('product_id' , $id)->first();
        $category = Category::get();
        return view ('admin.product.update' , compact('data' , 'category'));
    }

    // update pizza,
    public function update (Request $request) {
        $Id = $request->pizzaId;
        $this->productValidationCheck($request , "update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('product_id' , $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null) {
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public' , $fileName);
            $data['image'] = $fileName;
        }

        Product::where('product_id' , $Id)->update($data);
        return redirect()->route('products#list')->with(['updatePizzaSuccess' => 'Updated Pizza Successfully!']);
    }

    // REQUEST PRODUCTS INFO
    private function requestProductInfo ($request) {
        return [
            'category_id'  => $request -> pizzaCategory ,
            'name'         => $request -> pizzaName ,
            'description'  => $request -> pizzaDescription ,
            'price'        => $request -> pizzaPrice ,
            'waiting_time' => $request -> waitingTime ,
        ];
    }

    // PRODUCTS VALIDATION CHECK
    private function productValidationCheck($request , $action) {
        $validationRules = [
            'pizzaName'        => 'required | unique:products,name,' .$request->pizzaId. ',product_id' ,
            'pizzaCategory'    => 'required' ,
            'pizzaDescription' => 'required' ,
            'pizzaPrice'       => 'required' ,
            'waitingTime'      => 'required' ,
        ];

        // FIRST WAY VALIDATION WITH PARAMETER FOR CREATE AND UPDATE
        // $validationRules['pizzaImage']= $action == "create" ? 'required | mimes:png,jpg,jpeg' : 'mimes:png,jpg,jpeg' ;

        // SECOND WAY VALIDATION WITH PARAMETER FOR CREATE AND UPDATE
        if ($action == 'create') {
            $validationRules['pizzaImage'] = 'required | mimes:png,jpg,jpeg' ;
        } else {
            $validationRules['pizzaImage'] = 'mimes:png,jpg,jpeg' ;
        }

        Validator::make($request->all() , $validationRules)->validate();
    }
}
