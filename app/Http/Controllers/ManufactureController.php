<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
Session_start();

class ManufactureController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
        return view('admin.add_manufacture');
    }

    public function allmanufacture(){
        $this->AdminAuthCheck();
        $all_manufacture_info=DB::table('tbl_manufacture')->get();
        return view('admin.all_manufacture',compact('all_manufacture_info'));
    }

    public function save_manufacture(Request $request){
        $this->AdminAuthCheck();
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        $data['publication_status']=$request->publication_status;
        DB::table('tbl_manufacture')->insert($data);

        Session::put('message','manufacture added Successfully');
        return Redirect::to('/add_manufacture');
       
    }
    public function unactive_manufacture($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update(['publication_status' => 0]);
            return Redirect::to('/all_manufacture');                   
    }

    public function active_manufacture($manufacture_id){
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
                                 ->update(['publication_status' => 1]);
              return Redirect::to('/all_manufacture');                   
    }

    public function delete_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->delete();
        return Redirect::to('/all_manufacture');
    }

    public function edit_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        $manufacture_info=DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->first();
        return view('admin.edit_manufacture',compact('manufacture_info'));
    }
    public function update_manufacture(Request $request, $manufacture_id){
        $this->AdminAuthCheck();
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->update($data);
        Session::put('message','manufacture Update Successfully');
        return Redirect::to('/all_manufacture');

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
