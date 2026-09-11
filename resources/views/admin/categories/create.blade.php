@extends('admin.layout')

@section('title', 'Add Category — Admin')

@section('content')
    <div class="max-w-xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-display text-3xl text-ink mb-1">Add Category</h1>
                <p class="text-xs text-ink/60">Create a new catalog category</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="bg-forest/10 text-forest text-xs px-4 py-2.5 rounded-xl font-medium hover:bg-forest/20 transition-all">
                ← Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 text-xs text-clay border border-clay/30 bg-clay/5 rounded-xl px-4 py-3">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-line rounded-3xl p-8 lg:p-10 shadow-xl relative overflow-hidden">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-xs text-ink/70 mb-1.5 font-medium">Category Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Skincare"
                        class="w-full border border-line rounded-xl px-4 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
                </div>

                <div>
                    <label for="description" class="block text-xs text-ink/70 mb-1.5 font-medium">Description (Optional)</label>
                    <textarea id="description" name="description" rows="3" placeholder="Brief category summary..."
                        class="w-full border border-line rounded-xl px-4 py-2.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-line">
                    <a href="{{ route('admin.categories.index') }}" class="text-xs text-ink/60 hover:text-ink px-4 py-2">Cancel</a>
                    <button type="submit" class="bg-forest text-bone py-3 px-6 rounded-xl hover:bg-forestdark transition-all text-xs font-medium shadow-md">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection