<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DetailFormLimbah;
use App\Models\FormLimbah;
use App\Models\Limbah;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $report = FormLimbah::orderBy('updated_at', 'desc')->with('destination', 'details')->get();
        $destination = Destination::all();
        $limbah = Limbah::all();
        return view('report', compact('report', 'destination', 'limbah'));
    }
    public function store(Request $request)
    {
        // Validasi input dari form
        $data = $request->validate([
            'destination_id' => 'required|integer',
            'license_plate' => 'required|string',
            'details' => 'required|json' // Validasi sebagai JSON
        ]);

        // Decode JSON menjadi array
        $details = json_decode($data['details'], true);

        // Simpan data ke tabel form_limbah
        $formLimbah = FormLimbah::create([
            'destination_id' => $data['destination_id'],
            'license_plate' => $data['license_plate'],
            'status' => 'pending',
        ]);

        // Simpan detail limbah ke tabel detail_form_limbah
        foreach ($details as $detail) {
            DetailFormLimbah::create([
                'limbah_id' => $detail['kode_limbah'], // Sesuaikan dengan nama kolom di database
                'form_limbah_id' => $formLimbah->id, // ID dari form_limbah yang baru dibuat
                'quantity' => $detail['quantity'],
                'unit' => $detail['unit'],
                'description' => $detail['description'],
                'photo' => $detail['photo']
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('report')->with('success', 'Report created successfully.');
    }

    public function show($id)
    {
        $formLimbah = FormLimbah::with('details.limbah')->findOrFail($id);
        return response()->json([
            'details' => $formLimbah->details
        ]);
    }
    public function destroydetail($id)
    {
        $detail = DetailFormLimbah::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Detail deleted successfully']);
    }
    public function updatedetail(Request $request, $id)
    {
        // dd($request);
        $detail = DetailFormLimbah::find($id);
        if (!$detail) {
            return response()->json(['error' => 'Detail not found'], 404);
        }

        // Validasi input yang diperlukan
        $request->validate([
            'limbah_id' => 'required|exists:tm_limbahs,id', // Pastikan limbah_id valid
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        // Ambil nama limbah berdasarkan limbah_id yang dipilih
        $limbah = Limbah::find($request->input('limbah_id'));
        if (!$limbah) {
            return response()->json(['error' => 'Limbah not found'], 404);
        }

        // Update detail
        $detail->limbah_id = $request->input('limbah_id');
        // $detail->nama_limbah = $limbah->nama_limbah; // Ambil nama limbah dari objek Limbah
        $detail->quantity = $request->input('quantity');
        $detail->unit = $request->input('unit');
        $detail->save();

        // Mengembalikan respons sukses
        return response()->json(['message' => 'Detail updated successfully', 'detail' => $detail]);
    }

    public function deleteReport($id)
    {
        try {
            // Temukan FormLimbah berdasarkan ID
            $formLimbah = FormLimbah::findOrFail($id);

            // Hapus semua detail yang terkait dengan FormLimbah
            $formLimbah->details()->delete(); // Pastikan ada relasi details() di model FormLimbah

            // Hapus FormLimbah
            $formLimbah->delete();

            // Mengirimkan respons sukses
            return response()->json([
                'message' => 'Form limbah berhasil dihapus!',
            ], 200);
        } catch (\Exception $e) {
            // Mengirimkan respons jika terjadi kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
