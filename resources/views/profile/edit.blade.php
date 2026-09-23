@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-16 px-6">
        
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
           <!--- <div>
                <h1 class="font-display text-3xl text-ink tracking-tight">Edit Profile</h1>
                <p class="text-sm text-ink/60 mt-1">Update your account information, avatar, and password.</p>
            </div>
            --->
            <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink/70 hover:text-forest transition-colors bg-white border border-line/80 px-4 py-2.5 rounded-xl shadow-2xs">
                &larr; Back to Profile
            </a>
        </div>

        <!-- Form Card Wrapper -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-line/80 rounded-3xl shadow-sm overflow-hidden">
            @csrf
            @method('PATCH')

            <!-- Top Section: Avatar Upload -->
            <div class="bg-gradient-to-r from-forest/5 via-forest/10 to-transparent px-8 py-8 border-b border-line/60 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                @if (auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-white shadow-md flex-shrink-0">
                @else
                    <div class="w-20 h-20 rounded-2xl bg-forest text-bone flex items-center justify-center font-display text-2xl font-medium shadow-md flex-shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                <div class="w-full">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">Profile Picture</label>
                    <input type="file" name="avatar" class="w-full text-xs text-ink/70 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-forest file:text-bone hover:file:bg-forest/90 file:cursor-pointer transition-all">
                    @error('avatar')
                        <span class="text-xs text-clay mt-1.5 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Form Fields Section -->
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="w-full px-4 py-3 text-sm bg-bone/30 border border-line/80 rounded-xl focus:outline-none focus:border-forest focus:ring-1 focus:ring-forest transition-all">
                        @error('name')
                            <span class="text-xs text-clay mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="w-full px-4 py-3 text-sm bg-bone/30 border border-line/80 rounded-xl focus:outline-none focus:border-forest focus:ring-1 focus:ring-forest transition-all">
                        @error('email')
                            <span class="text-xs text-clay mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="border-line/60 my-2">

                <!-- Password Section -->
                <div class="space-y-4">
                    <div>
                        <h3 class="font-display text-lg text-ink">Update Password</h3>
                        <p class="text-xs text-ink/60 mt-0.5">Leave blank if you don't want to change your password.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">Current Password</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                            class="w-full px-4 py-3 text-sm bg-bone/30 border border-line/80 rounded-xl focus:outline-none focus:border-forest focus:ring-1 focus:ring-forest transition-all">
                        @error('current_password')
                            <span class="text-xs text-clay mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">New Password</label>
                            <input type="password" name="new_password" placeholder="••••••••"
                                class="w-full px-4 py-3 text-sm bg-bone/30 border border-line/80 rounded-xl focus:outline-none focus:border-forest focus:ring-1 focus:ring-forest transition-all">
                            @error('new_password')
                                <span class="text-xs text-clay mt-1.5 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-ink/70 mb-2">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" placeholder="••••••••"
                                class="w-full px-4 py-3 text-sm bg-bone/30 border border-line/80 rounded-xl focus:outline-none focus:border-forest focus:ring-1 focus:ring-forest transition-all">
                        </div>
                    </div>
                </div>

                <!-- Submit Button Area -->
                <div class="flex items-center justify-end pt-4 border-t border-line/60">
                    <button type="submit" class="bg-forest text-bone text-xs font-semibold uppercase tracking-wider px-6 py-3.5 rounded-xl hover:bg-forest/90 transition-all shadow-sm">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection