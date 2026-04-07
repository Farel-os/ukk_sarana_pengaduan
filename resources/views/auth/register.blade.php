@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="mx-auto max-w-lg rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/70 sm:p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Daftar Akun Siswa</h1>
            <p class="mt-1 text-sm text-slate-500">Isi data untuk membuat akun baru</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @csrf

            <div class="sm:col-span-2">
                <label for="username" class="mb-1 block text-sm font-medium text-slate-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div class="sm:col-span-2">
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div>
                <label for="kelas" class="mb-1 block text-sm font-medium text-slate-700">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div>
                <label for="nis" class="mb-1 block text-sm font-medium text-slate-700">NIS</label>
                <input type="text" name="nis" id="nis" value="{{ old('nis') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div class="sm:col-span-2">
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div class="sm:col-span-2">
                <button type="submit"
                    class="w-full rounded-lg bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700">Register</button>
            </div>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600">
            Sudah punya akun?
            <a href="{{ route('loginForm') }}" class="font-semibold text-cyan-700 hover:underline">Login</a>
        </p>
    </div>
@endsection
