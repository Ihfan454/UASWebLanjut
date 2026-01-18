<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->get();
        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'category' => 'required',
            'location' => 'required',
            'description' => 'required',
            'priority' => 'required|in:rendah,sedang,tinggi',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        Complaint::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category,
            'location' => $request->location,
            'description' => $request->description,
            'priority' => $request->priority,
            'photo' => $photoPath,
            'status' => 'baru',
        ]);

        return redirect()->route('complaints.index')->with('success', 'Laporan terkirim!');
    }

    public function edit(Complaint $complaint)
    {
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:baru,proses,selesai',
        ]);

        $complaint->update([
            'status' => $request->status,
        ]);

        return redirect()->route('complaints.index')->with('success', 'Status updated!');
    }

    public function destroy(Complaint $complaint)
    {
        if ($complaint->status !== 'selesai') {
            return back()->with('error', 'Hanya laporan selesai yang bisa dihapus!');
        }

        $complaint->delete();
        return back()->with('success', 'Laporan dihapus!');
    }
}
