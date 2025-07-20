<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin</h1>
        <a href="{{ route('administrator.admin.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New Admin</a>
    </div>

    <div class="mb-3">
        <a href="{{ route('administrator.admin.index') }}" class="btn btn-primary {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
        <a href="{{ route('administrator.admin.index', ['tab' => 'active']) }}" class="btn btn-primary {{ request()->get('tab') == 'active' ? 'active' : '' }}" role="button" aria-pressed="true">Active</a>
        <a href="{{ route('administrator.admin.index', ['tab' => 'inactive']) }}" class="btn btn-primary {{ request()->get('tab') == 'inactive' ? 'active' : '' }}" role="button" aria-pressed="true">Inactive</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Admins</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
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
                    ajax: "{{ route('administrator.admin.index', ['tab' => request()->get('tab')]) }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        </script>
    @endpush
</x-admin.auth-layout>