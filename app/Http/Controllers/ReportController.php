<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\FormLimbah;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $report = FormLimbah::orderBy('updated_at', 'desc')->with('destination', 'detailFormLimbah')->get();
        $destination = Destination::all();
        return view('report', compact('report', 'destination'));
    }
    public function addreport() {}
    public function updatereport() {}
    public function deletereport() {}
}
