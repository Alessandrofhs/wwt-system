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
        $formLimbah = FormLimbah::with('details')->findOrFail($id);
        return response()->json([
            'details' => $formLimbah->detail
        ]);
    }

    public function updateDetail(Request $request, $id)
    {
        // Temukan FormLimbah
        $formLimbah = FormLimbah::findOrFail($id);

        // Update FormLimbah
        $formLimbah->destination_id = $request->input('destination_id');
        $formLimbah->license_plate = $request->input('license_plate');
        $formLimbah->status = $request->input('status');
        $formLimbah->save();

        // Ambil array detail dari request
        $details = $request->input('details');

        // Loop melalui setiap detail
        foreach ($details as $detail) {
            $detailFormLimbah = DetailFormLimbah::find($detail['id']);

            // Jika detail ditemukan, perbarui
            if ($detailFormLimbah) {
                $detailFormLimbah->form_limbah_id = $formLimbah->id;
                $detailFormLimbah->limbah_id = $detail['limbah_id'];
                $detailFormLimbah->quantity = $detail['quantity'];
                $detailFormLimbah->unit = $detail['unit'];
                $detailFormLimbah->description = $detail['description'];
                $detailFormLimbah->photo = $detail['photo']; // Pastikan ini sesuai
                $detailFormLimbah->save();
            }
        }

        return response()->json(['success' => 'Data berhasil diperbarui.']);
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
