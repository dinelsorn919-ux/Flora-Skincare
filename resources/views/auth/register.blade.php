@extends('layouts.app')

@section('title', 'Create an account — Flora Skincare')

@section('content')
    <div class="max-w-md mx-auto px-6 py-16 min-h-[75vh] flex items-center justify-center">
        <div class="w-full bg-white border border-line rounded-3xl p-6 lg:p-8 shadow-xl relative overflow-hidden">
            
            <!-- Soft background decorative touch -->
            <div class="absolute inset-0 bg-bone/20 -z-10"></div>

            <div class="text-center mb-6">
                <h1 class="font-display text-2xl lg:text-3xl text-ink mb-1">Create an account</h1>
                <p class="text-xs text-ink/60">Please enter your details to sign up</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 text-xs text-clay border border-clay/30 bg-clay/5 rounded-xl px-3 py-2">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
                @csrf

                <div>
                    <label for="name" class="block text-xs text-ink/70 mb-1 font-medium">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div>
                    <label for="email" class="block text-xs text-ink/70 mb-1 font-medium">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div>
                    <label for="password" class="block text-xs text-ink/70 mb-1 font-medium">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Create a password"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs text-ink/70 mb-1 font-medium">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm your password"
                        class="w-full border border-line rounded-xl px-3.5 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <button type="submit" class="w-full bg-forest text-bone py-3 rounded-xl hover:bg-forestdark transition-all text-xs font-medium shadow-md mt-2">
                    Create Account
                </button>
            </form>

            <div class="text-center text-xs text-ink/60 mt-6 pt-4 border-t border-line">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-forest hover:text-forestdark font-medium ml-1">Log in</a>
            </div>

        </div>
    </div>
@endsection