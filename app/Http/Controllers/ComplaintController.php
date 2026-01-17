<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        $stats = [
            'total' => Complaint::count(),
            'pending' => Complaint::where('status', 'Pending')->count(),
            'diproses' => Complaint::where('status', 'Diproses')->count(),
            'selesai' => Complaint::where('status', 'Selesai')->count(),
        ];
        return view('complaints.index', compact('complaints', 'stats'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'category' => 'required|in:Kebersihan,Fasilitas Rusak,Keamanan,Layanan,Lainnya',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('complaints', 'public');
        }

        Complaint::create($validated);

        return redirect()->route('complaints.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'category' => 'required|in:Kebersihan,Fasilitas Rusak,Keamanan,Layanan,Lainnya',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Pending,Diproses,Selesai',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
        ]);

        if ($request->hasFile('photo')) {
            if ($complaint->photo) {
                Storage::disk('public')->delete($complaint->photo);
            }
            $validated['photo'] = $request->file('photo')->store('complaints', 'public');
        }

        $complaint->update($validated);

        return redirect()->route('complaints.index')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Complaint $complaint)
    {
        if ($complaint->photo) {
            Storage::disk('public')->delete($complaint->photo);
        }
        
        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}