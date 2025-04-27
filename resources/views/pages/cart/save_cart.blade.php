@extends('welcome')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th class="image">Hình Ảnh</th>
                        <th class="description">Tên sản phẩm</th>
                        <th class="price">Giá</th>
                        <th class="quantity">Số lượng</th>
                        <th class="total">Tổng tiền</th>
                        <th class="action">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cart as $id => $item)
                    @php
                    $subtotal = $item['price'] * $item['quantity'];
                    @endphp
                    <tr>
                        <td class="cart_product">
                            <img src="{{ asset('public/uploads/product/'.$item['image']) }}" width="50" alt="{{ $item['name'] }}">
                        </td>
                        <td class="cart_description">
                            {{ $item['name'] }}
                        </td>
                        <td class="cart_price">
                            ${{ number_format($item['price'], 2) }}
                        </td>
                        <td class="cart_quantity">
                            <span>{{ $item['quantity'] }}</span>
                        </td>
                        <td class="cart_total">
                            ${{ number_format($subtotal, 2) }}
                        </td>
                        <td class="cart_delete">
                            <a href="{{ route('cart.remove', $id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                               <i class="fa fa-times"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                    @endforelse

                    @if(count($cart) > 0)
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                    </tr>
                    
                    @endif
                </tbody>
       
                
            </table>
        <center><button type="submit" name="thanhtoan"><a href="{{ URL::to('/thanh-toan') }}">Thanh Toán</a></button></center>
        </div>
    </div>
</section>
@endsection
