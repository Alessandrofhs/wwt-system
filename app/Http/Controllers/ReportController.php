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
        $report = FormLimbah::orderBy('updated_at', 'desc')->with('destination', 'detailFormLimbah')->get();
        $destination = Destination::all();
        $limbah = Limbah::all();
        return view('report', compact('report', 'destination', 'limbah'));
    }
    public function addreport(Request $request)
    {
        // Validasi input request
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'no_policy' => 'required|string',
            'kode_limbah.*' => 'required|string',
            'nama_limbah.*' => 'required|string',
            'quantity.*' => 'required|numeric',
            'unit.*' => 'required|string',
            'no_truck' => 'required|string',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan data FormLimbah (form utama)
            $formLimbah = new FormLimbah();
            $formLimbah->destination_id = $request->destination_id;
            $formLimbah->no_policy = $request->no_policy;
            $formLimbah->no_truck = $request->no_truck;
            $formLimbah->description = $request->description;

            // Proses upload file
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/photos'), $filename);
                $formLimbah->photo = $filename;
            }

            // Simpan form limbah
            $formLimbah->save();

            // Simpan setiap detail limbah
            foreach ($request->kode_limbah as $index => $kodeLimbah) {
                // Cari atau buat data Limbah
                $limbah = Limbah::firstOrCreate([
                    'kode_limbah' => $kodeLimbah
                ], [
                    'nama_limbah' => $request->nama_limbah[$index],
                ]);

                // Simpan detail form limbah
                $detailFormLimbah = new DetailFormLimbah();
                $detailFormLimbah->form_limbah_id = $formLimbah->id;
                $detailFormLimbah->limbah_id = $limbah->id;
                $detailFormLimbah->quantity = $request->quantity[$index];
                $detailFormLimbah->unit = $request->unit[$index];
                $detailFormLimbah->save();
            }

            // Commit transaksi jika semua berhasil
            DB::commit();

            return redirect()->route('formLimbah.show', $formLimbah->id)
                ->with('success', 'Form and Limbah details saved successfully!');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();
            return back()->withErrors('Failed to save data: ' . $e->getMessage());
        }
    }

    public function updatereport() {}
    public function deletereport() {}
}
