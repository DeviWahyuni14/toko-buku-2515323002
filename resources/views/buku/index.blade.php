
@extends('layouts.app')

@section('content')

<div class="container my-5">

    {{-- Judul dan Tombol Tambah Buku --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Daftar Buku</h2>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Pencarian dan Filter --}}
    <form action="{{ route('buku.index') }}"
          method="GET"
          class="row g-2 mb-4">

        <div class="col-md-4">
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Cari judul atau penulis"
                value="{{ $kataKunci }}"
            >
        </div>

        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>

                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        @selected($kategoriId == $kategori->id)>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="penerbit" class="form-select">
                <option value="">Semua penerbit</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        @selected($penerbitId == $penerbit->id)>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            @if ($kataKunci || $kategoriId || $penerbitId)
                <a href="{{ route('buku.index') }}"
                   class="btn btn-outline-secondary">
                    Reset
                </a>
            @endif
        </div>

    </form>

    {{-- Daftar Buku --}}
    @if ($daftarBuku->isEmpty())

        <div class="alert alert-info">
            Tidak ada buku yang cocok.
        </div>

    @else

        <p class="text-muted">
            Menampilkan buku {{ $daftarBuku->firstItem() }}
            sampai {{ $daftarBuku->lastItem() }}
            dari {{ $daftarBuku->total() }} buku.
        </p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

            @foreach ($daftarBuku as $buku)

                @php
                    // Gambar bawaan untuk masing-masing buku lama
                    $gambarBawaan = [
                        'Belajar PHP dari Nol' => 'buku1.png',
                        'Dasar Pemrograman Berorientasi Objek' => 'pbo.png',
                        'Tentang Kamu' => 'tentang_kamu.png',
                        'Laut Bercerita' => 'bercerita_karya.png',
                        'Strategi Keuangan untuk Pemula' => 'keuangan_untuk_pemula.png',
                        'Membaca Laporan Keuangan Sederhana' => 'keuangan_sederhana.png',
                        'Bahasa Indonesia' => 'Indonesia.png',
                        'Bahasa Inggris Untuk Pemula' => 'Inggris.png',
                        'Melukis senja' => 'melukis.png',
                    ];

                    // Prioritaskan sampul hasil upload
                    if ($buku->cover) {
                        $gambarBuku = asset('storage/' . $buku->cover);
                    } else {
                        $namaGambar = $gambarBawaan[$buku->title]
                            ?? 'sampul-placeholder.png';

                        $gambarBuku = asset('images/' . $namaGambar);
                    }
                @endphp

                <div class="col">

                    <div class="card h-100 shadow-sm border-0">

                        {{-- Sampul Buku --}}
                        <div class="bg-white d-flex align-items-center justify-content-center p-3 rounded-top"
                             style="height: 350px;">

                            <img
                                src="{{ $gambarBuku }}"
                                class="img-fluid"
                                alt="Sampul {{ $buku->title }}"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;"
                            >

                        </div>

                        {{-- Informasi Buku --}}
                        <div class="card-body d-flex flex-column bg-white">

                            <div>
                                <span class="badge bg-secondary mb-2">
                                    {{ $buku->category?->name ?? 'Belum ada kategori' }}
                                </span>

                                <h5 class="card-title fw-semibold mb-1">
                                    {{ $buku->title }}
                                </h5>

                                <p class="text-muted small mb-2">
                                    {{ $buku->author_name }}
                                </p>

                                <p class="text-muted small mb-2">
                                    Penerbit:
                                    {{ $buku->publisher?->name ?? 'Belum diisi' }}
                                </p>
                            </div>

                            <div class="mt-auto pt-2">

                                {{-- Harga --}}
                                <p class="fw-bold text-primary fs-5 mb-2">
                                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                                </p>

                                {{-- Stok --}}
                                @if ($buku->stock > 0)
                                    <p class="small mb-3">
                                        Stok: {{ $buku->stock }}
                                    </p>
                                @else
                                    <p class="mb-3">
                                        <span class="badge bg-danger">
                                            Stok habis
                                        </span>
                                    </p>
                                @endif

                                {{-- Tombol Aksi --}}
                                <div class="d-grid gap-2">

                                    <a href="{{ route('buku.show', $buku->id) }}"
                                       class="btn btn-primary">
                                        Lihat Detail
                                    </a>

                                    <div class="d-flex gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('buku.edit', $buku->id) }}"
                                           class="btn btn-warning w-50">
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <form
                                            action="{{ route('buku.destroy', $buku->id) }}"
                                            method="POST"
                                            class="w-50"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger w-100">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $daftarBuku->links() }}
        </div>

    @endif

</div>

@endsection
