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
    public function addReport(Request $request)
{
    dd($request->all());
    // Validate only the required fields and form_data
    $validated = $request->validate([
        'form_data' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Save the main report data
    $report = new FormLimbah();
    $report->destination_id = $request->input('destination_id');
    $report->no_policy = $request->input('no_policy');
    $report->no_truck = $request->input('no_truck');
    $report->description = $request->input('description');
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $path = $photo->store('photos', 'public');
        $report->photo = $path;
    }
    $report->save();

    // Decode form_data and save detail form limbah
    $details = json_decode($validated['form_data'], true);
    foreach ($details as $detail) {
        $detailFormLimbah = new DetailFormLimbah();
        $detailFormLimbah->form_limbah_id = $report->id;
        $detailFormLimbah->limbah_id = $detail['kode_limbah']; // Adjust according to your database structure
        $detailFormLimbah->quantity = $detail['quantity'];
        $detailFormLimbah->unit = $detail['unit'];
        $detailFormLimbah->save();
    }

    return redirect()->back()->with('success', 'Report added successfully.');
}


    public function updatereport() {}
    public function deletereport() {}
}
