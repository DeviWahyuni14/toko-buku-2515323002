@extends('layouts.app')

@section('title', 'Tambah Penulis — BookStore')

@section('content')
    <h1 class="mb-4">Tambah Penulis</h1>

    <form action="{{ route('penulis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">
                Nama Penulis
            </label>

            <input type="text"
                   id="name"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">
                Negara
            </label>

            <input type="text"
                   id="country"
                   name="country"
                   class="form-control @error('country') is-invalid @enderror"
                   value="{{ old('country') }}">

            @error('country')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('penulis.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </form>
@endsection