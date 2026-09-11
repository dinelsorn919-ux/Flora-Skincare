@extends('admin.layout')

@section('title', 'Edit Product — Admin')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-display text-2xl text-ink mb-0.5">Edit Product</h1>
                <p class="text-xs text-ink/60">Update product details in a wide compact layout</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="bg-forest/10 text-forest text-xs px-3.5 py-2 rounded-lg font-medium hover:bg-forest/20 transition-all">
                ← Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-4 text-xs text-clay border border-clay/30 bg-clay/5 rounded-lg px-4 py-2.5">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-line rounded-2xl p-6 lg:p-8 shadow-sm">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.products._form')
            </form>
        </div>
    </div>
@endsection