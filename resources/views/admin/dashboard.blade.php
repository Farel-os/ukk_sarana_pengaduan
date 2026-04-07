@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-slate-500">Pantau seluruh aspirasi dan proses penyelesaiannya.</p>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Aspirasi</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $total }}</p>
            </article>
            <article class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <p class="text-sm text-amber-700">Menunggu</p>
                <p class="mt-2 text-3xl font-bold text-amber-800">{{ $menunggu }}</p>
            </article>
            <article class="rounded-2xl border border-sky-200 bg-sky-50 p-5 shadow-sm">
                <p class="text-sm text-sky-700">Proses</p>
                <p class="mt-2 text-3xl font-bold text-sky-800">{{ $proses }}</p>
            </article>
            <article class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-sm text-emerald-700">Selesai</p>
                <p class="mt-2 text-3xl font-bold text-emerald-800">{{ $selesai }}</p>
            </article>
        </section>

        <section class="flex flex-wrap gap-2">
            <a href="{{ route('admin.aspirasi.index') }}"
                class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-700">Kelola
                Aspirasi</a>
            <a href="{{ route('admin.aspirasi.history') }}"
                class="rounded-lg border border-cyan-600 px-4 py-2 text-sm font-semibold text-cyan-700 hover:bg-cyan-50">Histori
                Aspirasi</a>
        </section>
    </div>
@endsection
