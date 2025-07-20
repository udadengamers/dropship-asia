<x-seller.auth-layout>
    {{-- title --}}
    @section('title', 'Banned Page')

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hallo {{ auth()->user()->shop->name }}!</strong> Your store has been banned because violate platform rules.
    </div>
    
</x-seller.auth-layout>
