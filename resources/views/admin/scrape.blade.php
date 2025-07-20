@extends('layouts.admin') {{-- atau layout admin panel kamu --}}

@section('content')
    <h2>Scrape Produk</h2>
    <form action="{{ route('admin.scrape.perform') }}" method="POST">
        @csrf
        <input type="text" name="url" placeholder="Masukkan URL produk" style="width: 300px;" required>
        <button type="submit">Scrape</button>
    </form>

    @isset($data)
        <hr>
        <h4>Hasil Scrape:</h4>
        <pre>{{ print_r($data, true) }}</pre>
    @endisset
@endsection
