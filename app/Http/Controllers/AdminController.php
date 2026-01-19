<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Complaint::count(),
            'menunggu' => Complaint::where('status', 'Pending')->count(),
            'diproses' => Complaint::where('status', 'Diproses')->count(),
            'selesai' => Complaint::where('status', 'Selesai')->count(),
        ];

        $complaints = Complaint::latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'complaints'));
    }

    public function complaints()
    {
        $complaints = Complaint::latest()->paginate(15);
        return view('admin.complaints', compact('complaints'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai',
        ]);

        $complaint->update($validated);

        return back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }
}