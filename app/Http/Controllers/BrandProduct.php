<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class BrandProduct extends Controller
{
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
    
        DB::table('tbl_brand_product')->insert($data);
    
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công!');
        return Redirect::to('add-brand-product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product=DB::table('tbl_brand_product')->get();
        $manager_brand_product=view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('all_brand_product',$manager_brand_product);
    }   
    public function unactive_brand_product($cate_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $cate_id)->update(['brand_status' => 1]);
        Session::put('message', 'Đã ẩn thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    
    public function active_brand_product($cate_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $cate_id)->update(['brand_status' => 0]);
        Session::put('message', 'Hiển thị thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($cate_id){
        $this->AuthLogin();
        $edit_brand_product=DB::table('tbl_brand_product')->where('brand_id',$cate_id)->get();
        $manager_brand_product=view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request ,$cate_id){
        $this->AuthLogin();
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        DB::table('tbl_brand_product')->where('brand_id', $cate_id)->update($data);
        Session::put('message', 'Update thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($cate_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $cate_id)->delete();
        Session::put('message', 'Delete thương hiệu sản phẩm thành công!');
        return Redirect::to('all-brand-product');
    }
    public function show_brand_home($brand_id){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $brand_by_id=DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name= DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();
        return view('pages.brand.show_brand_home')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
