<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    //

    public function AllCat()
    {

        // Eloquent Read Data
        $categories = Category::latest()->paginate(5);

        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        // Query Builder Read Data
        //$categories = DB::table('categories')->latest()->paginate(5);

        // $categories = DB::table('categories')
        //         ->join('users', 'categories.user_id', 'users.id')
        //         ->select('categories.*', 'users.name')
        //         ->latest()->paginate(5);

        return view('admin.category.index', compact('categories', 'trashCat'));
    }



    public function AddCat(Request $request)
    {

        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',
            ],
            [
                'category_name.required' => 'Enter Category Name',
                'category_name.unique' => 'Category Name Already Exists',
                'category_name.max' => 'Max Length 255 Characters',
            ]
        );


        // Eloquent Save Data Way 1 //

        Category::insert([
            'user_id' => Auth::user()->id,
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);


        // Eloquent Save Data Way 2 //

        // $category = new Category;
        // $category->user_id = Auth::user()->id;
        // $category->category_name = $request->category_name;
        // $category->save();


        // Query Builder Save Data //

        // $data = array();
        // $data['user_id'] = Auth::user()->id;
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);


        return redirect()->back()->with('success', 'Category Inserted Successfully');
    }



    public function Edit($id)
    {

        $categories = Category::find($id);

        // Search By ID using Quesry Builder
        //$categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('categories'));
    }



    public function Update(Request $request, $id)
    {

        $update = Category::find($id)->Update([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);


        //Update category using Query Builder

        // $data = Array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }



    public function SoftDelete($id)
    {

        $delete = Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category Soft Deleted Successfully');
    }



    public function Restore($id)
    {

        $delete = Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Category Restored Successfully');
    }



    public function PDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Category Deleted Permanently Successfully');
    }
}
