@extends('layout')
@section('content_category')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			  @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
			<div class="table-responsive cart_info">
				<form action="{{url('/update-cart')}}" method="POST">
					@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="description">Số lượng tồn</td>
							<td class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td>Thao tác</td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
						@php
								$total = 0;
						@endphp
						@foreach(Session::get('cart') as $key => $cart)
							@php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total+=$subtotal;
							@endphp

						<tr>
							<td class="cart_product">
								<img style="height: 90px; width: 90px; object-fit: cover;" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}" />
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p style="text-align: start; text-wrap: wrap;">{{$cart['product_name']}}</p>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_quantity']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button" style="display: flex; align-items: center;">
									<input style="width: 70px; height: 100%;" class="cart_qty_update_cart_ajax" type="number" min="1" data-session_id="{{$cart['session_id']}}" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
									<input style="margin: 10px;" type="submit" value="Cập nhật" name="update_qty" class="check_out btn btn-default btn-sm">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}}đ
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}">
									<i class="fa fa-times"></i>
								</a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
							<td></td>
							<td></td>
							<td></td>
							<td colspan="2"></td>
						</tr>
						@else 
						<tr>
							<td colspan="5"><center>
							@php 
							echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
							@endphp
							</center></td>
						</tr>
						@endif
					</tbody>
				</form>
					@if(Session::get('cart'))
					<tr>
						<td>
							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
	                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                          		</form>
								@if(Session::get('coupon'))
	                          		<a style="margin-left: 0; border-radius: 4px;" class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
                        </td>
						<td>
							<li>Tổng tiền: <span>
								@php
									$total = 0;
								@endphp
								@foreach(Session::get('cart') as $key2 => $val2)
									@php
										$subtotal = $val2['product_price']*$val2['product_qty'];
										$total+=$subtotal;
									@endphp
								@endforeach
								{{number_format($total, 0, ',', '.')}}đ</span>
							</li>
							@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
									@if($cou['coupon_condition'] == 1)
										<li>Mã giảm: {{$cou['coupon_number']}}%</li>
										@php 
										$total_coupon = ($total * $cou['coupon_number']) / 100;
										echo '<li>Tổng giảm: '.number_format($total_coupon,0,',','.').'đ</li>';
										@endphp
										<li>Tổng đã giảm: {{number_format($total - $total_coupon,0,',','.')}}đ</li>

									@elseif ($cou['coupon_condition'] == 2)
										<li>Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}}đ</li>
										@php 
										$total_coupon = $total - $cou['coupon_number'];
										echo '<li>Tổng giảm: '. number_format($total_coupon, 0, ',', '.') .'đ</li>'
										@endphp
										<li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}}đ</li>
									@endif
								@endforeach
							@endif
						</td>
						<td>
							@if(Session::get('customer_id'))
	                          	<a class="btn btn-default check_out" href="{{url('/checkout')}}">Mua hàng</a>
	                        @else
	                          	<a class="btn btn-default check_out" href="{{url('/dang-nhap')}}">Mua hàng</a>
							@endif
						</td>
					</tr>
					@endif
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->



@endsection