<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->authorizeAdmin();

        $total = InputAspirasi::count();
        $menunggu = Aspirasi::where('status', 'menunggu')->count();
        $proses = Aspirasi::where('status', 'proses')->count();
        $selesai = Aspirasi::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('total', 'menunggu', 'proses', 'selesai'));
    }

    public function listAspirasi(Request $request)
    {
        $this->authorizeAdmin();

        $query = InputAspirasi::with(['user', 'kategori', 'aspirasi']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            [$year, $month] = explode('-', $request->bulan);
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        if ($request->filled('status')) {
            $query->whereHas('aspirasi', fn($aspirasi) => $aspirasi->where('status', $request->status));
        }

        $listAspirasi = $query->latest()->get();
        $kategori = Kategori::orderBy('ket_kategori')->get();
        $siswa = User::where('role', 'siswa')->orderBy('username')->get();

        return view('admin.aspirasi.index', compact('listAspirasi', 'kategori', 'siswa'));
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        $this->authorizeAdmin();

        $inputAspirasi->load(['user', 'kategori', 'aspirasi']);

        return view('admin.aspirasi.show', compact('inputAspirasi'));
    }

    public function update(Request $request, InputAspirasi $inputAspirasi)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
            'feedback' => 'nullable|integer|min:0|max:5',
        ]);

        Aspirasi::updateOrCreate(
            ['input_aspirasi_id' => $inputAspirasi->id],
            [
                'id_kategori' => $inputAspirasi->id_kategori,
                'status' => $validated['status'],
                'feedback' => $validated['feedback'] ?? 0,
            ]
        );

        return redirect()->route('admin.aspirasi.index')->with('success', 'Status dan umpan balik berhasil diperbarui.');
    }

    public function history()
    {
        $this->authorizeAdmin();

        $riwayat = InputAspirasi::with(['user', 'kategori', 'aspirasi'])
            ->whereHas('aspirasi', fn($query) => $query->where('status', 'selesai'))
            ->latest()
            ->get();

        return view('admin.aspirasi.history', compact('riwayat'));
    }

    private function authorizeAdmin(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }
    }
}
