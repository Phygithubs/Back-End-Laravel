<?php

namespace App\Http\Controllers\NewsBlog;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Validator;

class BlogController extends Controller
{
    public function news(){
        return view('news-blog.create');
    }
    public function submitAddNews(Request $request){
        $validate = Validator::make($request->all(),[
            'title'=> 'required|string|max:100',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'description'=>'required'
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }
        $thumbnail = $request->file('thumbnail');
        $filename = time()."-".$thumbnail->getClientOriginalName();
        $path ='C:\xampp\htdocs\products';
        $thumbnail->move($path, $filename);

        $addLogo = DB::table('news')->insert([
            'description'=> $request->description,
            'views' => 0,
            'title' => $request->title,
            'banner' => $filename,
            'thumbnail' => $filename
        ]);

        if($addLogo){
            return redirect()->route('list-news')->with('success','Logo Upload Successful');
        }
    }
    public function listNews(){
        $news = DB::table('news')->get();
        return view('news-blog.list',compact('news'));
    }
    public function updateNews($id,Request $request){
        $showNew = DB::table('news')->get();
        $show = DB::table('news')
        ->where('id',$id)
        ->get();
        return view('news-blog.edit',compact('show','showNew'));
    }
    public function submitUpdateNews(Request $request){
        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $namefile = time()."-". $thumbnail->getClientOriginalName();
            $path ='C:\xampp\htdocs\products';
            $thumbnail -> move($path,$namefile);
        }
        else{
            $namefile = $request-> OldThumbnail;
        }
        $update = DB::table('news')->where('id',$request->id)->update([
            'title' => $request->title,
            'description'=> $request->description,
            'banner' => $namefile,
            'thumbnail' => $namefile,
            'views' => 0
        ]);
        if($update){
            return redirect()->route('list-news')->with('success','Update product successful');
        }
    }
    public function destroyNews($id){
        $result = DB::table('news')->where('id',$id)->delete();
        if($result){
            return response()->json([
                'success' => 'Deleted Success'
            ]);
        }
    }
}
