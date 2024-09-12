<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Limbah;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index_limbah()
    {
        $limbah = Limbah::orderBy('updated_at', 'desc')->get();
        return view('data.limbah', compact('limbah'));
    }
    public function addlimbah(Request $request)
    {
        $validated = $request->validate([
            'kode_limbah' => 'required|string|max:255',
            'nama_destinasi' => 'required|string|max:255',
        ]);
        try {
            // Simpan data ke database
            Limbah::create([
                'kode_limbah' => $validated['kode_limbah'],
                'nama_destinasi' => $validated['nama_destinasi'],
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('limbah')->with('success', 'Limbah added successfully');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()->route('limbah')->with('error', 'Failed to add Limbah');
        }
    }
    public function updatelimbah(Request $request, $id)
    {
        $request->validate([
            'kode_limbah' => 'required|string',
            'nama_limbah' => 'required|string',
        ]);
        try {
            $limbah = Limbah::findOrFail($id);
            $limbah->kode_limbah = $request->input('kode_limbah');
            $limbah->nama_limbah = $request->input('nama_limbah');
            $limbah->save();
        } catch (\Exception $e) {
            return redirect()->route('limbah')->with('success', 'Limbah added successfully');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()->route('limbah')->with('error', 'Failed to add Limbah');
        }
    }
    public function deletelimbah($id)
    {
        $limbah = Limbah::findOrFail($id);
        $limbah->delete();
        return redirect()->route('limbah')->with('succes', 'limbah deleted successfully');
    }

    public function index_destination()
    {
        $destination = Destination::orderBy('updated_at', 'desc')->get();
        return view('data.destination', compact('destination'));
    }
    public function adddestination(Request $request)
    {
        $validated = $request->validate([
            'nama_destinasi' => 'required|string|max:255',
        ]);
        try {
            // Simpan data ke database
            Destination::create([
                'nama_destinasi' => $validated['nama_destinasi'],
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('destination')->with('success', 'Destination added successfully');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()->route('destination')->with('error', 'Failed to add Destination');
        }
    }
    public function updatedestination(Request $request, $id)
    {
        $request->validate([
            'nama_destinasi' => 'required|string',
        ]);
        try {
            $destination = Destination::findOrFail($id);
            $destination->nama_destinasi = $request->input('nama_destinasi');
            $destination->save();
        } catch (\Exception $e) {
            return redirect()->route('destination')->with('success', 'destination added successfully');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()->route('destination')->with('error', 'Failed to add destination');
        }
    }
    public function deletedestination($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();
        return redirect()->route('destination')->with('succes', 'destination deleted successfully');
    }
}
