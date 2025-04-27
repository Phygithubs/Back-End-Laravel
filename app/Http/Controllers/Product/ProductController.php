<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = DB::table('product as p')
                    ->join('category as c','p.category_id','=','c.id')
                    ->select(
                        'p.*',
                        'c.category_name'
                    )
                    ->get();

        return view('product.list', compact('products'));
    }

    public function create(){
        $categories = DB::table('category')->get();
        return view('product.create', compact('categories'));
    }

    public function submitAddProduct(Request $request){
        $validator = Validator::make($request->all() , [
            'name' => 'required|string|max:200',
            'qty'  => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'size' => 'required',
            'color' => 'required',
            'category' => 'required|numeric',
            'thumbnail' => 'required|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors(
                $validator->errors()
            );
        }

        if($request->hasFile('thumbnail')){
            $thumbnail = time() .'-'. $request->file('thumbnail')->getClientOriginalName();
            if(!file_exists('./products')){
                mkdir('./products', 755 , 1);
            }
            $request->file('thumbnail')->move('C:\xampp\htdocs\profile',$thumbnail);
        }

        $result = DB::table('product')->insert([
            'name' => $request->name,
            'qty'  => $request->qty,
            'regular_price' => $request->regular_price,
            'sales_price' => $request->sale_price,
            'category_id' => $request->category,
            'color' => implode(',',$request->color),
            'size' => implode(',',$request->size),
            'thumbnail' => $thumbnail,
            'decription' => $request->description
        ]);

        if($result){
            return redirect('/product-lists')->with('success','Create Prouct Success');
        }
    }
    public function pro($id)
    {
        // Find product by ID and delete it
        $result = DB::table('product')->where('id', $id)->delete();
    
        if ($result) {
            return response()->json([
                'success' => 'Deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Failed to delete product'
            ], 500);
        }
    }

    public function editpro($id)
    {
        $product = DB::table('product')->where('id', $id)->first();
        $categories = DB::table('category')->get(); // Fetch all categories
    
        return view('product.edit', compact('product', 'categories'));
    }

    public function updatepro(Request $request, $id)
    {
        $request->validate([
            'categorys' => 'required|exists:categories,id', // Ensures category_id is valid
        ]);
    
        $product = DB::table('product')->where('id', $id)->first();
    
        if ($request->hasFile('thumbnail')) {
            $thumbnail = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            if (!file_exists('./products')) {
                mkdir('./products', 755, true);
            }
            $request->file('thumbnail')->move('C:\xampp\htdocs\profile', $thumbnail);
        } else {
            $thumbnail = $product->thumbnail;
        }
    
        $result = DB::table('product')->where('id', $id)->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'regular_price' => $request->regular_price,
            'sales_price' => $request->sale_price,
            'category_id' => $request->category,
            'color' => implode(',', $request->color),
            'size' => implode(',', $request->size),
            'thumbnail' => $thumbnail,
            'description' => $request->description
        ]);
    
        if ($result) {
            return redirect('/product-list')->with('success', 'Product updated successfully');
        }
    
        return redirect()->back()->with('error', 'Product update failed');
    }
    
}

