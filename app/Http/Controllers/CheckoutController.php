<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function login_check(){
        return view('pages.login');
    }

    public function customer_registration(Request $request){
        $data = array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['password']=md5($request->password);
        $data['mobile_number']=$request->mobile_number;

        $customer_id=DB::table('tbl_customer')
                    ->insertGetId($data);
        
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect::to('/checkout');
    }

    public function checkout(){
        return view('pages.checkout');
    }

    
    public function save_shipping_details(Request $request){
        $data=array();
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_first_name']=$request->shipping_first_name;
        $data['shipping_last_name']=$request->shipping_last_name;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_mobile_number']=$request->shipping_mobile_number;
        $data['shipping_city']=$request->shipping_city;

            $shipping_id=DB::table('tbl_shipping')
                        ->insertGetId($data);

        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
        /* echo"<pre>";
        print_r($data);
        echo"</pre>"; */

    }

    public function customer_login(Request $request){
        $customer_email = $request->customer_email;
        $password = md5($request->password);

        $result=DB::table('tbl_customer')
               ->where('customer_email',$customer_email )
               ->where('password',$password)
               ->first();

            if($result){
                Session::put('customer_id',$result->customer_id);
                return Redirect::to('/checkout');
            }else{
                return Redirect::to('/login-check');
            }

           /*  echo"<pre>";
        print_r($result);
        
        echo"</pre>"; */
    }

}
