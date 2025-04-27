<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // để sung slug
class LoginController extends Controller
{
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        // kiểm tra đã đăng nhập chưa
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            // chỉ cần gọi $this->AuthLogin(); gán cho các fun khác là oke
            return Redirect::to('login')->send();
        }
    }
   public function login(){
    return view('pages.login.login');
   }
   public function register(){
    return view('pages.login.register');
   }
   public function save_register(Request $request){
    $data = array();
    $data['customer_name'] = $request->fullname;
    $data['customer_phone'] = $request->phone;
    $data['customer_email'] = $request->email;
    $data['customer_password'] = md5($request->password);

    $insert_customer_id = DB::table('tbl_customer')->insertGetId($data);

    Session::put('customer_name', $request->customer_name);
    Session::put('customer_id', $insert_customer_id);
    Session::flash('success', 'Đăng ký thành công!');
    return Redirect::to('/login');
    
}
public function save_login(Request $request){
    $user_email=$request->user_email;
    $user_password=md5($request->user_password);

    $result = DB::table('tbl_customer')
            ->where('customer_email',$user_email)   // email NULL
            ->where('customer_password', $user_password)
            ->first();

            if($result){
                Session::put('customer_name',$result->customer_name);
                Session::put('customer_id',$result->customer_id);
               return Redirect::to('/');
            }else{
                Session::put('message','Mật khẩu hoặc tài khoản không đúng');
                return Redirect::to('/login');
            }
    

}

   public function forgot_password(){
    return view('pages.login.forgot_password');
   }
   public function log_out(){
    Session::put('customer_name',null);
    Session::put('customer_id',null);
    return Redirect::to('/login');
   }
}
