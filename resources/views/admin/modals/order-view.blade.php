<div id="page">
    <div class="modal-header">
        <h3 class="modal-title">Order Details - {{$order->order_code}}</h3>
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    </div>
    <div class="modal-body">
       <!-- content goes here -->
       <h2 class="heading-md"></h2>
               <div class="row">
               <div class="col-md-12">
                 <div class="row">
                         <label class="col-md-5 control-label">Order ID:</label>
                         <div class="col-md-7">{{$order->order_code}}</div>
                 </div>

                 <div class="row">
                         <label class="col-md-5 control-label">Total Amount ({{$comm->currency}}):</label>
                         <div class="col-md-7">{{number_format($order->total_amount,2)}}</div>
                 </div>
                 <div class="row">
                         <label class="col-md-5 control-label">Payment Status:</label>
                         @if($order->payment_status==SUCCESSFUL)
                         <div class="col-md-7"><span style="color: green">Successful</span></div>
                         @else
                         <div class="col-md-7"><span style="color: red">Unsuccessful</span></div>
                         @endif
                 </div>
                 <div class="row">
                    <label class="col-md-5 control-label">Transaction Reference:</label>
                    <div class="col-md-7">{{$ref->transaction_id}}</div>
                 </div>
                 <div class="row">
                    <label class="col-md-5 control-label">Order Status:</label>
                    @if($order->status==PROCESSED)
                    <div class="col-md-7"><span style="color: blue">Processed</span></div>
                    @else
                    <div class="col-md-7"><span style="color: orange">processing</span></div>
                    @endif
                </div>

                 <br>
                <h5>Ordered Product</h5>
                <p></p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price ({{$comm->currency}})</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $od)
                    <tr>
                        <td><img src="{{asset('images/products/'.$od->product->image)}}" style="max-height: 50px; max-width: 50px"></td>
                        <td>{{$od->product->pname}}</td>
                        <td>{{number_format($od->product->price)}}</td>
                        <td>{{$od->quantity}}</td>
                        <td>{{number_format($od->total,2)}}</td>
                    </tr>
                    @endforeach
                   </tbody>
                </table>
                <div class="row">
                <div class="col-md-8 col-sm-8 col-12"></div>
                <div class="col-md-4 col-sm-4 col-12">
                <div class="shop-cart-info-price clearfix">
                    <ul class="right-info-price">
                        <p>Total Price: {{$comm->currency}}{{number_format($order->total_amount)}}</p>
                        <p>Vat 0%: </p>
                        <div class="total-price">
                            <p>Total: <strong>{{$comm->currency}}{{number_format($order->total_amount,2)}}</strong></p>
                        </div>
                    </ul>

                </div>
                </div>
                </div>

             </div>
             </div>


         <br/>
          <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12 margin-bottom-20 margin-top-20">
          </div>

    </div>
</div>

