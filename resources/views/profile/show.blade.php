@extends('layouts.app')

@section('content')

      
    <div class="max-w-3xl mx-auto py-16 px-6">
       <!-- Back to Homepage Link --> 
      <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink/70 hover:text-forest transition-colors bg-white border border-line/80 px-4 py-2.5 rounded-xl shadow-2xs">
       &larr; Back to Homepage
      </a>

        <!-- Profile Wrapper Card -->
        <div class="bg-white border border-line/80 rounded-3xl shadow-sm overflow-hidden">
            
            <!-- Cover / Top Banner Area -->
            <div class="bg-gradient-to-r from-forest/5 via-forest/10 to-transparent px-8 py-10 border-b border-line/60 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-2xl object-cover border-2 border-white shadow-md">
                    @else
                        <div class="w-24 h-24 rounded-2xl bg-forest text-bone flex items-center justify-center font-display text-3xl font-medium shadow-md">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="font-display text-2xl sm:text-3xl text-ink">{{ $user->name }}</h1>
                            <span class="px-2.5 py-1 bg-forest text-bone text-[10px] font-semibold tracking-wider uppercase rounded-md shadow-2xs">
                                {{ ucfirst($user->role ?? 'Customer') }}
                            </span>
                        </div>
                        <p class="text-sm text-ink/60 mt-1">{{ $user->email }}</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2 bg-forest text-bone text-xs font-semibold uppercase tracking-wider px-6 py-3 rounded-xl hover:bg-forest/90 transition-all shadow-sm self-start sm:self-auto">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profile
                </a>
            </div>

            <!-- Details Section -->
            <div class="p-8 grid grid-cols-1 sm:grid-cols-3 gap-6 bg-bone/30">
                <div class="bg-white p-5 rounded-2xl border border-line/60 shadow-2xs">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-ink/40 mb-1">Full Name</span>
                    <span class="text-sm font-medium text-ink">{{ $user->name }}</span>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-line/60 shadow-2xs">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-ink/40 mb-1">Joined Date</span>
                    <span class="text-sm font-medium text-ink">{{ $user->created_at->format('M d, Y') }}</span>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-line/60 shadow-2xs">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-ink/40 mb-1">Account Status</span>
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-forest mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-forest animate-pulse"></span> Active
                    </span>
                </div>
            </div>

        </div>

    </div>
@endsection