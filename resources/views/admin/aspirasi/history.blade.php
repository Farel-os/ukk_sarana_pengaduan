@extends('layouts.app')

@section('title', 'Histori Aspirasi')

@section('content')
    <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Histori Aspirasi Selesai</h1>
            <p class="mt-1 text-sm text-slate-500">Daftar aspirasi yang sudah dinyatakan selesai oleh admin.</p>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Siswa</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($riwayat as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-600">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">{{ $item->user->username ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->kategori->ket_kategori ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->lokasi }}</td>
                                <td class="px-4 py-3">{{ $item->keterangan }}</td>
                                <td class="px-4 py-3">{{ $item->aspirasi->feedback ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada histori aspirasi
                                    selesai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
