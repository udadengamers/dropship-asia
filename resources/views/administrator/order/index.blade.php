<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order</h1>
    </div>

    <div class="mb-3">
        <a href="{{ route('administrator.order.index') }}" class="btn btn-primary {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'pending_payment']) }}" class="btn btn-primary {{ request()->get('tab') == 'pending_payment' ? 'active' : '' }}" role="button" aria-pressed="true">Pending Payment</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'payment_submitted']) }}" class="btn btn-primary {{ request()->get('tab') == 'payment_submitted' ? 'active' : '' }}" role="button" aria-pressed="true">Submitted Payment</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'approved_payment']) }}" class="btn btn-primary {{ request()->get('tab') == 'approved_payment' ? 'active' : '' }}" role="button" aria-pressed="true">Approved Payment</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'seller_response']) }}" class="btn btn-primary {{ request()->get('tab') == 'seller_response' ? 'active' : '' }}" role="button" aria-pressed="true">Seller Response</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'shipped']) }}" class="btn btn-primary {{ request()->get('tab') == 'shipped' ? 'active' : '' }}" role="button" aria-pressed="true">Shipped</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'cancelled']) }}" class="btn btn-primary {{ request()->get('tab') == 'cancelled' ? 'active' : '' }}" role="button" aria-pressed="true">Cancelled</a>
        <a href="{{ route('administrator.order.index', ['tab' => 'received']) }}" class="btn btn-primary {{ request()->get('tab') == 'received' ? 'active' : '' }}" role="button" aria-pressed="true">Received</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Transaction Code</th>
                                    <th>Buyer Contact</th>
                                    <th>Shop Contact</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script type="text/javascript">
            $(function () {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('administrator.order.index', ['tab' => request()->get('tab')]) }}",
                    columns: [
                        {data: 'order_date', name: 'order_date'},
                        {data: 'trx_code', name: 'trx_code'},
                        {data: 'user_name', name: 'user_name'},
                        {data: 'shop.name', name: 'shop.name'},
                        {data: 'total', name: 'total'},
                        {data: 'state', name: 'state'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        </script>
    @endpush
</x-admin.auth-layout>