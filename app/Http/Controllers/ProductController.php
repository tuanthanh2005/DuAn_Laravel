<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // để sung slug

class ProductController extends Controller
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
      // Hiển thị form thêm sản phẩm mới.
    public function add_product(){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get(); 
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    // Lưu sản phẩm mới từ form vào CSDL.
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image =$request->file('product_image');
        // dúng đuôi image cho chuẩn sale
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image= $name_image.rand(0,99).''.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] =$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công!');
            return Redirect::to('add-product');
        }
        $data['product_image'] ='';
        DB::table('tbl_product')->insert($data);
    
        Session::put('message', 'Thêm sản phẩm thành công!');
        return Redirect::to('add-product');
    }
//   Hiển thị danh sách tất cả sản phẩm.
    public function all_product()
{
    $this->AuthLogin();
    $all_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();
    $manager_product = view('admin.all_product')->with('all_product', $all_product);
    return view('admin_layout')->with('admin.all_product', $manager_product);
}
// Thay đổi trạng thái hiển thị của sản phẩm (0 hoặc 1).
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Đã ẩn sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Hiển thị sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get(); 
        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product=view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product) // có cái này để bên trang edit ko cần phải sửa lại foreach
        ->with('brand_product',$brand_product);// có cái này để bên trang edit ko cần phải sửa lại foreach
        return view('admin_layout')->with('edit_product',$manager_product);
    }
    // Cập nhật thông tin sản phẩm theo ID.
    public function update_product(Request $request ,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image= $name_image.rand(0,99).''.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] =$new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Delete  sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    
    // ----------------------------kết thúc admin
    
    //----------> frontend
    // Hiển thị chi tiết sản phẩm cho người dùng.
    public function detail_product($product_id){
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','asc')->get(); 
        $brand_product=DB::table('tbl_brand_product')->orderby('brand_id','asc')->get(); 
        $deltail_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
       
       //hiển thị sản phẩm gợi ý liên quan đến detail sản phẩm hiện tại
       foreach ($deltail_product as $key => $value) {
        $category_id = $value->category_id;
       }
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
        // thêm whereNotIn() lấy all sản phẩm liên quan trừ sản phẩm đang xem
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        
        return view('pages.sanpham.detail_product')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_detail',$deltail_product)->with('related_product',$related_product);
    
    }
}
