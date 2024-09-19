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
        $report = FormLimbah::orderBy('updated_at', 'desc')->with('destination', 'detailLimbah')->get();
        $destination = Destination::all();
        $limbah = Limbah::all();
        return view('report', compact('report', 'destination', 'limbah'));
    }
    public function addReport(Request $request)
    {
        // Validate the form_data field
        $validated = $request->validate([
            'form_data' => 'required|string', // form_data should be a JSON string
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validate photo if exists
        ]);

        // Decode form_data
        $formData = json_decode($validated['form_data'], true);

        // Debugging to see the structure of form_data


        // Check if decoding succeeded and formData is an array
        if (!is_array($formData)) {
            return redirect()->back()->withErrors('Invalid form data format.');
        }

        // Extract form_limbah data and details
        $formLimbahData = $formData['form_limbah'] ?? null;

        $details = $formData['details'] ?? [];


        // Make sure form_limbah data is present
        if (!$formLimbahData) {
            return redirect()->back()->withErrors('Form Limbah data is missing.');
        }

        // Create and save the main report data (Form Limbah)
        $report = new FormLimbah();
        $report->destination_id = $formLimbahData['destination_id'] ?? null;
        $report->no_policy = $formLimbahData['no_policy'] ?? null;
        $report->no_truck = $formLimbahData['no_truck'] ?? null;
        $report->status = "Pending";
        $report->description = $formLimbahData['description'] ?? null;

        // Handle photo upload if exists
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('photos', 'public');
            $report->photo = $path;
        }

        // Save the Form Limbah to the database
        $report->save();

        // Save the details (assumed to be in 'details' key in form_data)
        if (is_array($details)) {
            foreach ($details as $detail) {
                $detailFormLimbah = new DetailFormLimbah();
                $detailFormLimbah->form_limbah_id = $report->id;
                $detailFormLimbah->limbah_id = $detail['kode_limbah'] ?? null; // Assuming 'kode_limbah' maps to 'limbah_id'
                $detailFormLimbah->quantity = $detail['quantity'] ?? 0;
                $detailFormLimbah->unit = $detail['unit'] ?? 'KG'; // Default unit if not provided
                $detailFormLimbah->save();
            }
        }

        return redirect()->back()->with('success', 'Report added successfully.');
    }
    public function getDetails($id)
    {
        $details = DetailFormLimbah::with('limbah')->where('form_limbah_id', $id)->get();
        // dd($details);
        return response()->json(['details' => $details]);
    }

    public function update_details(Request $request, $id)
    {
        // Validasi form
        $request->validate([
            'destination_id' => 'required_if:is_edit_mode,false|nullable',
            'no_policy' => 'required_if:is_edit_mode,false|nullable',
            'no_truck' => 'required_if:is_edit_mode,false|nullable',
            'description' => 'required',
            'details.*.kode_limbah' => 'required',
            'details.*.quantity' => 'required|numeric',
            'details.*.unit' => 'required',
        ]);

        // Temukan FormLimbah
        $formLimbah = FormLimbah::findOrFail($id);

        // Update FormLimbah jika tidak dalam mode edit
        if (!$request->has('is_edit_mode') || !$request->is_edit_mode) {
            $formLimbah->destination_id = $request->input('form_limbah.destination_id');
            $formLimbah->no_policy = $request->input('form_limbah.no_policy');
            $formLimbah->no_truck = $request->input('form_limbah.no_truck');
            $formLimbah->description = $request->input('form_limbah.description');
            $formLimbah->save();
        }

        // Update DetailFormLimbah
        $details = $request->input('details');
        foreach ($details as $detail) {
            $detailFormLimbah = DetailFormLimbah::where('form_limbah_id', $formLimbah->id)
                ->where('kode_limbah', $detail['kode_limbah'])
                ->first();
            if ($detailFormLimbah) {
                $detailFormLimbah->quantity = $detail['quantity'];
                $detailFormLimbah->unit = $detail['unit'];
                $detailFormLimbah->save();
            }
        }

        return redirect()->route('form_limbahs.show', $id)->with('success', 'Data berhasil diperbarui.');
    }
    public function deletereport() {}
}
