<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('category')
            ->orderBy('id', 'desc')->get();
        return view('category.list', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $result = DB::table('category')
            ->insert([
                'category_name' => $request->name
            ]);

        if ($result) {
            return redirect('/list-category')->with('success', 'Add Category Success');
        }
    }

    public function destroy($id)
    {
       $result =DB::table('category')->where('id',$id)->delete();

       if($result){
            return response()->json([
                'success' => 'Deleted success'
            ]);
       }
    } 

    public function edit($id)
    {
        // Fetch the category by ID
        $categorys = DB::table('category')->find($id);
        
        // Check if category exists
        if (!$categorys) {
            return redirect()->route('/list-category')->with('error', 'Category not found.');
        }
    
        return view('category.edit', compact('categorys'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Update the category in the database
        DB::table('category')->where('id', $id)->update([
            'category_name' => $request->name,  // Ensure correct column name
            'updated_at' => now(),  // Update timestamp
        ]);
    
        // Redirect with success message
        return redirect()->route('list-category')->with('success', 'Category updated successfully.');
    }

}
