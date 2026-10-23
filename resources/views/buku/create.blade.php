@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Buku Baru</h2>

    <form action="{{ url('/buku') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" id="title" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author_name" class="form-label">Nama Penulis</label>
            <input type="text" id="author_name" name="author_name"
                   class="form-control @error('author_name') is-invalid @enderror"
                   value="{{ old('author_name') }}">
            @error('author_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>
            <select id="publisher_id" name="publisher_id" class="form-select @error('publisher_id') is-invalid @enderror">
                <option value="">-- Pilih Penerbit --</option>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="text" id="price" name="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="published_year" class="form-label">Tahun Terbit (opsional)</label>
            <input type="text" id="published_year" name="published_year"
                   class="form-control @error('published_year') is-invalid @enderror"
                   value="{{ old('published_year') }}">
            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Sampul (opsional, JPG/PNG, maksimal 2 MB)</label>
            <input type="file" id="cover" name="cover"
                   class="form-control @error('cover') is-invalid @enderror">
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection