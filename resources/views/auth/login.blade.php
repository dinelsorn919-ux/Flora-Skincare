@extends('layouts.app')

@section('title', 'Log in — Flora Skincare')

@section('content')
    <div class="max-w-md mx-auto px-6 py-16 min-h-[75vh] flex items-center justify-center">
        <div class="w-full bg-white border border-line rounded-3xl p-6 lg:p-8 shadow-xl relative overflow-hidden">
            
            <!-- Soft background decorative touch -->
            <div class="absolute inset-0 bg-bone/20 -z-10"></div>

            <div class="text-center mb-6">
                <h1 class="font-display text-2xl lg:text-3xl text-ink mb-1">Welcome Back</h1>
                <p class="text-xs text-ink/60">Please login to your account</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 text-xs text-clay border border-clay/30 bg-clay/5 rounded-xl px-3 py-2">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-3.5">
                @csrf

                <div>
                    <label for="email" class="block text-xs text-ink/70 mb-1 font-medium">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div>
                    <label for="password" class="block text-xs text-ink/70 mb-1 font-medium">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div class="flex items-center text-xs">
                    <label class="flex items-center gap-2 text-ink/70 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-line text-forest focus:ring-forest w-3.5 h-3.5">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="w-full bg-forest text-bone py-3 rounded-xl hover:bg-forestdark transition-all text-xs font-medium shadow-md mt-2">
                    Log In
                </button>
            </form>

            <div class="text-center text-xs text-ink/60 mt-6 pt-4 border-t border-line">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-forest hover:text-forestdark font-medium ml-1">Sign up</a>
            </div>

        </div>
    </div>
@endsection