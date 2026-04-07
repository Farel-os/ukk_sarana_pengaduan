<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $total = InputAspirasi::where('user_id', $userId)->count();
        $menunggu = InputAspirasi::where('user_id', $userId)
            ->whereHas('aspirasi', fn($query) => $query->where('status', 'menunggu'))
            ->count();
        $proses = InputAspirasi::where('user_id', $userId)
            ->whereHas('aspirasi', fn($query) => $query->where('status', 'proses'))
            ->count();
        $selesai = InputAspirasi::where('user_id', $userId)
            ->whereHas('aspirasi', fn($query) => $query->where('status', 'selesai'))
            ->count();

        return view('siswa.dashboard', compact('total', 'menunggu', 'proses', 'selesai'));
    }

    public function index()
    {
        $userId = Auth::id();

        $listAspirasi = InputAspirasi::with(['kategori', 'aspirasi'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $kategori = Kategori::orderBy('ket_kategori')->get();

        return view('siswa.aspirasi.index', compact('listAspirasi', 'kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:table_kategori,id',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $input = InputAspirasi::create([
            'user_id' => Auth::id(),
            'id_kategori' => $validated['id_kategori'],
            'lokasi' => $validated['lokasi'],
            'keterangan' => $validated['keterangan'],
        ]);

        Aspirasi::create([
            'input_aspirasi_id' => $input->id,
            'id_kategori' => $validated['id_kategori'],
            'status' => 'menunggu',
            'feedback' => 0,
        ]);

        return redirect()->route('aspirasi.siswa')->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function detail(InputAspirasi $inputAspirasi)
    {
        if ($inputAspirasi->user_id !== Auth::id()) {
            abort(403);
        }

        $inputAspirasi->load(['kategori', 'aspirasi']);

        return view('siswa.aspirasi.detail', compact('inputAspirasi'));
    }
}
