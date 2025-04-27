@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Sửa thương hiệu sản phẩm
                        </header>
                        <div class="panel-body">
                       <?php
                       	use Illuminate\Support\Facades\Session;
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                            <form action="{{ URL::to('/update-brand-product/'.$edit_value->brand_id) }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>                         
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize:  none" rows="8"  class="form-control" name="brand_product_desc" id="exampleInputPassword1" 
                                    placeholder="Mô tả thương hiệu">{{ $edit_value->brand_name }}</textarea>
                        </div>
                               
                                <button type="submit" name="update_brand_product" class="btn btn-info">Update</button>
                                </form>
                            </div>
@endforeach
                        </div>
                    </section>

            </div>
@endsection