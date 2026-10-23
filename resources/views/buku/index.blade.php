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
    <h2 class="mb-4 text-center fw-bold">Daftar Buku</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($daftarBuku as $buku)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    
                    {{-- Container Gambar Sampul --}}
                    <div class="bg-white d-flex align-items-center justify-content-center p-3 rounded-top" style="height: 250px;">
                        <img
                            src="{{ asset('images/' . ($buku->cover_image ?? 'sampul-placeholder.png')) }}"
                            class="img-fluid"
                            alt="Sampul {{ $buku->title }}"
                            style="max-height: 100%; object-fit: contain;"
>
                        
                    </div>

                    {{-- Informasi Buku --}}
                    <div class="card-body d-flex flex-column bg-white rounded-bottom">
                        <div>
                            <span class="badge bg-secondary mb-2">
                                {{ $buku->category->name }}
                            </span>

                            <h5 class="card-title fw-semibold text-truncate mb-1" title="{{ $buku->title }}">
                                {{ $buku->title }}
                            </h5>

                            <p class="card-text text-muted small mb-2">
                                {{ $buku->author_name }}
                            </p>
                        </div>

                        <div class="mt-auto pt-2">
                            <p class="card-text fw-bold text-primary fs-5 mb-3">
                                Rp{{ number_format($buku->price, 0, ',', '.') }}
                            </p>

                            <a
                                href="{{ url('/buku/'.$buku->id) }}"
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
</div>

</body>
</html>