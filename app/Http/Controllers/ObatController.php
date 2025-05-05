<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use PDF;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataobat = Obat::orderBy('nama_obat', 'asc')->paginate(15);
        return view('obat.index', [
            "dataobat" => $dataobat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create'); // Pastikan view ini ada
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat'     => 'required',
            'deskripsi'      => 'required',
            'stok'      => 'required',
            'harga'      => 'required',
        ]);
        Obat::create($data);

        return redirect('/obat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
{
    return view('obat.edit', compact('obat'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
    $request->validate([
        'nama_obat'     => 'required',
            'deskripsi'      => 'required',
            'stok'      => 'required',
            'harga'      => 'required',
    ]);

    $obat->update($request->all());

    return redirect()->route('obat.index')->with('success', 'Obat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
    $obat->delete();

    return redirect()->route('obat.index')->with('success', 'Obat deleted successfully.');
    }

    public function cetakpdf()
    {
    	$dataobat = Obat::all();
 
    	$pdf = PDF::loadview('obat.report',['dataobat'=>$dataobat]);
    	return $pdf->stream('laporan-obat-pdf');
    }
}
