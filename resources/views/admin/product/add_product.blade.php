@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
                <?php
                $message = Session()->get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session()->put('message',null);
                }
                ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min10 max20" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control " id="slug" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug();"> 
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá bán</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Giá trị phải ít nhất 1,000" name="product_price" class="form-control price_format" id="" placeholder="Giá bán">
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Giá gốc</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Giá trị phải ít nhất 1,000" name="price_cost" class="form-control price_format" id="" placeholder="Giá gốc">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh bìa</label>
                            <input required type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài liệu</label>
                            <input type="file" name="document" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea required style="resize: none"  rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea required style="resize: none" rows="8" class="form-control" name="product_content"  id="my-editor" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    @if($cate->category_parent==0)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @foreach($cate_product as $key => $cate_sub)
                                            @if($cate_sub->category_parent!=0 && $cate_sub->category_parent==$cate->category_id)
                                            <option value="{{$cate_sub->category_id}}">--- {{$cate_sub->category_name}}</option>   
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tags sản phẩm</label>
                            <input type="text" data-role="tagsinput" name="product_tags" class="form-control">
                        </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection