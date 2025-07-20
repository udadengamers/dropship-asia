<link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
<div class="buyer-transaction-body">
    <div class="title-transaction">
      <h3>My Order</h3><hr>
    </div>
    <ul class="nav nav-pills mb-3 menu-button-transaction-history" id="pills-tab" role="tablist" style=" display:flex;flex-wrap:nowrap;justify-content:space-between;">
      <li class="nav-item" >
        <a href="?" class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }} "  aria-controls="pills-history"><i class="bi bi-journal"></i><span> All</span></a>
      </li>
      <li class="nav-item" >
        <a href="?tab=payment" class="nav-link {{ in_array(request()->get('tab'),["payment"]) ? 'active' : '' }}"  aria-controls="pills-payment"><i class="fas fa-file-invoice-dollar"></i><span> Payment</span></a>
      </li>
      <li class="nav-item" >
        <a href="?tab=shipping" class="nav-link {{ in_array(request()->get('tab'),["shipping"]) ? 'active' : '' }}"  aria-controls="pills-sending"><i class="fas fa-truck-moving"></i><span> Shipping</span></a>
      </li>
      <li class="nav-item" >
        <a href="?tab=completed" class="nav-link {{ in_array(request()->get('tab'),["completed"]) ? 'active' : '' }}"  aria-controls="pills-completed"><i class="fas fa-clipboard-check"></i><span> Completed</span></a>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      {{-- PAGE History --}}
      <div id="itemLoad" class="tab-pane fade show active" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">
        
        @if ($orders->count())
          @include('buyer.order.item-order')
        @else
          <h4>No Order History</h4>
        @endif
      </div>
      <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
        <p>
            <img class="img-fluid" src="/img/spin.gif" width="50">
        </p>
      </div>
    </div>
   
</div>
<script src="{{ mix('js/scroll.js') }}"></script>