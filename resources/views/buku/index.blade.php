
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku — BookStore</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">

    <!-- Judul dan Tombol Tambah Buku -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Daftar Buku</h2>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    <!-- Form Pencarian dan Filter -->
    <form action="{{ route('buku.index') }}" method="GET" class="row g-2 mb-4">

        <!-- Pencarian Judul atau Penulis -->
        <div class="col-md-4">
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Cari judul atau penulis"
                value="{{ $kataKunci }}"
            >
        </div>

        <!-- Filter Kategori -->
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>

                @foreach ($daftarKategori as $kategori)
                    <option
                        value="{{ $kategori->id }}"
                        @selected($kategoriId == $kategori->id)
                    >
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Penerbit -->
        <div class="col-md-3">
            <select name="penerbit" class="form-select">
                <option value="">Semua penerbit</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option
                        value="{{ $penerbit->id }}"
                        @selected($penerbitId == $penerbit->id)
                    >
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Cari dan Reset -->
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            @if ($kataKunci || $kategoriId || $penerbitId)
                <a
                    href="{{ route('buku.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Reset
                </a>
            @endif
        </div>

    </form>

    <!-- Jika Buku Tidak Ditemukan -->
    @if ($daftarBuku->isEmpty())

        <div class="alert alert-info">
            Tidak ada buku yang cocok.
        </div>

    @else

        <!-- Informasi Jumlah Buku -->
        <p class="text-muted small">
            Menampilkan buku
            {{ $daftarBuku->firstItem() }}
            sampai
            {{ $daftarBuku->lastItem() }}
            dari
            {{ $daftarBuku->total() }}
            buku.
        </p>

        <!-- Daftar Kartu Buku -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

            @foreach ($daftarBuku as $buku)

                <div class="col">
                    <div class="card h-100 shadow-sm border-0">

                        <!-- Gambar Sampul Buku -->
                        <div
                            class="bg-white d-flex align-items-center justify-content-center p-3 rounded-top"
                            style="height: 250px;"
                        >
                            <img
                                src="{{ asset('images/' . ($buku->cover_image ?? 'sampul-placeholder.png')) }}"
                                class="img-fluid"
                                alt="Sampul {{ $buku->title }}"
                                style="max-height: 100%; object-fit: contain;"
                            >
                        </div>

                        <!-- Informasi Buku -->
                        <div class="card-body d-flex flex-column bg-white rounded-bottom">

                            <!-- Kategori -->
                            <div>
                                <span class="badge bg-secondary mb-2">
                                    {{ $buku->category->name }}
                                </span>

                                <!-- Judul Buku -->
                                <h5
                                    class="card-title fw-semibold text-truncate mb-1"
                                    title="{{ $buku->title }}"
                                >
                                    {{ $buku->title }}
                                </h5>

                                <!-- Penulis -->
                                <p class="card-text text-muted small mb-2">
                                    {{ $buku->author_name }}
                                </p>

                                <!-- Penerbit -->
                                <p class="card-text text-muted small mb-2">
                                    Penerbit:
                                    {{ $buku->publisher?->name ?? 'Belum diisi' }}
                                </p>

                            </div>

                            <div class="mt-auto pt-2">

                                <!-- Harga Buku -->
                                <p class="card-text fw-bold text-primary fs-5 mb-2">
                                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                                </p>

                                <!-- Informasi Stok -->
                                @if ($buku->stock > 0)
                                    <p class="card-text small mb-3">
                                        Stok: {{ $buku->stock }}
                                    </p>
                                @else
                                    <p class="card-text mb-3">
                                        <span class="badge bg-danger">
                                            Stok habis
                                        </span>
                                    </p>
                                @endif

                                <!-- Tombol Detail -->
                                <a
                                    href="{{ route('buku.show', $buku->id) }}"
                                    class="btn btn-primary w-100"
                                >
                                    Lihat Detail
                                </a>

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $daftarBuku->links() }}
        </div>

    @endif

</div>

</body>
</html>
