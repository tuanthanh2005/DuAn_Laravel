@extends('admin_layout')
@section('admin_content')

<section>
  <div class="panel-heading">
    Liệt Kê Sản Phẩm
  </div>
  @if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif

  <div class="row w3-res-tb">
    <div class="col-sm-5 m-b-xs">
      <select class="input-sm form-control w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
      </select>
      <button class="btn btn-sm btn-default">Apply</button>
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-3">
      <div class="input-group">
        <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th style="width:20px;">
            <label class="i-checks m-b-none">
              <input type="checkbox"><i></i>
            </label>
          </th>
          <th>Tên danh mục</th>
          <th>Giá sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Danh mục</th>
          <th>Thương hiệu</th>
          <!-- <th>Giá</th> -->
          <th>Hiển thị</th>

          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
    @foreach ($all_product as $key => $product_pro)
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td>{{ $product_pro->product_name }}</td>
        <td>{{ $product_pro->product_price }}</td>
        <td><img src="public/uploads/product/{{ $product_pro->product_image }}" width="100" height="100" alt=""></td>
        <td>{{ $product_pro->category_name }}</td>
        <td>{{ $product_pro->brand_name }}</td>
        <td class="">
            @if ($product_pro->product_status == 1)
                <a href="{{ URL::to('/unactive-product/' . $product_pro->product_id) }}" title="Ẩn">
                    <span class="fa fa-thumbs-up text-success"></span>
                </a>
            @else
                <a href="{{ URL::to('/active-product/' . $product_pro->product_id) }}" title="Hiển thị">
                    <span class="fa fa-thumbs-down text-danger"></span>
                </a>
            @endif
        </td>

        <td>
            <a href="{{ URL::to('/edit-product/'.$product_pro->product_id)}}" class="active styling-edit" title="Sửa">
                <i class="fa fa-pencil-square-o text-success"></i>
            </a>
            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" 
               href="{{ URL::to('/delete-product/' . $product_pro->product_id) }}" 
               class="active styling-edit" title="Xoá">
                <i class="fa fa-times text-danger"></i>
            </a>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>
  </div>
  <footer class="panel-footer">
    <div class="row">

      <div class="col-sm-5 text-center">
        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
      </div>
      <div class="col-sm-7 text-right text-center-xs">
        <ul class="pagination pagination-sm m-t-none m-b-none">
          <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
          <li><a href="">1</a></li>
          <li><a href="">2</a></li>
          <li><a href="">3</a></li>
          <li><a href="">4</a></li>
          <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
        </ul>
      </div>
    </div>
  </footer>
  </div>
  </div>
</section>
@endsection