<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>{{ config('app.name', 'CandForm') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link href="https://fonts.bunny.net/css?family=instrument-sans:400,600&display=swap" rel="stylesheet">
            <style>
                /* minimal fallback to keep layout readable if vite/css not available */
                :root{--bg:#f8fafc;--muted:#6b7280;--brand:#ef4444}
                *{box-sizing:border-box}
                body{font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans";margin:0;background:var(--bg);color:#0f172a}
                a{color:inherit;text-decoration:none}
            </style>
        @endif
    </head>
    <body class="min-h-screen flex flex-col bg-white/50 dark:bg-slate-900">
        <header class="w-full">
            <div class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-slate-800 dark:text-white">{{ config('app.name', 'CandForm') }}</a>

                {{-- <nav class="flex items-center gap-3 text-sm">
                    <a href="{{ url('/') }}" class="px-4 py-2 rounded-md text-slate-700 hover:bg-slate-100">Accueil</a>
                </nav> --}}
            </div>
        </header>

        {{ $slot }}

        <footer class="max-w-6xl mx-auto px-6 py-6 text-sm text-slate-500 dark:text-slate-400">
            © {{ date('Y') }} {{ config('app.name', 'CandForm') }} — Tous droits réservés.
        </footer>
    </body>
</html>
