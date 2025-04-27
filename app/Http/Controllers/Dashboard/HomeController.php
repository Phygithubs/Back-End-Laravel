<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    public function index(){
        return view('dashboard.home');
    }

    public function addLogo(){
        return view('logo.add-logo');
    }

    public function submitLogo(Request $request){
        $validate = Validator::make($request->all(),[
            'thumbnail' => 'required|mimes:jpg,jpeg,png' 
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }
        $thumbnail = $request->file('thumbnail');
        $nameFile = time() ."-". $thumbnail->getClientOriginalName();
        $path = "./image";
        $thumbnail->move($path,$nameFile);

        $addLogo = DB::table('logo')->insert([
            'thumbnail' => $nameFile
        ]);

        if($addLogo){
            return redirect()->back()->with('success','Logo Upload Successful');
        }
    }

    public function ListLogo(){
        $show = DB::table('logo') -> get();
        return view('logo.list-logo',['data'=>$show]);

    }
   
    public function destroy($id){
        $result = DB::table('logo')->where('id',$id)->delete();
        if($result){
            return response()->json([
                'success' => 'Deleted Success',
            ]);
        }
    }


    public function updateLogo($id){
        $data = DB::table('logo')->where('id',$id)->get();
        return view('logo.update-logo',compact('data'));
    }
    public function submitUpdateLogo(Request $request){
        if($request->hasFile('newthumbnail')){
            $thumbnail = $request->file('newthumbnail');
            $nameFile = time() ."-". $thumbnail->getClientOriginalName();
            $path = "./image";
            $thumbnail->move($path,$nameFile);
        }
        else{
            $nameFile = $request-> oldthumbnail;
        }
        $update = DB::table('logo')
                ->where('id',$request->id)
                ->update([
                    'thumbnail' => $nameFile
                ]);
                // dd($thumbnail);
        if($update){
            return redirect()->route('list-logo')->with('success','Update Logo Successfull');
        }
        
    }


}