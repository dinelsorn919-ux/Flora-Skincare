<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Flora Skincare')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { ink: '#090a03', forest: '#0a0d0a', forestdark: '#0c0d0d', clay: '#B97A62', bone: '#f2eff3', line: '#150116' },
                fontFamily: { display: ['Fraunces', 'serif'], sans: ['Work Sans', 'sans-serif'] },
            } }
        }
    </script>
    <style>
        body { font-family: 'Work Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-bone text-ink antialiased">

    <div class="flex min-h-screen">
        <!-- Modern Styled Sidebar -->
        <aside class="w-64 bg-white border-r border-line px-6 py-8 flex flex-col justify-between flex-shrink-0 shadow-sm">
            <div>
                <div class="mb-8 px-3">
                    <a href="{{ route('admin.products.index') }}" class="font-display text-2xl tracking-wide text-forest block">Flora Skincare</a>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-forest/10 text-forest text-[10px] font-semibold tracking-wider uppercase rounded-full">Admin Panel</span>
                </div>

                <nav class="space-y-1.5 text-xs font-medium">
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.products*') ? 'bg-forest text-bone shadow-md' : 'text-ink/80 hover:bg-forest/5' }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Products
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.categories*') ? 'bg-forest text-bone shadow-md' : 'text-ink/80 hover:bg-forest/5' }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        Categories
                    </a>
                </nav>
            </div>

            <div class="pt-6 border-t border-line/60 space-y-3">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-medium text-ink/70 hover:bg-forest/5 transition-all">
                    <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Storefront
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-medium text-clay hover:bg-clay/10 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 px-10 py-10 overflow-x-auto">
            @if (session('status'))
                <div class="mb-6 text-xs bg-forest/10 border border-forest/20 text-forest px-4 py-3 rounded-xl shadow-sm inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>