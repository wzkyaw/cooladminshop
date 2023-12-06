<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct admin category list page
    public function list (Request $request) {
        $categories = Category::when(request('searchKey') , function ($query) {
                      $query->where('name' , 'like' , '%'. request('searchKey') .'%');
                      })
                      ->orderBy('category_id' , 'desc')
                      ->paginate(5);

        return view ('admin.category.list' , compact ('categories'));
    }

    // CRUD START

    // direct category create page
    public function createPage () {
        return view ('admin.category.create');
    }

    // create category
    public function create (Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData ($request);
        Category::create($data);
        return redirect()->route('category#list')->with([ 'createCategorySuccess' => 'Created Category Successfully!' ]) ;
    }

    // edit category
    public function edit ($id) {
        $editData = Category::where('category_id' , $id)->first()->toArray();
        return view ('admin.category.edit' , compact('editData'));
    }

    // delete category
    public function delete ($id) {
        Category::where('category_id' , $id)->delete();
        return back()->with([ 'deleteCategorySuccess' => 'Deleted Category Successfully!' ]);
    }

    // update category
    public function update (Request $request) {
        $this->categoryValidationCheck($request);
        $Id = $request->editId;
        $updateData = $this->requestCategoryData($request);
        Category::where('category_id' , $Id)->update($updateData);
        return redirect()->route('category#list')->with([ 'updateCategorySuccess' => 'Update Category Successfully!' ]);
    }

    // category validation check
    private function categoryValidationCheck ($request) {
        Validator::make($request->all() , [
            'categoryName' => 'required | unique:categories,name,'. $request->editId . ',category_id'
        ] ,[
            'categoryName.required' => 'Need To Fill Category Name!'
        ])->validate();
    }

    // request category data get
    private function requestCategoryData ($request) {
        return [
            'name' => $request->categoryName
        ];
    }
}
