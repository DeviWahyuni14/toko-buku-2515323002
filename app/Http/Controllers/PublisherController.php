<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    public function index()
    {
        return view('penerbit.index', [
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:publishers,name',
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max' => 'Nama penerbit maksimal 100 karakter.',
            'name.unique' => 'Nama penerbit ini sudah ada.',
            'city.required' => 'Kota penerbit wajib diisi.',
            'city.max' => 'Kota penerbit maksimal 100 karakter.',
        ]);

        Publisher::create($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        return view('penerbit.edit', [
            'penerbit' => Publisher::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('publishers', 'name')->ignore($penerbit->id),
            ],
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max' => 'Nama penerbit maksimal 100 karakter.',
            'name.unique' => 'Nama penerbit ini sudah ada.',
            'city.required' => 'Kota penerbit wajib diisi.',
            'city.max' => 'Kota penerbit maksimal 100 karakter.',
        ]);

        $penerbit->update($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $penerbit = Publisher::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil dihapus.');
    }
}