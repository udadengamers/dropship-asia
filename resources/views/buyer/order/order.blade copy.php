<div class="buyer-transaction-body">
    <div class="title-transaction">
      <h3>My Order</h3><hr>

    </div>
    <ul class="nav nav-pills mb-3 menu-button-transaction-history" id="pills-tab" role="tablist" style=" display:flex;flex-wrap:nowrap;">
      <li class="nav-item ml-3" role="presentation">
        <button class="nav-link active " id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button" role="tab" aria-controls="pills-history" aria-selected="true"><i class="bi bi-journal"></i><span> All</span></button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false"><i class="fas fa-file-invoice-dollar"></i><span> Pending Payment</span></button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-sending-tab" data-bs-toggle="pill" data-bs-target="#pills-sending" type="button" role="tab" aria-controls="pills-sending" aria-selected="false"><i class="fas fa-truck-moving"></i><span> Shipping</span></button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="false"><i class="fas fa-clipboard-check"></i><span> Completed</span></button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      {{-- PAGE History --}}
      <div class="tab-pane fade show active" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">
        <?php $sum=0 ?>
        @foreach ($orders as $order)    
          <?php $sum+=1 ?>
          <a href="/my-transaction/detail/{{ $order->id }}">
            <div class="transaction-card-container">
              <div class="transaction-card">
      
                <div class="trans-card-header">
      
                  <div class="trans-head-left">
                    <div class="trans-logo">
                      <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                    <div class="trans-left-desc">
                      <h4>Shopping</h4>
                      <h5> {{ $order->order_date->format('d M Y') }}</h5>
                    </div>
                  </div>
      
                  <div class="trans-head-right">
                    <h4>{{ ($order->states[$order->state] ?? $order->state) }}</h4>
                  </div>
      
                </div>
                <hr>
      
                <div class="trans-card-body">
                  <div class="trans-body-desc">
                    <div class="trans-body-img">
                      {{-- @dd($order->order_items[0]->product->product_images[0]->path_file) --}}
                      <img src="{{ url('storage/'.$order->order_items[0]->product->product_images[0]->path_file) }}" alt="">
                    </div>
                    <div class="trans-body-product-desc">
                      <p> {{ (strlen($order->order_items[0]->product->name) > 30)? substr($order->order_items[0]->product->name,0,30)."..." : $order->order_items[0]->product->name }} - {{ $order->order_items[0]->stock_name }}</p>                 
                      <h5>{{ $order->order_items[0]->quantity }} Item</h5>
                    </div>
                  </div>
                  @if (sizeof($order->order_items)-1 != 0)
                    <div class="trans-total-item-info">
                        <h5>+{{ sizeof($order->order_items)-1 }} other product more..</h5>
                    </div>
                  @endif
                </div>
      
                <div class="trans-card-footer">
                  <div class="trans-footer-left">
                    <h5>Total Amount</h5>
                    <h4>${{ $order->total }},-</h4>
                  </div>
                  <div class="trans-footer-right">
                    @if (in_array($order->state,['created','payment_rejected']))
                      <div class="row">
                        <div class="col">
                          <form id="form-payment" action="{{ route('payment.show', $order->uuid) }}" method="get">
                              @csrf
                              <button type="submit" form="form-payment" class="transaction-history-button mr-2">Pay</button>
                          </form>
                        </div>
                        <div class="col">
                          <form action="{{ route('transaction.cancelled', $order->uuid) }}" method="post">
                              @method('put')
                              @csrf
                              <button type="submit" class="transaction-history-button">Cancel</button>
                          </form>
                        </div>
                      </div>
                    @endif
                    @if ($order->state == 'shipping')
                      <form action="{{ route('transaction.received', $order->uuid) }}" method="post">
                          @method('put')
                          @csrf
                          <button type="submit" class="btn btn-danger">Item received</button>
                      </form>
                    @endif
                  </div>
                </div>
      
              </div>
            </div>
          </a>
        @endforeach
        @if ($sum == 0)
            <div style="height:100px;display:flex;justify-content:center;align-items:center;">
              <p>You dont have an order yet</p>
            </div>
        @endif
      </div>
      {{-- PAGE Pending Payment --}}
      <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
        <?php $sum=0 ?>
        @foreach ($orders as $order)   
          @if (($order->states[$order->state] ?? $order->state) == "Awaiting Payment" || ($order->states[$order->state] ?? $order->state) == "Payment Submitted" || ($order->states[$order->state] ?? $order->state) == "Payment Approved")
          <?php $sum+=1 ?>  
            <a href="/my-transaction/detail/{{ $order->id }}">
              <div class="transaction-card-container">
                <div class="transaction-card">
        
                  <div class="trans-card-header">
        
                    <div class="trans-head-left">
                      <div class="trans-logo">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                      </div>
                      <div class="trans-left-desc">
                        <h4>Shopping</h4>
                        <h5> {{ $order->order_date->format('d M Y') }}</h5>
                      </div>
                    </div>
        
                    <div class="trans-head-right">
                      <h4>{{ ($order->states[$order->state] ?? $order->state) }}</h4>
                    </div>
        
                  </div>
                  <hr>
        
                  <div class="trans-card-body">
                    <div class="trans-body-desc">
                      <div class="trans-body-img">
                        {{-- @dd($order->order_items[0]->product->product_images[0]->path_file) --}}
                        <img src="{{ url('storage/'.$order->order_items[0]->product->product_images[0]->path_file) }}" alt="">
                      </div>
                      <div class="trans-body-product-desc">
                        <p> {{ (strlen($order->order_items[0]->product->name) > 30)? substr($order->order_items[0]->product->name,0,30)."..." : $order->order_items[0]->product->name }} - {{ $order->order_items[0]->stock_name }}</p>                 
                        <h5>{{ $order->order_items[0]->quantity }} Item</h5>
                      </div>
                    </div>
                    @if (sizeof($order->order_items)-1 != 0)
                      <div class="trans-total-item-info">
                          <h5>+{{ sizeof($order->order_items)-1 }} other product more..</h5>
                      </div>
                    @endif
                  </div>
        
                  <div class="trans-card-footer">
                    <div class="trans-footer-left">
                      <h5>Total Amount</h5>
                      <h4>${{ $order->total }},-</h4>
                    </div>
                    <div class="trans-footer-right">
                      @if (in_array($order->state,['created','payment_rejected']))
                        <div class="row">
                          <div class="col">
                            <form id="form-payment" action="{{ route('payment.show', $order->uuid) }}" method="get">
                                @csrf
                                <button type="submit" form="form-payment" class="transaction-history-button mr-2">Pay</button>
                            </form>
                          </div>
                          <div class="col">
                            <form action="{{ route('transaction.cancelled', $order->uuid) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="transaction-history-button">Cancel</button>
                            </form>
                          </div>
                        </div>
                      @endif
                      @if ($order->state == 'shipping')
                        <form action="{{ route('transaction.received', $order->uuid) }}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger">Item received</button>
                        </form>
                      @endif
                    </div>
                  </div>
        
                </div>
              </div>
            </a>
          @endif
        @endforeach
        @if ($sum == 0)
            <div style="height:100px;display:flex;justify-content:center;align-items:center;">
              <p>You dont have an order yet</p>
            </div>
        @endif
      </div>
      {{-- PAGE Sending --}}
      <div class="tab-pane fade" id="pills-sending" role="tabpanel" aria-labelledby="pills-sending-tab">
        <?php $sum=0 ?>
        @foreach ($orders as $order)   
          @if (($order->states[$order->state] ?? $order->state) == "Preparing for Shipment" || ($order->states[$order->state] ?? $order->state) == "Shipped")
          <?php $sum+=1 ?>
            <a href="/my-transaction/detail/{{ $order->id }}">
              <div class="transaction-card-container">
                <div class="transaction-card">
        
                  <div class="trans-card-header">
        
                    <div class="trans-head-left">
                      <div class="trans-logo">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                      </div>
                      <div class="trans-left-desc">
                        <h4>Shopping</h4>
                        <h5> {{ $order->order_date->format('d M Y') }}</h5>
                      </div>
                    </div>
        
                    <div class="trans-head-right">
                      <h4>{{ ($order->states[$order->state] ?? $order->state) }}</h4>
                    </div>
        
                  </div>
                  <hr>
        
                  <div class="trans-card-body">
                    <div class="trans-body-desc">
                      <div class="trans-body-img">
                        {{-- @dd($order->order_items[0]->product->product_images[0]->path_file) --}}
                        <img src="{{ url('storage/'.$order->order_items[0]->product->product_images[0]->path_file) }}" alt="">
                      </div>
                      <div class="trans-body-product-desc">
                        <p> {{ (strlen($order->order_items[0]->product->name) > 30)? substr($order->order_items[0]->product->name,0,30)."..." : $order->order_items[0]->product->name }} - {{ $order->order_items[0]->stock_name }}</p>                 
                        <h5>{{ $order->order_items[0]->quantity }} Item</h5>
                      </div>
                    </div>
                    @if (sizeof($order->order_items)-1 != 0)
                      <div class="trans-total-item-info">
                          <h5>+{{ sizeof($order->order_items)-1 }} other product more..</h5>
                      </div>
                    @endif
                  </div>
        
                  <div class="trans-card-footer">
                    <div class="trans-footer-left">
                      <h5>Total Amount</h5>
                      <h4>${{ $order->total }},-</h4>
                    </div>
                    <div class="trans-footer-right">
                      @if (in_array($order->state,['created','payment_rejected']))
                        <div class="row">
                          <div class="col">
                            <form id="form-payment" action="{{ route('payment.show', $order->uuid) }}" method="get">
                                @csrf
                                <button type="submit" form="form-payment" class="transaction-history-button mr-2">Pay</button>
                            </form>
                          </div>
                          <div class="col">
                            <form action="{{ route('transaction.cancelled', $order->uuid) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="transaction-history-button">Cancel</button>
                            </form>
                          </div>
                        </div>
                      @endif
                      @if ($order->state == 'shipping')
                        <form action="{{ route('transaction.received', $order->uuid) }}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger">Item received</button>
                        </form>
                      @endif
                    </div>
                  </div>
        
                </div>
              </div>
            </a>
              
          @endif
        @endforeach
        @if ($sum == 0)
            <div style="height:100px;display:flex;justify-content:center;align-items:center;">
              <p>You dont have an shipping order yet</p>
            </div>
        @endif
      </div>
      {{-- PAGE Completed --}}
      <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab">
        <?php $sum=0 ?>
        @foreach ($orders as $order)   
          @if (($order->states[$order->state] ?? $order->state) == "Delivered" || ($order->states[$order->state] ?? $order->state) == "Completed")
          <?php $sum+=1 ?>
          <a href="/my-transaction/detail/{{ $order->id }}">
              <div class="transaction-card-container">
                <div class="transaction-card">
        
                  <div class="trans-card-header">
        
                    <div class="trans-head-left">
                      <div class="trans-logo">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                      </div>
                      <div class="trans-left-desc">
                        <h4>Shopping</h4>
                        <h5> {{ $order->order_date->format('d M Y') }}</h5>
                      </div>
                    </div>
        
                    <div class="trans-head-right">
                      <h4>{{ ($order->states[$order->state] ?? $order->state) }}</h4>
                    </div>
        
                  </div>
                  <hr>
        
                  <div class="trans-card-body">
                    <div class="trans-body-desc">
                      <div class="trans-body-img">
                        {{-- @dd($order->order_items[0]->product->product_images[0]->path_file) --}}
                        <img src="{{ url('storage/'.$order->order_items[0]->product->product_images[0]->path_file) }}" alt="">
                      </div>
                      <div class="trans-body-product-desc">
                        <p> {{ (strlen($order->order_items[0]->product->name) > 30)? substr($order->order_items[0]->product->name,0,30)."..." : $order->order_items[0]->product->name }} - {{ $order->order_items[0]->stock_name }}</p>                 
                        <h5>{{ $order->order_items[0]->quantity }} Item</h5>
                      </div>
                    </div>
                    @if (sizeof($order->order_items)-1 != 0)
                      <div class="trans-total-item-info">
                          <h5>+{{ sizeof($order->order_items)-1 }} other product more..</h5>
                      </div>
                    @endif
                  </div>
        
                  <div class="trans-card-footer">
                    <div class="trans-footer-left">
                      <h5>Total Amount</h5>
                      <h4>${{ $order->total }},-</h4>
                    </div>
                    <div class="trans-footer-right">
                      @if (in_array($order->state,['created','payment_rejected']))
                        <div class="row">
                          <div class="col">
                            <form id="form-payment" action="{{ route('payment.show', $order->uuid) }}" method="get">
                                @csrf
                                <button type="submit" form="form-payment" class="transaction-history-button mr-2">Pay</button>
                            </form>
                          </div>
                          <div class="col">
                            <form action="{{ route('transaction.cancelled', $order->uuid) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="transaction-history-button">Cancel</button>
                            </form>
                          </div>
                        </div>
                      @endif
                      @if ($order->state == 'shipping')
                        <form action="{{ route('transaction.received', $order->uuid) }}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger">Item received</button>
                        </form>
                      @endif
                    </div>
                  </div>
        
                </div>
              </div>
            </a>              
          @endif 
        @endforeach
        @if ($sum == 0)
            <div style="height:100px;display:flex;justify-content:center;align-items:center;">
              <p>You dont have an order completed yet</p>
            </div>
        @endif
      </div>
    </div>
   
</div>