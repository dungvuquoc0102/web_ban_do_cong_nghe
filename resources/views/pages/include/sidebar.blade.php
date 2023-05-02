 <div class="col-sm-3">
     <div class="left-sidebar">
        <h2>@lang('lang.danhmuc')</h2>
        <!--category-products-->
        <!-- dungvq: bootstrap  -->
        <div class="panel-group category-products" id="accordian">
            @foreach($category as $key => $cate)
                @if($cate->category_parent == 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                    @foreach($category as $key => $cate_sub)
                                        @if($cate_sub->category_parent==$cate->category_id)
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        @break
                                        @endif
                                    @endforeach
                                    {{$cate->category_name}}
                                </a>
                            </h4>
                        </div>
                        <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @foreach($category as $key => $cate_sub)
                                    @if($cate_sub->category_parent==$cate->category_id)
                                    <li><a href="{{URL::to('/danh-muc/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!--brands_products-->
        <div class="brands_products">
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $brand)
                    <li><a href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}">{{$brand->brand_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- product visited  -->
        <div class="brands_products">
            <h2>Sản phẩm đã xem</h2>
            <div class="brands-name ">
                <div id="row_viewed" class="row" style="margin: 0;">
                </div>
            </div>
        </div>
     </div>
 </div>