@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <a href="{{ url('/delete-all-product') }}"><button style="margin: 5px; visibility: hidden;" type="button" class="btn btn-danger delAllProducts">Xóa tất cả</button></a>
    <div class="table-responsive">
      <?php
      $message = Session()->get('message');
      if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session()->put('message', null);
      }
      ?>
      <table class="table table-striped b-t b-light" id="myTable1">
        <thead>
          <tr>
            <th style="width:20px;">
              <!-- <label class="i-checks m-b-none"> -->
                <input type="checkbox" class="selectAll" name="selectAll" value="all"><i></i>
              <!-- </label> -->
            </th>
            <th></th>
            <th>Tên sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Số lượng</th>
            <th>Giá bán</th>
            <th>Giá gốc</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <th>Thao tác</th>
            <!-- <th style="width:30px;"></th> -->
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td></td>

            <td><img src="public/uploads/product/{{ $pro->product_image }}" height="50" width="50"></td>
            <td style="font-weight: bold; color: #000;">{{ $pro->product_name }}</td>
            <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Sửa ảnh</a></td>
            <td>{{ $pro->product_quantity }}</td>
            <td>₫{{ number_format($pro->product_price,0,',','.') }}</td>
            <td>₫{{ number_format($pro->price_cost,0,',','.') }}</td>
            <td>{{ $pro->category_name }}</td>
            <td>{{ $pro->brand_name }}</td>
            <td>
              <span class="text-ellipsis">
                <?php
                if ($pro->product_status == 1) {
                ?>
                  <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                } else {
                ?>
                  <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span>
            </td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection