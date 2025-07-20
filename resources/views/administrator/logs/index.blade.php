<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Logs</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Logs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Basename</th>
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
                    ajax: "{{ route('administrator.logs.index', ['tab' => request()->get('tab')]) }}",
                    columns: [
                        {data: 'filename', name: 'filename'},
                        {data: 'basename', name: 'basename'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        </script>
    @endpush
</x-admin.auth-layout>