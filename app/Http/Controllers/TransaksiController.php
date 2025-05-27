<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request; // Pastikan ini diimpor

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil semua data transaksi, diurutkan berdasarkan obat_id dan dipaginasi
        $transaksi = Transaksi::orderBy('obat_id')->paginate(15);

        // Cek nama rute yang sedang aktif
        // Jika rute adalah 'transaksi.index', tampilkan view transaksi
        if ($request->routeIs('transaksi.index')) {
            return view('transaksi.index', [
                "transaksi" => $transaksi // Kirim data transaksi ke view
            ]);
        }
        // Jika rute adalah 'laporan.index', tampilkan view laporan
        elseif ($request->routeIs('laporan.index')) {
            return view('laporan.index', [
                "transaksi" => $transaksi // Kirim data transaksi ke view laporan
            ]);
        }

        // Sebagai fallback, jika tidak ada rute yang cocok, kembalikan ke transaksi.index
        return view('transaksi.index', [
            "transaksi" => $transaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'obat_id' => 'required|integer', // Tambahkan validasi tipe data
            'jumlah' => 'required|integer|min:1', // Tambahkan validasi tipe data dan nilai minimal
            'tanggal_transaksi' => 'required|date', // Validasi format tanggal
            'total_harga' => 'required|numeric|min:0', // Validasi tipe data dan nilai minimal
        ]);
        Transaksi::create($data);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Metode ini belum diimplementasikan, bisa ditambahkan jika diperlukan
        // Contoh: return view('transaksi.show', ['transaksi' => Transaksi::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = $request->validate([
            'obat_id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $transaksi->update($data);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}