@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Admin Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl p-8 mb-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Dashboard Admin</h2>
                <p class="text-blue-100">Kelola dan pantau semua pengaduan kampus secara real-time</p>
            </div>
            <div class="bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                <p class="text-sm text-blue-100">Admin</p>
                <p class="font-semibold">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">TOTAL PENGADUAN</p>
                    <h3 class="text-4xl font-bold text-blue-600 mt-2">{{ $stats['total'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Semua pengaduan yang masuk</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-orange-500 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">MENUNGGU</p>
                    <h3 class="text-4xl font-bold text-orange-600 mt-2">{{ $stats['menunggu'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Belum ditindaklanjuti</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">DALAM PROSES</p>
                    <h3 class="text-4xl font-bold text-yellow-600 mt-2">{{ $stats['diproses'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Sedang ditangani</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">SELESAI</p>
                    <h3 class="text-4xl font-bold text-green-600 mt-2">{{ $stats['selesai'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Berhasil diselesaikan</p>
                </div>
                <div class="bg-green-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Daftar Pengaduan</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola status pengaduan</p>
            </div>
            <div class="flex space-x-2">
                <input type="text" placeholder="Cari pengaduan..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">Pelapor</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($complaints as $complaint)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">#{{ $complaint->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $complaint->name }}</div>
                            <div class="text-xs text-gray-500">{{ $complaint->nim }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $complaint->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($complaint->location, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.complaints.status', $complaint) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs font-semibold rounded-full px-3 py-1 border-0 
                                    {{ $complaint->status == 'Pending' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $complaint->status == 'Diproses' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $complaint->status == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}">
                                    <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ $complaint->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ $complaint->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <a href="{{ route('complaints.show', $complaint) }}" 
                                class="text-blue-600 hover:text-blue-900 font-medium">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <p class="text-lg">Belum ada pengaduan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($complaints->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $complaints->links() }}
        </div>
        @endif
    </div>
</div>
@endsection