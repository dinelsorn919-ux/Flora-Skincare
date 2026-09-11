@extends('admin.layout')

@section('title', 'Categories — Admin')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="font-display text-3xl text-ink">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-forest text-bone text-sm px-5 py-2.5 rounded-sm hover:bg-forestdark transition-colors">
            Add category
        </a>
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
                    <th class="px-4 py-3 font-normal">Description</th>
                    <th class="px-4 py-3 font-normal text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3 text-ink/70 font-medium">{{ $category->id }}</td>
                        <td class="px-4 py-3 font-medium text-ink">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-ink/70">{{ $category->description ?? '—' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="bg-forest/10 text-forest text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-forest/20 transition-all">
                                    Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Delete category {{ addslashes($category->name) }}?');">
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
                        <td colspan="4" class="px-4 py-8 text-center text-ink/50">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endsection