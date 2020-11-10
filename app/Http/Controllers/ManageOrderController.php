<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
Session_start();
use Illuminate\Support\Facades\Redirect;

class ManageOrderController extends Controller
{
    public function manage_order(){
        $all_order_info=DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->select('tbl_order.*','tbl_customer.customer_name')
                        ->get();

        $manage_order = view('admin.manage_order')
                        ->with('all_order_info',$all_order_info);
        return view('admin_layout')
                        ->with('admin.manage_order',$manage_order );
    }

    public function view_order($order_id){
        $order_by_id=DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
                        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                        ->where('tbl_order.order_id',$order_id)
                        ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
                        ->first();

                        /* echo"<pre>";
                        print_r($order_by_id);
                     echo"</pre>"; */

         $view_order = view('admin.view_order')
                        ->with('order_by_id',$order_by_id);
        return view('admin_layout')
                        ->with('admin.view_order',$view_order);
        
    }

    public function delete_order($order_id){
        
        $product=DB::table('tbl_order')->where('order_id',$order_id)->delete();
        Session::put('message','Order Delete successfully');
        return Redirect::to('/manage-order');
        
    }

    public function unactive_order($order_id){
        
        $v=DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 1]);
            return Redirect::to('/manage-order');  
                        /* echo"<pre>";
                        print_r($v);
                        echo"</pre>";  */
                           
    }

    public function active_order($order_id){
     DB::table('tbl_order')->where('order_id',$order_id)
                                 ->update(['order_status' => 0]);
              return Redirect::to('/manage-order');  
                               
    }
}
