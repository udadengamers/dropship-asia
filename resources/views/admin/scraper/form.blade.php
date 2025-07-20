@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Scrape Product</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.scrape.submit') }}">
        @csrf
        <input type="url" name="url" placeholder="Enter product URL" required style="width: 100%; padding: 8px;">
        <br><br>
        <button type="submit" style="padding: 10px 20px;">Scrape Product</button>
    </form>
</div>
@endsection
