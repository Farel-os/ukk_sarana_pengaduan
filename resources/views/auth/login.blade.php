@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/70 sm:p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Masuk</h1>
            <p class="mt-1 text-sm text-slate-500">Akses dashboard pengaduan sekolah</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="mb-1 block text-sm font-medium text-slate-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200">
            </div>

            <button type="submit"
                class="w-full rounded-lg bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700">Login</button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600">
            Belum punya akun?
            <a href="{{ route('registerForm') }}" class="font-semibold text-cyan-700 hover:underline">Daftar sekarang</a>
        </p>
    </div>
@endsection
