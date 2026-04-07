<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Sarana Pengaduan')</title>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="min-h-screen bg-linear-to-br from-cyan-50 via-white to-emerald-50">
        @auth
            <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-lg font-semibold">Sarana Pengaduan</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->username }} ({{ auth()->user()->role }})</p>
                    </div>

                    <nav class="flex items-center gap-2">
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard.admin') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Dashboard
                                Admin</a>
                            <a href="{{ route('admin.aspirasi.index') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Kelola
                                Aspirasi</a>
                            <a href="{{ route('admin.aspirasi.history') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Histori</a>
                        @else
                            <a href="{{ route('dashboard.siswa') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Dashboard
                                Siswa</a>
                            <a href="{{ route('aspirasi.siswa') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Aspirasi
                                Saya</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="rounded-md bg-rose-500 px-3 py-2 text-sm font-semibold text-white hover:bg-rose-600">Logout</button>
                        </form>
                    </nav>
                </div>
            </header>
        @endauth

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
</body>

</html>
