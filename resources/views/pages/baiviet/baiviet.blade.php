@extends('layout')

@section('content_category')
<style type="text/css">
  .baiviet ul li {
    padding: 2px;
    font-size: 16px;
  }

  .baiviet ul li a {
    color: #000;
  }

  .baiviet ul li a:hover {
    color: #FE980F;
  }

  .baiviet ul li {
    list-style-type: decimal-leading-zero;
  }

  .mucluc h1 {
    font-size: 20px;
    color: brown;
  }
</style>
<div class="features_items">

  <h2></h2>
  <h2 style="margin:0;position: inherit;font-size: 22px" class="title text-center">{{$meta_title}}</h2>
  <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
  @foreach($post_by_id as $key => $p)
  
  @if($p->last_update_at)
  <div class="last-update-at">{{ $p->last_update_at }} (GMT+7)</div>
  @else
  @endif
  @endforeach

  <div class="product-image-wrapper" style="border: none;">
    @foreach($post_by_id as $key => $p)
    <div class="single-products" style="margin:10px 0;padding: 2px">
      {!!$p->post_content!!}

    </div>
    <div class="clearfix"></div>
    @endforeach
  </div>

</div>
<!--features_items-->
<h2 style="margin:0;font-size: 22px" class="title text-center">Bài viết liên quan</h2>
<style type="text/css">
  ul.post_relate li {
    list-style-type: disc;
    font-size: 16px;
    padding: 6px;
  }

  ul.post_relate li a {
    color: #000;
  }

  ul.post_relate li a:hover {
    color: #FE980F;
  }
</style>
<ul class="row post_relate">
  @foreach($related as $key => $p)
  <div class="col-xs-12 col-sm-6">
  <div class="single-products" style="margin:10px 0;padding: 5px">
          <div class="text-center">
                  <img style="float:left;width:30%;padding: 5px;height: 150px; object-fit: cover;" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" />
                  <h4 style="color:#000;padding: 5px;">{{$p->post_title}}</h4>
                  <p >{!!$p->post_desc!!}</p>
          </div>
          <div class="text-right">
                  <a  href="{{url('/bai-viet/'.$p->post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
          </div>
  </div>
  <div class="clearfix"></div>
  </div>
  @endforeach

</ul>

<!--/recommended_items-->
@endsection