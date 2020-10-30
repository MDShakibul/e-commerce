<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
Session_start();

class ProductController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
        return view('admin.add_product');
    }


    public function save_product(Request $request){
        $this->AdminAuthCheck();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_discription;
        $data['product_long_description']=$request->product_long_discription;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        if($request->publication_status === null){
            $data['publication_status']=0;
        }else{
            $data['publication_status']=$request->publication_status;
        }
        
        $image=$request->file('product_image');
        if($image){
            $image_name=hexdec(uniqid());
            $ext=strtolower($image-> getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            if($success){
                $data['product_image']=$image_url;
                DB::table('tbl_products')->insert($data);
                Session::put('message','product added Successfully');
                return Redirect::to('/add_product');
            }
       }
       $data['product_image']='';
       DB::table('tbl_products')->insert($data);
       Session::put('message','product added Successfully without image');
       return Redirect::to('/add_product');

    }

    public function all_product(){
        $this->AdminAuthCheck();
        $all_product_info=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->get();

        $manage_product = view('admin.all_product')
                        ->with('all_product_info',$all_product_info);
        return view('admin_layout')
                        ->with('admin.all_product',$manage_product );
        //return view('admin.all_product',compact('all_product_info'));
    }

    public function unactive_product($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['publication_status' => 0]);
            return Redirect::to('/all_product');                   
    }

    public function active_product($product_id){
        DB::table('tbl_products')->where('product_id',$product_id)
                                 ->update(['publication_status' => 1]);
              return Redirect::to('/all_product');                   
    }

    public function delete_product($product_id){
        $this->AdminAuthCheck();
        $product=DB::table('tbl_products')->where('product_id',$product_id)->first();
        $image=$product->product_image;
        $delete=DB::table('tbl_products')->where('product_id',$product_id)->delete();
        if($delete){
            unlink($image);
        return Redirect::to('/all_product');
        }else{
            return Redirect::to('/all_product');
        }
    }

    public function edit_product($product_id){
        $this->AdminAuthCheck();
        $all_category_info=DB::table('tbl_category')->get();
        $all_manufacture_info=DB::table('tbl_manufacture')->get();
        $product_info=DB::table('tbl_products')->where('product_id',$product_id)->first();
        return view('admin.edit_product',compact('product_info','all_category_info','all_manufacture_info'));
    }

    public function update_product(Request $request, $product_id){
        $this->AdminAuthCheck();
        return $request;
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        
        $image=$request->file('product_image');
        if($image){
            $image_name=hexdec(uniqid());
            $ext=strtolower($image-> getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['product_image']=$image_url;
            unlink($request->old_photo);
            DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.product_id',$product_id)
                        ->update($data);
                Session::put('message','product added Successfully');
                return Redirect::to('/add_product');
            }else{
             $data['product_image']=$request->old_photo;
             DB::table('tbl_products')
             ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
             ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
             ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
             ->where('tbl_products.product_id',$product_id)
             ->update($data);
             Session::put('message','product added Successfully without image');
             return Redirect::to('/add_product');
    }

    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        }
        else{
            return Redirect::to('/admin')->send();
        }
     }
}
