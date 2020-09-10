<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
Session_start();

class CategoryController extends Controller
{
    public function index(){
        return view('admin.add_category');
    }

    public function allcategory(){
        $all_category_info=DB::table('tbl_category')->get();
        return view('admin.all_category',compact('all_category_info'));
    }

    public function save_category(Request $request){
        $data=array();
       //$data['category_id']=$request->category_id;
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        $data['publication_status']=$request->publication_status;
        DB::table('tbl_category')->insert($data);
        Session::put('message','Category added Successfully');
        return Redirect::to('/add_category');
       
    }

    public function unactive_category($category_id){
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status' => 0]);
            return Redirect::to('/all_category');                   
    }

    public function active_category($category_id){
        DB::table('tbl_category')->where('category_id',$category_id)
                                 ->update(['publication_status' => 1]);
              return Redirect::to('/all_category');                   
    }

    public function edit_category($category_id){
        $category_info=DB::table('tbl_category')->where('category_id',$category_id)->first();
        return view('admin.edit_category',compact('category_info'));
    }

    public function update_category(Request $request, $category_id){
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        DB::table('tbl_category')->where('category_id',$category_id)->update($data);
        Session::put('message','Category Update Successfully');
        return Redirect::to('/all_category');

    }
    public function delete_category($category_id){
        DB::table('tbl_category')->where('category_id',$category_id)->delete();
        return Redirect::to('/all_category');
    }
}
