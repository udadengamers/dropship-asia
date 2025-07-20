<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Topup</h1>
    </div>
    <div class="mb-3">
        <a href="{{ route('administrator.topup.index') }}" class="btn btn-primary {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
        <a href="{{ route('administrator.topup.index', ['tab' => 'in_review']) }}" class="btn btn-primary {{ request()->get('tab') == 'in_review' ? 'active' : '' }}" role="button" aria-pressed="true">In Review</a>
        <a href="{{ route('administrator.topup.index', ['tab' => 'approved']) }}" class="btn btn-primary {{ request()->get('tab') == 'approved' ? 'active' : '' }}" role="button" aria-pressed="true">Approved</a>
        <a href="{{ route('administrator.topup.index', ['tab' => 'rejected']) }}" class="btn btn-primary {{ request()->get('tab') == 'rejected' ? 'active' : '' }}" role="button" aria-pressed="true">Rejected</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Topups</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Created Date</th>
                                    <th>Topup Code</th>
                                    <th>User</th>
                                    <th>Amount</th>
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
                    ajax: "{{ route('administrator.topup.index', ['tab' => request()->get('tab')]) }}",
                    columns: [
                        {data: 'created_at', name: 'created_at'},
                        {data: 'trx_code', name: 'trx_code'},
                        {data: 'user_name', name: 'user_name'},
                        {data: 'amount_submitted', name: 'amount_submitted'},
                        {data: 'state', name: 'state'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        </script>
    @endpush
</x-admin.auth-layout>