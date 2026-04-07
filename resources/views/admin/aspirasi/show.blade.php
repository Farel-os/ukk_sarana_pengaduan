@extends('layouts.app')

@section('title', 'Kelola Status Aspirasi')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-xl font-bold text-slate-900">Detail Aspirasi</h1>
            <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Siswa</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->user->username ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->kategori->ket_kategori ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Lokasi</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->lokasi }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->created_at->format('d-m-Y H:i') }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keterangan</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->keterangan }}</dd>
                </div>
            </dl>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Ubah Status dan Umpan Balik</h2>
            <form action="{{ route('admin.aspirasi.update', $inputAspirasi->id) }}" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="status" class="mb-1 block text-sm font-medium text-slate-700">Status Penyelesaian</label>
                    <select name="status" id="status" required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                        <option value="menunggu" @selected(($inputAspirasi->aspirasi->status ?? 'menunggu') === 'menunggu')>Menunggu</option>
                        <option value="proses" @selected(($inputAspirasi->aspirasi->status ?? '') === 'proses')>Proses</option>
                        <option value="selesai" @selected(($inputAspirasi->aspirasi->status ?? '') === 'selesai')>Selesai</option>
                    </select>
                </div>

                <div>
                    <label for="feedback" class="mb-1 block text-sm font-medium text-slate-700">Umpan Balik (0-5)</label>
                    <input type="number" min="0" max="5" name="feedback" id="feedback"
                        value="{{ $inputAspirasi->aspirasi->feedback ?? 0 }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                </div>

                <div class="flex flex-wrap gap-2">
                    <button type="submit"
                        class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-700">Simpan
                        Perubahan</button>
                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Kembali
                        ke List</a>
                </div>
            </form>
        </section>
    </div>
@endsection
