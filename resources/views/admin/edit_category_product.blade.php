@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Sửa danh mục sản phẩm
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
                            @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                            <form action="{{ URL::to('/update-category-product/'.$edit_value->category_id) }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{ $edit_value->category_name }}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>                         
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize:  none" rows="8"  class="form-control" name="category_product_desc" id="exampleInputPassword1" 
                                    placeholder="Mô tả danh mục">{{ $edit_value->category_name }}</textarea>
                        </div>
                               
                                <button type="submit" name="update_category_product" class="btn btn-info">Update</button>
                                </form>
                            </div>
@endforeach
                        </div>
                    </section>

            </div>
@endsection