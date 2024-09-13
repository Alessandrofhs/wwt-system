<?php

namespace App\Http\Controllers;

use App\Models\FormLimbah;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $approval = FormLimbah::orderBy('updated_at', 'desc');
        return view('approval', compact('approval'));
    }
}
