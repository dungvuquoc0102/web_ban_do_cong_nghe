@extends('layout')
@section('content_category')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Thanh toán giỏ hàng</li>
			</ol>
		</div>
		<div class="shopper-informations">
			<div class="row">
				<style type="text/css">
					.col-md-6.form-style input[type=text] {
						margin: 5px 0;
					}
				</style>
				<div class="col-md-4 clearfix" style="margin-bottom: 30px;">
					@if(\Session::has('error'))
					<div class="alert alert-danger">{{ \Session::get('error') }}</div>
					{{ \Session::forget('error') }}
					@endif
					@if(\Session::has('success'))
					<div class="alert alert-success">{{ \Session::get('success') }}</div>
					{{ \Session::forget('success') }}
					@endif
					<div class="bill-to">
						<p style="padding: 0 15px;">Điền thông tin gửi hàng</p>
						<div class="col-md-12 form-style">
							<form method="POST">
								@csrf
								<label for="exampleInputPassword1">Thông tin khách hàng</label>
								<input style="margin-top: 0;" type="text" name="shipping_name" class="shipping_name form-control" placeholder="Họ và tên (bắt buộc)">
								<input type="phone" style="margin-top: 15px;" name="shipping_phone" class="shipping_phone form-control" placeholder="Số điện thoại (bắt buộc)">
								<input type="email" style="margin: 15px 0;" name="shipping_email" class="shipping_email form-control" placeholder="Điền email">
								<label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
								<form>
									@csrf
									<div class="form-group">
										<!-- <label for="exampleInputPassword1">Chọn thành phố</label> -->
										<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
											<option value="">Thành phố / Tỉnh</option>
											@if(Session::get('fee') && Session::get('fee_address'))
												@foreach($city as $key => $ci)
													@if(Session::get('fee_matp') == $ci->matp)
												<option selected value="{{$ci->matp}}">{{$ci->name_city}}</option>
												@else
												<option value="{{$ci->matp}}">{{$ci->name_city}}</option>
												@endif
												@endforeach
											@else
												@foreach($city as $key => $ci)
												<option value="{{$ci->matp}}">{{$ci->name_city}}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-group">
										<!-- <label for="exampleInputPassword1">Chọn quận huyện</label> -->
										<select name="province" id="province" class="form-control input-sm m-bot15 province choose">
										@if(Session::get('fee') && Session::get('fee_address'))
											@foreach($province as $key => $pr)
													@if(Session::get('fee_maqh') == $pr->maqh)
												<option selected value="{{$pr->maqh}}">{{$pr->name_quanhuyen}}</option>
												@else
												<option value="{{$pr->maqh}}">{{$pr->name_quanhuyen}}</option>
												@endif
												@endforeach
										@else
										<option value="">Quận / Huyện</option>
										@endif
										</select>
									</div>
									<div class="form-group">
										<!-- <label for="exampleInputPassword1">Chọn xã phường</label> -->
										<select name="wards" id="wards" class="form-control input-sm m-bot15 wards checkout choose">
										@if(Session::get('fee') && Session::get('fee_address'))
										@foreach($wards as $key => $wa)
													@if(Session::get('fee_xaid') == $wa->xaid)
												<option selected value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
												@else
												<option value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
												@endif
												@endforeach
										@else 
										<option value="">Phường / Xã</option>
										@endif
										</select>
									</div>
									<!-- <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery"> -->
								</form>
								<input style="margin-bottom: 15px;" type="text" name="shipping_address" class="shipping_address form-control" placeholder="Số nhà, tên đường">
								<label for="exampleInputPassword1">Ghi chú đơn hàng</label>
								<textarea style="margin-bottom: 15px;" name="shipping_notes" class="shipping_notes form-control" placeholder="Ghi chú" rows="1"></textarea>
								@if(Session()->get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{Session()->get('fee')}}">
								@else
									<input type="hidden" name="order_fee" class="order_fee" value="30000">
								@endif
								@if(Session()->get('coupon'))
									@foreach(Session()->get('coupon') as $key => $cou)
										<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
									@endforeach
								@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="no">
								@endif
								<div class="">
									<div class="form-group">
										<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
										<select name="payment_select" class="form-control input-sm m-bot15 payment_select">
											<option value="1">Thanh toán khi nhận hàng</option>
											<option value="2">Thanh toán qua Paypal</option>
											<option value="0">Thanh toán chuyển khoản</option>
										</select>
									</div>
								</div>
								@if(Session()->get('cart'))
								<input type="button" value="Đặt hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								@else
								@endif
							</form>
						</div>
						<!-- <div class="col-md-6">
							<form>
								@csrf
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn thành phố</label>
									<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
										<option value="">--Chọn tỉnh thành phố--</option>
										@if(Session::get('fee') && Session::get('fee_address'))
											@foreach($city as $key => $ci)
												@if(Session::get('fee_matp') == $ci->matp)
											<option selected value="{{$ci->matp}}">{{$ci->name_city}}</option>
											@else
											<option value="{{$ci->matp}}">{{$ci->name_city}}</option>
											@endif
											@endforeach
										@else
											@foreach($city as $key => $ci)
											<option value="{{$ci->matp}}">{{$ci->name_city}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn quận huyện</label>
									<select name="province" id="province" class="form-control input-sm m-bot15 province choose">
									@if(Session::get('fee') && Session::get('fee_address'))
										@foreach($province as $key => $pr)
												@if(Session::get('fee_maqh') == $pr->maqh)
											<option selected value="{{$pr->maqh}}">{{$pr->name_quanhuyen}}</option>
											@else
											<option value="{{$pr->maqh}}">{{$pr->name_quanhuyen}}</option>
											@endif
											@endforeach
									@else
									<option value="">--Chọn quận huyện--</option>
									@endif
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn xã phường</label>
									<select name="wards" id="wards" class="form-control input-sm m-bot15 wards checkout">
									@if(Session::get('fee') && Session::get('fee_address'))
									@foreach($wards as $key => $wa)
												@if(Session::get('fee_xaid') == $wa->xaid)
											<option selected value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
											@else
											<option value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
											@endif
											@endforeach
									@else 
									<option value="">--Chọn xã phường--</option>

									@endif
									</select>
								</div>
								<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
							</form>
						</div> -->
					</div>
				</div>
				<div class="col-sm-8 clearfix">
					@if(session()->has('message'))
					<div class="alert alert-success">
						{!! session()->get('message') !!}
					</div>
					@elseif(session()->has('error'))
					<div class="alert alert-danger">
						{!! session()->get('error') !!}
					</div>
					@endif
					<!-- <div class="table-responsive cart_info">

						<form action="{{url('/update-cart')}}" method="POST">
							@csrf
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Hình ảnh</td>
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá sản phẩm</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@if(Session()->get('cart')==true)
									<?php

									$total = 0;
									?>
									@foreach(Session()->get('cart') as $key => $cart)
									<?php
									$subtotal = $cart['product_price'] * $cart['product_qty'];
									$total += $subtotal;
									?>

									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}}đ
											</p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach
									<tr>
										<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
										<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
										<td> <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Thanh toán bằng paypal</a></td>
										<td>
											@if(Session()->get('coupon'))
											<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif
										</td>
										<td colspan="2">
											<li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
											@if(Session()->get('coupon'))
											<li>
												@foreach(Session()->get('coupon') as $key => $cou)
												@if($cou['coupon_condition']==1)
												Mã giảm : {{$cou['coupon_number']}} %
												<p>
													<?php
														$total_coupon = ($total * $cou['coupon_number']) / 100;
													?>
												</p>
												<p>
													<?php
													$total_after_coupon = $total - $total_coupon;
													?>
												</p>
												@elseif($cou['coupon_condition']==2)
												Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} vnđ

												<p>
													<?php
													$total_coupon = $total - $cou['coupon_number'];

													?>
												</p>
												<?php
												$total_after_coupon = $total_coupon;
												?>
												@endif
												@endforeach
											</li>
											@endif

											@if(Session()->get('fee'))
											<li>
												<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>

												Phí vận chuyển <span>{{number_format(Session()->get('fee'),0,',','.')}}đ</span>
											</li>
											<?php $total_after_fee = $total + Session()->get('fee'); ?>
											@endif
											<li>Tổng còn:
												<?php
												if (Session()->get('fee') && !Session()->get('coupon')) {
													$total_after = $total_after_fee;
													echo number_format($total_after, 0, ',', '.') . 'đ';
												} elseif (!Session()->get('fee') && Session()->get('coupon')) {
													$total_after = $total_after_coupon;
													echo number_format($total_after, 0, ',', '.') . 'đ';
												} elseif (Session()->get('fee') && Session()->get('coupon')) {
													$total_after = $total_after_coupon;
													$total_after = $total_after + Session()->get('fee');
													echo number_format($total_after, 0, ',', '.') . 'đ';
												} elseif (!Session()->get('fee') && !Session()->get('coupon')) {
													$total_after = $total;
													echo number_format($total_after, 0, ',', '.') . 'đ';
												}

												//doi sang USD roi luu vao Session
												$vnd_to_usd = $total_after / 23000;
												$total_paypal = round($vnd_to_usd);
												Session()->put('total_paypal', $total_paypal);
												?>

											</li>
										</td>

									</tr>
									@else
									<tr>
										<td colspan="5">
											<center>
												<?php
												echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
												?>
											</center>
										</td>
									</tr>
									@endif
								</tbody>
						</form>
						@if(Session()->get('cart'))
						<tr>
							<td>
								<form method="POST" action="{{url('/check-coupon')}}">
									@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
									<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
								</form>
								<form method="POST" action="{{url('/momo_payment')}}">
									@csrf
									<input type="hidden" name="total_momo" value="{{$total_after}}">
									<button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán MOMO</button>
								</form>
							</td>
						</tr>
						@endif
						</table>
					</div> -->
					<div class="table-responsive cart_info">
				<form action="{{url('/update-cart')}}" method="POST">
					@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="description">Kho</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<!-- <td>Thao tác</td> -->
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
									<input readonly="true" style="width: 30px; height: 100%; text-align: center;" class="cart_qty_update_cart_ajax" type="text" min="1" data-session_id="{{$cart['session_id']}}" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
									<!-- <input style="margin: 10px;" type="submit" value="Cập nhật" name="update_qty" class="check_out btn btn-default btn-sm"> -->
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}}đ
								</p>
							</td>
							<!-- <td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}">
									<i class="fa fa-times"></i>
								</a>
							</td> -->
						</tr>
						@endforeach
						<tr>
							<!-- <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td> -->
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
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
						<!-- <td>
							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
	                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                          	</form>
							@if(Session::get('coupon'))
								<a style="margin-left: 0; border-radius: 4px;" class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
							@endif
                        </td> -->
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


									@elseif ($cou['coupon_condition'] == 2)
										<li>Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}}đ</li>
										@php 
										$total_coupon = $cou['coupon_number'];
										echo '<li>Tổng giảm: '. number_format($total_coupon, 0, ',', '.') .'đ</li>'
										@endphp
									@else
									    @php
									    $total_coupon = 0;
										@endphp
									@endif
								@endforeach
							@else
							    @php
								$total_coupon = 0;
								@endphp
							@endif
							@if(Session::get('fee'))
								@php
								$total_fee = Session::get('fee');
								@endphp
							@else
								@php
								$total_fee = 30000;
								@endphp
							@endif
							<li>
							Phí vận chuyển: <span id="fee_checkout">{{ number_format($total_fee, 0, ',', '.') }}</span> 
							@if(Session::get('fee'))
							<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
							@endif
							</li>
							@php
							$total_last = $total - $total_coupon + $total_fee;
							if($total_last < 0) {
								$total_last = 0;
							}
							@endphp
							<li id="">Tổng thanh toán: <span id="total_checkout">{{number_format($total_last,0,',','.')}}</span>đ</li>
						</td>
						<!-- <td>
							@if(Session::get('customer_id'))
	                          	<a class="btn btn-default check_out" href="{{url('/checkout')}}">Mua hàng</a>
	                        @else
	                          	<a class="btn btn-default check_out" href="{{url('/dang-nhap')}}">Mua hàng</a>
							@endif
						</td> -->
					</tr>
					@endif
				</table>
			</div>
				</div>
			</div>
		</div>


	</div>
</section>
<!--/#cart_items-->
@endsection