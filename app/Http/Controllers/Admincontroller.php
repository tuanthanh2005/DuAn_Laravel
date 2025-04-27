<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



class Admincontroller extends Controller
{
    // thêm bảo nhật bắt buộc đăng nhập mới vào được trang admin
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        // kiểm tra đã đăng nhập chưa
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            // chỉ cần gọi $this->AuthLogin(); gán cho các fun khác là oke
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        // $this->AuthLogin();
    	return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $this->AuthLogin();
     $admin_email=$request->admin_email;
     $admin_password=md5($request->admin_password);

     $result =DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
       if($result){
        Session::put('admin_name',$result->admin_name);
        Session::put('admin_id',$result->admin_id);
       return Redirect::to('/dashboard');
    }else{
        Session::put('message','Mật khẩu hoặc tài khoản không đúng');
        return Redirect::to('/admin');
    }

    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');

    }
}
