@extends('layout')
@section('content_category')
@foreach($product_details as $key => $value)

<input type="hidden" id="product_viewed_id" value="{{$value->product_id}}">
<input type="hidden" id="viewed_productname{{$value->product_id}}" value="{{$value->product_name}}">
<input type="hidden" id="viewed_producturl{{$value->product_id}}" value="{{url('/chi-tiet/'.$value->product_slug)}}">
<input type="hidden" id="viewed_productimage{{$value->product_id}}" value="{{asset('public/uploads/product/'.$value->product_image)}}">
<input type="hidden" id="viewed_productprice{{$value->product_id}}" value="{{number_format($value->product_price,0,',','.')}}VNĐ">
<div class="product-details">
	<!--product-details-->
	<style type="text/css">
		.lSSlideOuter .lSPager.lSGallery li {
			padding: 5px;
		}

		.lSSlideOuter .lSPager.lSGallery a {
			display: flex;
			position: relative;
			align-items: center;
		}

		.lSSlideOuter .lSPager.lSGallery a:after {
			content: "";
			display: block;
			padding-bottom: 100%;
		}

		.lSSlideOuter .lSPager.lSGallery img {
			position: absolute;
			height: 100%;
			width: 100%;
			object-fit: cover;
		}

		.lightSlider.lSSlide li {
			padding: 5px;
		}

		.lightSlider.lSSlide li.active {
			border: 1px solid #d1d5db;
		}

		.lSPager.lSGallery li.active {
			border: 1px solid #FE980F;
			border-radius: 0 !important;
		}
	</style>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: none;">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$cate_slug)}}">{{$product_cate}}</a></li>
			<li class="breadcrumb-item" aria-current="page">{{$meta_title}}</li>
			<li>
				<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button" data-size="small">
					<a target="_blank" href="{{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a>
				</div>
			</li>
		</ol>
	</nav>

	<div class="col-sm-5">

		<ul id="imageGallery">
			@foreach($gallery as $key => $gal)
			<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
				<img width="100%" alt="{{$gal->gallery_name}}" src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
			</li>
			@endforeach


		</ul>
		<div style="position: absolute; top: 35%; left: 25px; padding: 5px; font-size: 25px; cursor: pointer;" type="button" id="goToPrevSlide"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
		<div style="position: absolute; top: 35%; right: 25px; padding: 5px; font-size: 25px; cursor: pointer;" type="button" id="goToNextSlide"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
	</div>
	<div class="col-sm-7">

		<div class="product-information">
			<!--/product-information-->
			{{-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> --}}
			<h2>{{$value->product_name}}</h2>
			<p>Mã ID: {{$value->product_id}}</p>
			<img src="images/product-details/rating.png" alt="" />

			<form action="{{URL::to('/add-cart-ajax')}}" method="POST">
				@csrf

				<input type="hidden" id="product_viewed_id" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">

				<input type="hidden" id="product_viewed{{$value->product_id}}" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">

				<input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">

				<input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">

				<input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">

				<span>
					<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>

					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}" value="1" />
					<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
				</span>
				<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
			</form>

			<p><b>Tình trạng:</b> {{$value->product_quantity ? 'Còn hàng' : 'Hết hàng'}}</p>
			<p><b>Điều kiện:</b> Mới 100%</p>
			<p><b>Số lượng kho còn:</b> {{$value->product_quantity}}</p>
			<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
			<p><b>Danh mục:</b> {{$value->category_name}}</p>
			<style type="text/css">
				a.tags_style {
					margin: 3px 2px;
					border: 1px solid;
					border-radius: 5px;

					height: auto;
					background: #fe980f;
					color: #ffff;
					padding: 3px;

				}

				a.tags_style:hover {
					background: black;
				}
			</style>
			<fieldset>
				<legend>Tags</legend>
				<p><i class="fa fa-tag"></i>
					@php
					$tags = $value->product_tags;
					$tags = explode(",",$tags);
					@endphp
					@foreach($tags as $tag)
					<a href="{{url('/tag/'.str_slug($tag))}}" class="tags_style">{{$tag}}</a>
					@endforeach
				</p>
			</fieldset>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
		</div>
		<!--/product-information-->
	</div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
	<!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#details" data-toggle="tab">Mô tả</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>

			<li class="active"><a href="#reviews" data-toggle="tab">Bình luận</a></li>
		</ul>
	</div>
	<div class="col-sm-12 tab-content" style="padding: 0 30px;">
		<div class="tab-pane " id="details">
			<p>{!!$value->product_desc!!}</p>

		</div>
		<div class="tab-pane fade" id="companyprofile">
			<p>{!!$value->product_content!!}</p>
		</div>
		<div class="tab-pane fade active in" id="reviews">
			<?php
			$customer_id = Session()->get('customer_id');
			$customer_name = Session()->get('customer_name');
			if ($customer_id == NULL) {
			?>
				<div class="col-sm-12">
					<b>Đánh giá sản phẩm: <span style="font-size: 25px;">{{$rating}}</span> trên 5</b>
				</div>
				<div class="col-sm-12">
					<a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập để đánh giá về sản phẩm</a>
				</div>
				<br>
				<div class="col-sm-12">
					<form>
						@csrf
						<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
						<div id="comment_show"></div>
					</form>
				<?php
			} else {
				?>
					<div class="col-sm-12">
						<b>Đánh giá sản phẩm: <span style="font-size: 25px;">{{$rating}}</span> trên 5</b>
					</div>
					<p><b>Đánh giá sản phẩm</b></p>
					<!------Rating here---------->
					<ul class="list-inline rating" title="Average Rating">
						@for($count=1; $count<=5; $count++) @php if($count<=$rating){ $color='color:#ffcc00;' ; } else { $color='color:#ccc;' ; } @endphp <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
							@endfor
					</ul>
				<?php
			}
				?>
				<form>
					@csrf
					<input type="hidden" name="comment_product_id" value="{{$value->product_id}}" class="comment_product_id">
					<div id="comment_show">
						<!-- hiển thị các bình luận -->
					</div>
				</form>
				<p><b>Bình luận sản phẩm</b></p>
				<form action="#">
					<span>
						<input style="width:100%;margin-left: 0" type="text" class="comment_name" placeholder="Tên bình luận" />
					</span>
					<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
					<div id="notify_comment"></div>
					<button type="button" class="btn btn-default pull-right send-comment">
						Gửi bình luận
					</button>
					<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
				</form>
				</div>
		</div>
	</div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items">
	<!--recommended_items-->
	<br>
	<h2 class="title text-center">Sản phẩm liên quan</h2>
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach($relate as $key => $lienquan)
				<div class="col-xs-6 col-sm-4 col-md-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center product-related">
								<a href="{{URL::to('/chi-tiet/'.$lienquan->product_slug)}}">
									<div class="cover-img">
									<img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
									</div>
								</a>
								<h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>
								<p>{{$lienquan->product_name}}</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!--/recommended_items-->

@endsection