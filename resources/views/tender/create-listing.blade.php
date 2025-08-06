@extends('layouts.app')

@section('page-title', 'CREATE LISTING')

@section('content')
<div class="min-h-screen bg-[#fafbfc] py-10 px-4">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Compact Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-amber-600 to-yellow-600 rounded-lg mb-3 shadow-sm">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Gold Listing Registration</h1>
            <p class="text-gray-600 text-sm">Professional precious metals auction platform</p>
        </div>

        <!-- Messages Section -->
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                <div class="flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <span class="font-medium">Please correct the following:</span>
                        <ul class="list-disc list-inside mt-1 space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li class="text-xs">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-amber-600 to-yellow-600 px-6 py-4 rounded-t-lg">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                    </svg>
                    Item Registration Form
                </h2>
            </div>

            <form action="{{ route('store-listing') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <!-- Item Name -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Item Name *</label>
                        <input type="text" name="item" value="{{ old('item') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            placeholder="Enter item name" required>
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Type *</label>
                        <input type="text" name="type" value="{{ old('type') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            placeholder="Bar/Coin/Custom" required>
                    </div>

                    <!-- Currency -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Currency *</label>
                        <select name="currency"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            required>
                            <option value="MYR" {{ old('currency') == 'MYR' ? 'selected' : '' }}>MYR - Malaysian Ringgit</option>
                            <option value="IDR" {{ old('currency') == 'IDR' ? 'selected' : '' }}>IDR - Indonesian Rupiah</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Price *</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            placeholder="0.00" required>
                    </div>

                    <!-- Starting Price -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Starting Bid *</label>
                        <input type="number" name="starting_price" step="0.01" value="{{ old('starting_price') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            placeholder="0.00" required>
                    </div>

                    <!-- Bidding Date -->
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">Bidding Date *</label>
                        @php
                            $today = \Carbon\Carbon::today();
                            $maxDate = $today->copy()->addDays(3);
                        @endphp
                        <input type="date" id="date" name="date" value="{{ old('date', $today->toDateString()) }}"
                            min="{{ $today->toDateString() }}" max="{{ $maxDate->toDateString() }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50"
                            required>
                    </div>
                </div>

                <!-- Bidding Duration Section -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Bidding Duration *</label>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <input type="number" id="duration_days" name="duration_days" value="{{ old('duration_days') }}"
                                min="0" max="3" placeholder="0"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50" required>
                            <label class="block text-xs text-gray-500 text-center mt-1">Days</label>
                        </div>
                        <div>
                            <input type="number" id="duration_hours" name="duration_hours" value="{{ old('duration_hours') }}"
                                min="0" max="23" placeholder="0"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50" required>
                            <label class="block text-xs text-gray-500 text-center mt-1">Hours</label>
                        </div>
                        <div>
                            <input type="number" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes') }}"
                                min="0" max="59" placeholder="0"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50" required>
                            <label class="block text-xs text-gray-500 text-center mt-1">Minutes</label>
                        </div>
                    </div>
                    <p class="text-xs text-amber-700 mt-2 bg-amber-50 p-2 rounded border border-amber-200">
                        ⚠️ Maximum duration: 3 days
                    </p>
                </div>

                <!-- Description and Image Upload Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description & Information *</label>
                        <textarea name="info" rows="6"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-gray-50 resize-none"
                            placeholder="Describe your gold item in detail..." required>{{ old('info') }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Image (Optional)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center hover:border-amber-400 transition-colors">
                            <input type="file" name="image" id="image-upload" class="hidden" />
                            <label for="image-upload" class="cursor-pointer">
                                <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm text-gray-600">Click to upload</span>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t border-gray-200 pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-semibold py-3 px-6 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span>Submit Listing</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Smooth transitions */
input, select, textarea, button {
    transition: all 0.2s ease-in-out;
}

/* Focus enhancement */
input:focus, select:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
}

/* Professional hover effects */
button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
    width: 4px;
}

textarea::-webkit-scrollbar-track {
    background: #f9fafb;
}

textarea::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 2px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>
@endsection
