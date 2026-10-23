<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $buku->title ?? 'Detail Buku' }} — BookStore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    @if ($buku)
        <div class="card shadow-sm border-0 p-4 bg-white rounded">
            <div class="row align-items-center">
                
                {{-- Kolom Gambar Sampul --}}
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img
                        src="{{ asset('images/sampul-placeholder.png') }}"
                        class="img-fluid rounded border"
                        alt="Sampul {{ $buku->title }}"
                        style="max-height: 320px; object-fit: contain;"
                    >
                </div>

                {{-- Kolom Detail Informasi --}}
                <div class="col-md-8">
                    <span class="badge bg-secondary mb-2 fs-6">
                        {{ $buku->category->name }}
                    </span>

                    <h1 class="fw-bold mb-2">{{ $buku->title }}</h1>

                    <p class="text-muted fs-5 mb-3">
                        Penulis: <strong>{{ $buku->author_name }}</strong>
                    </p>

                    <p class="harga-buku fs-3 fw-bold text-primary mb-4">
                        Rp{{ number_format($buku->price, 0, ',', '.') }}
                    </p>

                    <a
                        href="{{ url('/buku') }}"
                        class="btn btn-outline-secondary btn-lg"
                    >
                        &larr; Kembali ke daftar buku
                    </a>
                </div>

            </div>
        </div>
    @else
        <div class="alert alert-warning text-center p-4" role="alert">
            <h4 class="alert-heading">Buku tidak ditemukan!</h4>
            <p>Buku dengan ID tersebut tidak ada di database.</p>
            <hr>
            <a href="{{ url('/buku') }}" class="btn btn-primary">
                &larr; Kembali ke daftar buku
            </a>
        </div>
    @endif
</div>

</body>
</html>