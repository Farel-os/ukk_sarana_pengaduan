@extends('layouts.app')

@section('title', 'Kelola Aspirasi')

@section('content')
    <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">List Aspirasi Keseluruhan</h1>
            <p class="mt-1 text-sm text-slate-500">Filter data per tanggal, bulan, siswa, kategori, dan status.</p>

            <form action="{{ route('admin.aspirasi.index') }}" method="GET" class="mt-4 grid gap-3 md:grid-cols-5">
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-600">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-600">Bulan</label>
                    <input type="month" name="bulan" value="{{ request('bulan') }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-600">Siswa</label>
                    <select name="user_id"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                        <option value="">Semua</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->id }}" @selected((string) request('user_id') === (string) $item->id)>{{ $item->username }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-600">Kategori</label>
                    <select name="id_kategori"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                        <option value="">Semua</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" @selected((string) request('id_kategori') === (string) $item->id)>
                                {{ $item->ket_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-600">Status</label>
                    <select name="status"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
                        <option value="">Semua</option>
                        <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu</option>
                        <option value="proses" @selected(request('status') === 'proses')>Proses</option>
                        <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
                    </select>
                </div>

                <div class="md:col-span-5 flex flex-wrap gap-2 pt-2">
                    <button type="submit"
                        class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-700">Terapkan
                        Filter</button>
                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Reset</a>
                </div>
            </form>
        </section>

        @if (session('success'))
            <section class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                {{ session('success') }}
            </section>
        @endif

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
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Feedback</th>
                            <th class="px-4 py-3">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($listAspirasi as $item)
                            @php
                                $status = $item->aspirasi->status ?? 'menunggu';
                                $feedback = $item->aspirasi->feedback ?? 0;
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-600">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">{{ $item->user->username ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->kategori->ket_kategori ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->lokasi }}</td>
                                <td class="px-4 py-3">{{ $item->keterangan }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : ($status === 'proses' ? 'bg-sky-100 text-sky-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td class="px-4 py-3">{{ $feedback }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.aspirasi.show', $item->id) }}"
                                        class="rounded-lg border border-cyan-600 px-3 py-1.5 text-xs font-semibold text-cyan-700 hover:bg-cyan-50">Kelola</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-slate-500">Belum ada data aspirasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
