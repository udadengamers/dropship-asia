<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Seller</h1>
    </div>
    <section class="card">
        <div class="card-body">
            <form action="{{ route('administrator.seller.store') }}" method="post">
                @csrf
                @include('administrator.seller.parts.form', $seller)
                <button class="btn btn-success" type="submit">Create</button>
            </form>
        </div>
    </section>
    @push('after-scripts')
        <script>
            $('button[type="submit"]').click(function() {
                var valid_tab_home = true;
                input = $('#home input');
                $.each(input, function(index, item) {
                    if (item.value == '' && item.type != 'hidden' && item.type != 'radio') {
                        valid_tab_home = false;
                    }
                });
                if (valid_tab_home) {
                    $('button[data-bs-target="#profile"]').tab('show');
                }
            });
        </script>
    @endpush
</x-admin.auth-layout>
