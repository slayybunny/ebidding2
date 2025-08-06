@extends('layouts.app')

@section('page-title', 'Edit Listing')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center">
  <div class="w-full max-w-5xl bg-white p-6 rounded-xl shadow-md">

        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent mb-3">
                Edit Gold Listing
            </h1>
            <p class="text-gray-600 text-lg">Edit your precious gold item details</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 text-green-800 px-6 py-4 rounded-r-lg shadow-md animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-8 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 text-red-800 px-6 py-4 rounded-r-lg shadow-md">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="font-medium mb-2">Please fix the following errors:</h3>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <div class="bg-white rounded-2xl shadow-xl border border-yellow-100 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 p-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                    </svg>
                    Listing Details
                </h2>
            </div>

            <form action="{{ route('update-listing', $listing->slug) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Item Name -->
                <div class="group">
                    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                        Item Name
                    </label>
                    <div class="relative">
                        <input type="text" name="item" value="{{ old('item', $listing->item) }}"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300"
                            placeholder="e.g., Elegant Gold Necklace" required>
                    </div>
                </div>

                <!-- Type -->
                <div class="group">
                    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                        Type
                    </label>
                    <div class="relative">
                        <input type="text" name="type" value="{{ old('type', $listing->type) }}"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300"
                            placeholder="e.g., Bar / Coin / Custom Item" required>
                    </div>
                </div>

                <!-- Currency -->
                <div class="group">
                    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                        Currency
                    </label>
                    <div class="relative">
                        <select name="currency"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300 appearance-none"
                            required>
                            <option value="MYR" {{ old('currency', $listing->currency) == 'MYR' ? 'selected' : '' }}>🇲🇾 MYR - Malaysian Ringgit</option>
                            <option value="IDR" {{ old('currency', $listing->currency) == 'IDR' ? 'selected' : '' }}>🇮🇩 IDR - Indonesian Rupiah</option>
                        </select>
                    </div>
                </div>

                <!-- Price Grid -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div class="group">
                        <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                            Price (per gram)
                        </label>
                        <div class="relative">
                            <input type="number" name="price" step="0.01" value="{{ old('price', $listing->price) }}"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 pl-8 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300"
                                placeholder="300.00" required>
                        </div>
                    </div>

                    <!-- Starting Price -->
                    <div class="group">
                        <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                            Starting Bidding Price
                        </label>
                        <div class="relative">
                            <input type="number" name="starting_price" step="0.01" value="{{ old('starting_price', $listing->starting_price) }}"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 pl-8 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300"
                                placeholder="250.00" required>
                        </div>
                    </div>
                </div>

                <!-- Bidding Date -->
                <div class="group">
                    <label for="date" class="block font-semibold text-gray-800 mb-3 flex items-center">
                        <span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>
                        Bidding Date
                    </label>
                    @php
                        $today = \Carbon\Carbon::today();
                        $maxDate = $today->copy()->addDays(3);
                    @endphp
                    <div class="relative">
                        <input type="date" id="date" name="date" value="{{ old('date', $listing->date) }}"
                            min="{{ $today->toDateString() }}" max="{{ $maxDate->toDateString() }}"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300"
                            required>
                    </div>
                </div>

  <!-- Bidding Duration -->
<!-- Bidding Duration -->
<div class="group">
    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
        <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
        Bidding Duration
    </label>
    <div class="grid grid-cols-3 gap-4">
        <!-- Days -->
        <div class="relative">
            <input type="number" id="duration_days" name="duration_days"
                value="{{ old('duration_days', floor($listing->duration / 1440)) }}"
                min="0" max="3" placeholder="0"
                class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-center focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300" required>
            <span class="absolute bottom-1 left-1/2 transform -translate-x-1/2 text-xs text-gray-500 bg-white px-2 rounded">Days</span>
        </div>

        <!-- Hours -->
        <div class="relative">
            <input type="number" id="duration_hours" name="duration_hours"
                value="{{ old('duration_hours', floor(($listing->duration % 1440) / 60)) }}"
                min="0" max="23" placeholder="0"
                class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-center focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300" required>
            <span class="absolute bottom-1 left-1/2 transform -translate-x-1/2 text-xs text-gray-500 bg-white px-2 rounded">Hours</span>
        </div>

        <!-- Minutes -->
        <div class="relative">
            <input type="number" id="duration_minutes" name="duration_minutes"
                value="{{ old('duration_minutes', $listing->duration % 60) }}"
                min="0" max="59" placeholder="0"
                class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-center focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300" required>
            <span class="absolute bottom-1 left-1/2 transform -translate-x-1/2 text-xs text-gray-500 bg-white px-2 rounded">Minutes</span>
        </div>
    </div>
    <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-lg">
        <p class="text-sm text-amber-700 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Total duration cannot exceed 3 days
        </p>
    </div>
</div>


                <!-- Info -->
                <div class="group">
                    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
                        <span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>
                        Description & Information
                    </label>
                    <div class="relative">
                        <textarea name="info" rows="5"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 bg-gray-50 text-gray-800 transition-all duration-300 hover:border-gray-300 resize-none"
                            placeholder="Describe your gold item in detail...">{{ old('info', $listing->info) }}</textarea>
                    </div>
                </div>

               <!-- Image Upload -->
<div class="group">
    <label class="block font-semibold text-gray-800 mb-3 flex items-center">
        <span class="w-2 h-2 bg-pink-400 rounded-full mr-2"></span>
        Upload Image
        <span class="ml-2 text-sm font-normal text-gray-500">(Optional)</span>
    </label>
    <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-yellow-400 transition-colors duration-300 group-hover:bg-yellow-50">
        <!-- Display existing image if available -->
        @if($listing->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $listing->image) }}" alt="Current Image" class="mx-auto h-32 w-32 object-cover rounded-lg">
            </div>
        @endif

        <input type="file" name="image" id="image-upload"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-yellow-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="mt-4">
                <label for="image-upload" class="cursor-pointer">
                    <span class="mt-2 block text-sm font-medium text-gray-900 group-hover:text-yellow-600">
                        Click to upload or drag and drop
                    </span>
                    <span class="mt-1 block text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>


                <!-- Submit Button -->
                <div class="pt-8">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-yellow-300 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span>Update Gold Listing</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
