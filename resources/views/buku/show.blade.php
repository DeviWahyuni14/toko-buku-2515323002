@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @if ($buku->cover)
                <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->title }}" class="img-fluid rounded shadow-sm">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded border" style="height: 300px;">
                    <span class="text-muted">Tidak Ada Sampul</span>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <span class="badge bg-secondary mb-2">{{ $buku->category?->name ?? 'Belum ada kategori' }}</span>
            <h1>{{ $buku->title ?? 'Judul Belum Diisi' }}</h1>
            <p class="text-muted mb-1">Penulis: {{ $buku->author_name ?? '-' }}</p>
            <p class="text-muted mb-1">Penerbit: {{ $buku->publisher?->name ?? 'belum diisi' }}</p>

            {{-- Bagian Menampilkan Tahun Terbit --}}
            @if ($buku->published_year)
                <p class="text-muted mb-1">Tahun terbit: {{ $buku->published_year }}</p>
            @endif

            <p class="harga-buku fs-4 fw-bold text-primary my-3">Rp{{ number_format($buku->price ?? 0, 0, ',', '.') }}</p>
            
            <a href="{{ url('/buku/' . $buku->id . '/edit') }}" class="btn btn-warning me-2">Ubah Buku</a>
            <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">&larr; Kembali ke daftar buku</a>
        </div>
    </div>
</div>
@endsection