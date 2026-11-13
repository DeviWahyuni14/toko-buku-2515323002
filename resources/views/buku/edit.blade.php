
@extends('layouts.app')

@section('title', 'Edit Buku — BookStore')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Judul Buku -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>

            <input type="text" id="title" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $buku->title) }}">

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Penulis Lama -->
        <div class="mb-3">
            <label for="author_name" class="form-label">
                Nama Penulis
            </label>

            <input type="text" id="author_name" name="author_name"
                   class="form-control @error('author_name') is-invalid @enderror"
                   value="{{ old('author_name', $buku->author_name) }}">

            @error('author_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penulis Terdaftar -->
        <div class="mb-3">
            <label for="author_id" class="form-label">
                Penulis Terdaftar (Opsional)
            </label>

            <select id="author_id" name="author_id"
                    class="form-select @error('author_id') is-invalid @enderror">

                <option value="">-- Pilih Penulis --</option>

                @foreach ($daftarPenulis as $penulis)
                    <option value="{{ $penulis->id }}"
                        @selected(old('author_id', $buku->author_id) == $penulis->id)>
                        {{ $penulis->name }}
                    </option>
                @endforeach

            </select>

            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kategori Buku -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>

            <select id="category_id" name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror">

                <option value="">-- Pilih Kategori --</option>

                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        @selected(old('category_id', $buku->category_id) == $kategori->id)>
                        {{ $kategori->name }}
                    </option>
                @endforeach

            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penerbit Buku -->
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>

            <select id="publisher_id" name="publisher_id"
                    class="form-select @error('publisher_id') is-invalid @enderror">

                <option value="">-- Pilih Penerbit --</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        @selected(old('publisher_id', $buku->publisher_id) == $penerbit->id)>
                        {{ $penerbit->name }}
                    </option>
                @endforeach

            </select>

            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Buku -->
        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>

            <input type="number" id="price" name="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', (int) $buku->price) }}"
                   min="0" step="1">

            <div class="form-text">
                Ketik angka saja, tanpa titik atau koma.
            </div>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stok Buku -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>

            <input type="number" id="stock" name="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $buku->stock) }}"
                   min="0" max="100000" step="1">

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tahun Terbit -->
        <div class="mb-3">
            <label for="published_year" class="form-label">
                Tahun Terbit (Opsional)
            </label>

            <input type="number"
                   id="published_year"
                   name="published_year"
                   class="form-control @error('published_year') is-invalid @enderror"
                   value="{{ old('published_year', $buku->published_year) }}"
                   min="1900" max="2100">

            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sampul Buku -->
        <div class="mb-3">
            <label for="cover" class="form-label">
                Ganti Sampul (Opsional, JPG/PNG, maksimal 2 MB)
            </label>

            @if ($buku->cover)
                <div class="mb-2">
                    <img src="{{ $buku->cover_url }}"
                         alt="Sampul buku"
                         style="max-width: 120px;">
                </div>
            @endif

            <input type="file" id="cover" name="cover"
                   class="form-control @error('cover') is-invalid @enderror"
                   accept=".jpg,.jpeg,.png">

            <div class="form-text">
                Kosongkan jika tidak ingin mengganti sampul.
            </div>

            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan dan Batal -->
        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('buku.index') }}"
           class="btn btn-secondary">
            Batal
        </a>

    </form>

</div>
@endsection
