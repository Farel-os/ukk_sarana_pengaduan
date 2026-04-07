@extends('layouts.app')

@section('title', 'Detail Progres Aspirasi')

@section('content')
    @php
        $status = $inputAspirasi->aspirasi->status ?? 'menunggu';
        $feedback = $inputAspirasi->aspirasi->feedback ?? 0;
        $progress = $status === 'menunggu' ? 20 : ($status === 'proses' ? 60 : 100);
    @endphp

    <div class="mx-auto max-w-3xl space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Detail Progres Aspirasi</h1>

            <div class="mt-4">
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-medium text-slate-700">Status: {{ ucfirst($status) }}</span>
                    <span class="font-semibold text-cyan-700">{{ $progress }}%</span>
                </div>
                <div class="h-3 w-full overflow-hidden rounded-full bg-slate-200">
                    <div class="h-full rounded-full bg-cyan-600" style="width: {{ $progress }}%"></div>
                </div>
                <p class="mt-2 text-xs text-slate-500">Progres perbaikan berdasarkan status penanganan.</p>
            </div>

            <dl class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->kategori->ket_kategori ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Lokasi</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->lokasi }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal Kirim</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->created_at->format('d-m-Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Umpan Balik Admin</dt>
                    <dd class="mt-1 text-sm text-slate-800">Skor {{ $feedback }} dari 5</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keterangan</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $inputAspirasi->keterangan }}</dd>
                </div>
            </dl>

            <div class="mt-6">
                <a href="{{ route('aspirasi.siswa') }}"
                    class="rounded-lg border border-cyan-600 px-4 py-2 text-sm font-semibold text-cyan-700 hover:bg-cyan-50">Kembali
                    ke daftar aspirasi</a>
            </div>
        </section>
    </div>
@endsection
