<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FrontendController extends Controller
{
    public function index(): View
    {
        // Geelanggans = Pelanggan::latest()->paginate(10);

        // Render viewelanggans
        $pelanggans = Pelanggan::latest()->paginate(10);
        return view('frontend', compact('pelanggans'));
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

}
