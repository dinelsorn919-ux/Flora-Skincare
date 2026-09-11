<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Flora Skincare — Skincare, kept simple')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#26291F',
                        forest: '#2F3B2A',
                        forestdark: '#212A1E',
                        clay: '#B97A62',
                        bone: '#FAF8F3',
                        line: '#E4DFD3',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        sans: ['Work Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Work Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-bone text-ink antialiased">

    <header class="border-b border-line">
        <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-display text-2xl text-forest tracking-tight">Flora Skincare</a>

            <div class="flex items-center gap-4 text-sm">
                <!-- Search Form -->
                <form action="{{ route('storefront.search') }}" method="GET" class="relative flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." 
                        class="bg-bone/60 border border-line rounded-lg text-xs px-3 py-1.5 pl-8 focus:outline-none focus:border-forest focus:bg-white transition-all w-32 sm:w-48">
                    <svg class="w-3.5 h-3.5 text-ink/40 absolute left-2.5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.products.index') }}" class="text-ink/80 hover:text-forest transition-colors">Admin</a>
                    @endif
                    <span class="text-ink/50 hidden sm:inline">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-ink/50 hover:text-clay">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-ink/80 hover:text-forest transition-colors">Log in</a>
                @endauth

                <a href="{{ route('cart.index') }}" class="text-ink/80 hover:text-forest transition-colors flex items-center gap-1.5">
                Cart
                @if (session('cart') && count(session('cart')) > 0)
                <span class="text-xs bg-forest text-bone rounded-full px-1.5 py-0.2">{{ collect(session('cart'))->sum() }}</span>
                @endif
                </a>
            </div>
        </div>
    </header>

    @if (session('status'))
        <div class="max-w-6xl mx-auto px-6 pt-4">
            <p class="text-sm bg-forest/5 border border-forest/20 text-forest px-4 py-2 rounded-sm">{{ session('status') }}</p>
        </div>
    @endif

    <main>
        @yield('content')
    </main>
    <!------footer-------->
    <footer class="border-t border-line mt-24">
        <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10 text-sm">
            <div>
                <p class="font-display text-xl text-forest mb-2">Flora Skincare</p>
                <p class="text-ink/70 max-w-xs">Formulated for skin that has better things to do than react to it.</p>
            </div>
            <div>
                <p class="text-ink mb-3">Social Media</p>
                <ul class="space-y-2 text-ink/70">
                    <li><a href="https://www.instagram.com/floraskincarehttps://www.facebook.com/share/1Sbh8JH8wk/?mibextid=wwXIfr" target="_blank" class="hover:text-forest">Instagram</a></li>
                    <li><a href="https://www.facebook.com/share/1Sbh8JH8wk/?mibextid=wwXIfr" target="_blank" class="hover:text-forest">Facebook</a></li>
                    <li><a href="" target="_blank" class="hover:text-forest">TikTok</a></li>
                </ul>
            </div>
            <div>
                <p class="text-ink mb-3">Contact Us</p>
                <ul class="space-y-2 text-ink/70">
                    <li>PhoneNumber : 0883117738</li>
                    <li>Email : FloraSkinCare@gmail.com</li>
                    <li>Address : Battambang City</li>
                </ul>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-6 py-6 border-t border-line text-xs text-ink/50">
            &copy; {{ date('Y') }} Flora Skincare. Owned and operated by Dynel. All rights reserved.
        </div>
    </footer>

</body>
</html>