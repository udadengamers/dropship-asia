<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create User</h1>
    </div>
    <section class="card">
        <div class="card-body">
            <form action="{{ route('administrator.user.store') }}" method="post">
                @csrf
                @include('administrator.user.parts.form', $user)
                <button class="btn btn-success" type="submit">Create</button>
            </form>
        </div>
    </section>
</x-admin.auth-layout>
