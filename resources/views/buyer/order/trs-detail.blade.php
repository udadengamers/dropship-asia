@extends('layouts.main')
@section('bodyDR')

  <section class="h-100 h-custom mb-5" >
    <div class="container h-100 pt-3" style="padding-bottom: 50px;">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card shopping-cart" style="border-radius: 15px;">
            <div class="card-body text-black">
              <div class="row">
                <div class="col order-detail-prd" >  
                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Transaction Detail</h3>
                    <?php 
                        $total_price=0;
                        $total_qty=0;
                     ?>    
                    @foreach ($order_items as $ortem)

                        <div class="d-flex align-items-center mb-5">
                            <div class="flex-shrink-0">
                              <img src="{{ url('storage/'.$ortem->product->product_images[0]->path_file) }}" class="img-fluid" style="width: 150px;" alt="Generic placeholder image">
                            </div>
                            <div class="order-detail-desc-prod" >            
                              <h5 class="">{{ $ortem->product->name }}</h5>
                              <h6 style="color: #9e9e9e;">{{ $ortem->stock_name }}</h6>
                              <h6>{{ $ortem->quantity }} pcs</h6>
                              <div class="d-flex align-items-center">
                                  <p class="fw-bold mb-0 me-5 pe-3">${{  floatval($ortem->stock_price*$ortem->quantity)  }}</p>
                              </div>
                            </div>
                        </div> 
                        <?php 
                            $total_price += floatval($ortem->stock_price*$ortem->quantity) ;
                            $total_qty += $ortem->quantity ;
                        ?>
                        
                    @endforeach  

                  
  
                </div>
                <div class="col-lg-6 px-5 py-4">
  
                  <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Summary</h3>

                    <hr class="mb-4" style="height: 2px; background-color: orangered; opacity: 1;">
                    <div class="d-flex justify-content-between px-x">
                      <p class="fw-bold">Shop Seller:</p>
                      <p class="fw-bold">{{ $order_items[0]->order->shop->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between px-x">
                        <p class="fw-bold">Address:</p>
                    </div>
                    <div class="d-flex justify-content-between px-x">
                        <textarea style="width: 100%;height:40px;border:none;resize:none;" id="" cols="30" rows="10" placeholder="{{ auth()->user()->buyer_detail->address_one }}"></textarea>
                    </div>
                    <div class="d-flex justify-content-between px-x">
                        <p class="fw-bold">Quantity:</p>
                        <p class="fw-bold">{{ $total_qty }} pcs</p>
                    </div>
                    <div class="d-flex justify-content-between px-x">
                        <p class="fw-bold">Shipment:</p>
                        <p class="fw-bold">${{ $order_items[0]->order->shipment->price }} </p>
                    </div>
                    <div class="d-flex justify-content-between px-x">
                        <p class="fw-bold">Sub Total:</p>
                        <p class="fw-bold">${{ $total_price }} </p>
                    </div>
                    <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                        <h5 class="fw-bold mb-0">Total:</h5>
                        <h5 class="fw-bold mb-0">${{ $total_price+$order_items[0]->order->shipment->price }} </h5>
                    </div>
                    <div class="" style="display: flex;justify-content:center;flex-direction:column;flex-wrap:wrap;">
                      @if (in_array($order_items[0]->order->state,['created','payment_rejected']))
                        <div class="m-1">
                            <form id="form-payment" action="{{ route('payment.show', $order_items[0]->order->uuid) }}" method="get">
                                @csrf
                                <button type="submit" form="form-payment" class="transaction-history-button mr-2" style="width: 100%;">Pay</button>
                            </form>
                        </div>
                        <div class="m-1">
                            <form action="{{ route('transaction.cancelled', $order_items[0]->order->uuid) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="transaction-history-button" style="width: 100%;">Cancel</button>
                            </form>
                        </div>                        
                      @endif
                      @if ($order_items[0]->order->state == 'shipping')
                        <form action="{{ route('transaction.received', $order_items[0]->order->uuid) }}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger" style="width: 100%;">Item received</button>
                        </form>
                      @endif

                    </div>

                    <div class="d-flex justify-content-between px-x" style="">
                        <a href="/" style="text-decoration: none;color: orangered"><i class="fas fa-angle-left me-2 mt-5"></i>Back to home</a>
                    </div>
  
                </div>
              </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection