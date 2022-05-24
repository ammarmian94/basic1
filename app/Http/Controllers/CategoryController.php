<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    //

    public function AllCat(){
        return view('admin.category.index');
    }

    public function AddCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Enter Category Name',
            'category_name.unique' => 'Category Name Already Exists',
            'category_name.max' => 'Max Length 255 Characters',
        ]);

        Category::insert([
            'user_id' => Auth::user()->id,
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Category Inserted Successfully');
    }
}
