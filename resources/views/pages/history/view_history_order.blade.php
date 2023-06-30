@extends('layout')
@section('content')
<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>

    <div class="table-responsive">
      <?php
      $message = Session()->get('message');
      if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session()->put('message', null);
      }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>


            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>

          </tr>

        </tbody>
      </table>

    </div>

  </div>
</div>
<br>
<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">
      <?php
      $message = Session()->get('message');
      if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session()->put('message', null);
      }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}, {{$wards_name ? $wards_name : 'Xã'}}, {{$province_name ? $province_name : "Huyện"}}, {{$city_name ? $city_name : "Tỉnh"}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>

<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng mã <b>{{$order_code}}</b>
    </div>

    <div class="table-responsive">
      <?php
      $message = Session()->get('message');
      if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session()->put('message', null);
      }
      ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th></th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          $total = 0;
          @endphp
          @foreach($order_details as $key => $details)

          @php
          $i++;
          $subtotal = $details->product_price*$details->product_sales_quantity;
          $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>

            <td>

              <input style="width: 30px; height: 100%; text-align: center;" type="text" min="1" readonly {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">



            </td>
            <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="2">
              Mã giảm giá: @if($details->product_coupon!='no')
                {{$details->product_coupon}}
                @else
                Không mã
                @endif
              </br>
              @php
              $total_coupon = 0;
              @endphp
              @if($coupon_condition==1)
              @php
              $total_after_coupon = ($total*$coupon_number)/100;
              echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').'</br>';
              $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
              @endphp
              @else
              @php
              echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').'đ'.'</br>';
              $total_coupon = $total + $details->product_feeship - $coupon_number ;

              @endphp
              @endif

              Phí ship: {{number_format($details->product_feeship,0,',','.')}}đ</br>
              Thanh toán: {{number_format($total_coupon,0,',','.')}}đ

            </td>
          </tr>

        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>

  </div>
</div>
@endsection