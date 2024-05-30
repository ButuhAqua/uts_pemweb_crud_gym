<?php

namespace App\Http\Controllers;

// Import model pelanggan

use App\Models\Pelanggan; 

// Import return type View
use Illuminate\View\View;

// Import return type RedirectResponse
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

// Import Facades Storage
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index(): View
    {
        // Geelanggans = Pelanggan::latest()->paginate(10);

        // Render viewelanggans
        $pelanggans = Pelanggan::latest()->paginate(10);
        return view('pelanggans.index', compact('pelanggans'));
    }

    public function create(): View
    {
        return view('pelanggans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama'           => 'required|string|min:1',
            'tempat'         => 'required|string|min:1',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|string|in:laki-laki,perempuan',
            'nomor'          => 'required|numeric',
            'paket'          => 'required|string|in:paket_1,paket_2,paket_3',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Upload image (jika ada)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/pelanggans', $image->hashName());
            $imageName = $image->hashName();
        } else {
            $imageName = null;
        }

        // Buat produk
        Pelanggan::create([
            'nama'           => $request->nama,
            'tempat'         => $request->tempat,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'nomor'          => $request->nomor,
            'paket'          => $request->paket,
            'image'          => $imageName,
        ]);

        // Redirect ke halaman index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        // Get pelanggan by ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Render view with pelanggan
        return view('pelanggans.show', compact('pelanggan'));
    }

    public function edit(string $id): View
    {
        // Get pelanggan by ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Render view with pelanggan
        return view('pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama'           => 'required|string|min:1',
            'tempat'         => 'required|string|min:1',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|string|in:laki-laki,perempuan',
            'nomor'          => 'required|numeric',
            'paket'          => 'required|string|in:paket_1,paket_2,paket_3',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Get pelanggan by ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/pelanggans', $image->hashName());

            // Delete old image
            Storage::delete('public/pelanggans/' . $pelanggan->image);

            // Update pelanggan with new image
            $pelanggan->update([
                'nama'           => $request->nama,
                'tempat'         => $request->tempat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'nomor'          => $request->nomor,
                'paket'          => $request->paket,
                'image'          => $image->hashName(),
            ]);
        } else {
            // Update pelanggan without image
            $pelanggan->update([
                'nama'           => $request->nama,
                'tempat'         => $request->tempat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'nomor'          => $request->nomor,
                'paket'          => $request->paket,
            ]);
        }

        // Redirect to index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id): RedirectResponse
    {
        // Get pelanggan by ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Delete image
        Storage::delete('public/pelanggans/' . $pelanggan->image);

        // Delete pelanggan
        $pelanggan->delete();

        // Redirect to index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}