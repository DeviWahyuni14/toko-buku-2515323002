<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
</head>
<body>

    <h1>{{ $buku['judul'] ?? 'Tidak ditemukan' }}</h1>

    @if ($buku)

        <p>Penulis: {{ $buku['penulis'] }}</p>

    @else

        <p>Tidak ada buku dengan id {{ $id }}.</p>

    @endif

    <a href="/buku">Kembali ke daftar buku</a>

</body>
</html>