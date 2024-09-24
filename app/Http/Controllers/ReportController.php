<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DetailFormLimbah;
use App\Models\FormLimbah;
use App\Models\Limbah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $report = FormLimbah::orderBy('updated_at', 'desc')->with('destination', 'details')->get();
        $destination = Destination::all();
        $limbah = Limbah::all();
        return view('report', compact('report', 'destination', 'limbah'));
    }
    public function addReport(Request $request)
    {
        dd($request);
        // Validasi input dari request
        $request->validate([
            'destination_id' => 'required|integer',
            'license_plate' => 'required|string',
            'details' => 'required|json', // details adalah JSON string
        ]);

        try {
            // Simpan data form limbah
            $formLimbah = new FormLimbah();
            $formLimbah->destination_id = $request->input('destination_id');
            $formLimbah->license_plate = $request->input('license_plate');
            $formLimbah->status = 'pending'; // Set status awal ke 'pending'
            $formLimbah->save();

            // Decode JSON dari details yang dikirimkan sebagai array
            $details = json_decode($request->input('details'), true);

            // Simpan setiap detail limbah yang terkait dengan form limbah yang baru disimpan
            foreach ($details as $detail) {
                $detailLimbah = new DetailFormLimbah();
                $detailLimbah->form_limbah_id = $formLimbah->id; // ID form limbah
                $detailLimbah->limbah_id = $detail['limbah_id'];
                $detailLimbah->quantity = $detail['quantity'];
                $detailLimbah->unit = $detail['unit'];
                $detailLimbah->description = $detail['description'] ?? ''; // Deskripsi opsional
                $detailLimbah->photo = $detail['photo'] ?? null; // Foto opsional
                $detailLimbah->save();
            }

            // Mengirimkan respons sukses
            return response()->json([
                'message' => 'Form limbah dan detail berhasil disimpan!',
            ], 200);
        } catch (\Exception $e) {
            // Mengirimkan respons jika terjadi kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function showDetail($id)
    {
        // Ambil detail dari database berdasarkan id
        $detail = FormLimbah::with('details.limbah')->find($id);

        // Jika detail ditemukan, kembalikan sebagai JSON
        if ($detail) {
            return response()->json($detail);
        } else {
            return response()->json(['message' => 'Detail tidak ditemukan'], 404);
        }
    }
    public function show($id)
    {
        // Mengambil detail dari database berdasarkan ID
        $detail = DetailFormLimbah::find($id);

        // Cek apakah detail ditemukan
        if (!$detail) {
            return response()->json(['message' => 'Detail not found'], 404);
        }

        // Kembalikan detail sebagai respons JSON
        return response()->json($detail);
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
