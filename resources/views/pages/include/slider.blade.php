<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators" style="margin: 0 auto;">
                        @foreach($slider as $key => $value)
                                <li data-target="#slider-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <style type="text/css">
                        img.img.img-responsive.img-slider {
                            height: 350px;
                            width: 100%;
                            object-fit: cover;
                        }
                    </style>
                    <div class="carousel-inner">
                        @foreach($slider as $key => $slide)
                            <div class="item {{$key == 0 ? 'active' : '' }}">
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" class="img img-responsive img-slider" style="height: 480px;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/slider-->