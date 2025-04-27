<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



class HomeController extends Controller
{
    public function index(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','asc')->get(); 
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','asc')->get(); 
    	// lấy tất cả sản phẩm bên product đưa vào sản phẩm mới nhất
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->limit(6)->get(); 
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    
    }
   
   
   
}
