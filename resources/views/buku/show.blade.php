
@extends('layouts.app')

@section('title', 'Detail Buku — BookStore')

@section('content')
<div class="container mt-4">

    <!-- Detail Buku -->
    <div class="row">

        <!-- Gambar Sampul Buku -->
        <div class="col-md-4">
            @if ($buku->cover)
                <img
                    src="{{ asset('storage/' . $buku->cover) }}"
                    alt="{{ $buku->title }}"
                    class="img-fluid rounded shadow-sm"
                >
            @else
                <div
                    class="bg-light d-flex align-items-center justify-content-center rounded border"
                    style="height: 300px;"
                >
                    <span class="text-muted">
                        Tidak Ada Sampul
                    </span>
                </div>
            @endif
        </div>

        <!-- Informasi Buku -->
        <div class="col-md-8">

            <!-- Kategori -->
            <span class="badge bg-secondary mb-2">
                {{ $buku->category?->name ?? 'Belum ada kategori' }}
            </span>

            <!-- Judul Buku -->
            <h1>{{ $buku->title ?? 'Judul Belum Diisi' }}</h1>

            <!-- Nama Penulis Lama -->
            <p class="text-muted mb-1">
                Penulis: {{ $buku->author_name ?? '-' }}
            </p>

            <!-- Penulis Terdaftar (FITUR BARU) -->
            <p class="text-muted mb-1">
                Penulis Terdaftar:
                {{ $buku->author?->name ?? 'Belum dipilih' }}
            </p>

            <!-- Penerbit -->
            <p class="text-muted mb-1">
                Penerbit:
                {{ $buku->publisher?->name ?? 'Belum diisi' }}
            </p>

            <!-- Tahun Terbit -->
            @if ($buku->published_year)
                <p class="text-muted mb-1">
                    Tahun Terbit: {{ $buku->published_year }}
                </p>
            @endif

            <!-- Harga Buku -->
            <p class="harga-buku fs-4 fw-bold text-primary my-3">
                Rp{{ number_format($buku->price ?? 0, 0, ',', '.') }}
            </p>

            <!-- Informasi Stok Buku -->
            @if ($buku->stock > 0)
                <p class="mb-3">
                    <span class="badge bg-success">
                        Stok tersedia: {{ $buku->stock }}
                    </span>
                </p>
            @else
                <p class="mb-3">
                    <span class="badge bg-danger">
                        Stok habis
                    </span>
                </p>
            @endif

            <!-- Tombol Ubah Buku -->
            <a
                href="{{ route('buku.edit', $buku->id) }}"
                class="btn btn-warning me-2"
            >
                Ubah Buku
            </a>

            <!-- Tombol Kembali -->
            <a
                href="{{ route('buku.index') }}"
                class="btn btn-outline-secondary"
            >
                &larr; Kembali ke daftar buku
            </a>

        </div>
    </div>

    <!-- Buku Lain dalam Kategori yang Sama -->
    @if ($bukuSerupa->isNotEmpty())

        <div class="mt-5">

            <h2 class="h5 mb-3">
                Buku lain di kategori
                {{ $buku->category?->name ?? 'Tidak diketahui' }}
            </h2>

            <ul class="list-unstyled">

                @foreach ($bukuSerupa as $serupa)

                    <li class="mb-2">

                        <a href="{{ route('buku.show', $serupa->id) }}">
                            {{ $serupa->title }}
                        </a>

                        <span class="text-muted">
                            — {{ $serupa->author_name }}
                        </span>

                    </li>

                @endforeach

            </ul>

        </div>

    @endif

</div>
@endsection
