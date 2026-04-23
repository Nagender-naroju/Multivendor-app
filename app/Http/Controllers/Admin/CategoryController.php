<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Categories;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Categories::where('parent_id', NULL)->get();
        return view('admin.categories.categories',compact('categories'));
    }

    public function create_category(){
        $title = "Admin | Add Category";
        $categories = Categories::all();
        return view('admin.categories.create',compact('title','categories'));
    }

    public function store_category(Request $request)
    {
        
        $request->validate([
            'category_name'=>"required|unique:categories"
        ]);

        // dd($request->all());
        try{
            $data = Categories::create([
                        'category_name'=>$request->category_name,
                        'parent_id'=>$request->parent_id
                    ]);

            if($data){
                return redirect()->route('admin.categories')->with('success', "Category Added Successfully");
            }

            return redirect()->route('admin.categories')->with('error', "Somethign went wrong !!");
        }catch(Exception $e){
            return redirect()->route('admin.categories')->with('error', $e->getMessage());
        }
    }   

    public function edit_category($id)
    {
       try{
            $category = Categories::findOrFail($id);
            $categories = Categories::all();
            return view('admin.categories.edit',compact('category','categories'));
       }catch(Exception $e){
            return redirect()->route('admin.categories')->with('error', $e->getMessage());
       }
    }

    public function update_category(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_name'=>"required"
        ]);

        try{
            $category = Categories::findOrFail($request->category_id);
            if($category){
                $res = $category->update([
                    'category_name'=>$request->category_name,
                    'parent_id'=>$request->parent_id
                ]);

                if($res){
                    return redirect()->route('admin.categories')->with('success', "Category updated successfully..");
                }
            return redirect()->route('admin.categories')->with('error', "Somethign went wrong !!");
            }
        }catch(Exception $e){
            return redirect()->route('admin.categories')->with('error', $e->getMessage());
        }
    }


    public function delete_category($id)
    {
        try{
            $category = Categories::findOrFail($id);
            if($category){
                $res = $category->delete();

                if($res){
                    return redirect()->route('admin.categories')->with('success', "Category deleted successfully..");
                }
            return redirect()->route('admin.categories')->with('error', "Somethign went wrong !!");
            }
        }catch(Exception $e){
            return redirect()->route('admin.categories')->with('error', $e->getMessage());
        }
    }
}
