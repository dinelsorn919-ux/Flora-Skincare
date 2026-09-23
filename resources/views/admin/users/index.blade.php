@extends('admin.layout')

@section('title', 'Users — Admin')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="font-display text-3xl text-ink">Users</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 text-xs text-forest border border-forest/30 bg-forest/5 rounded-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-line rounded-sm overflow-hidden bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-forest/5 text-left text-ink/60">
                <tr>
                    <th class="px-4 py-3 font-normal">ID</th>
                    <th class="px-4 py-3 font-normal">Name</th>
                    <th class="px-4 py-3 font-normal">Email</th>
                    <th class="px-4 py-3 font-normal">Role</th>
                    <th class="px-4 py-3 font-normal text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-3 text-ink/70">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-medium text-ink">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-ink/70">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-ink/70">
                            <span class="px-2 py-1 text-xs rounded {{ $user->role === 'admin' ? 'bg-forest/10 text-forest font-semibold' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Delete user {{ addslashes($user->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-clay/10 text-clay text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-clay/20 transition-all">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-ink/50">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection