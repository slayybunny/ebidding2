@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Compact Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-r from-amber-600 to-yellow-600 rounded-xl mb-4 shadow-md">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Gold Listing Registration</h1>
            <p class="text-gray-600 text-sm mt-1">Professional precious metals auction platform</p>
        </div>

        <!-- Messages Section -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm shadow-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm shadow-sm">
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
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-amber-600 to-yellow-600 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 opacity-90" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                    </svg>
                    Item Registration Form
                </h2>
            </div>

            <form action="{{ route('store-listing') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Item Name -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Item Name *</label>
                        <input type="text" name="item" value="{{ old('item') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50"
                            placeholder="Enter item name" required>
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Type *</label>
                        <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50" required>
                            <option value="" disabled selected>Select type</option>
                            <option value="gold" {{ old('type') == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="silver" {{ old('type') == 'silver' ? 'selected' : '' }}>Silver</option>
                            <option value="car" {{ old('type') == 'car' ? 'selected' : '' }}>Car</option>
                            <option value="motor" {{ old('type') == 'motor' ? 'selected' : '' }}>Motor</option>
                        </select>
                    </div>

                    <!-- Currency -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Currency *</label>
                        <select name="currency" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50" required>
                            <option value="MYR" {{ old('currency') == 'MYR' ? 'selected' : '' }}>MYR - Malaysian Ringgit</option>
                            <option value="IDR" {{ old('currency') == 'IDR' ? 'selected' : '' }}>IDR - Indonesian Rupiah</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Price *</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50"
                            placeholder="0.00" required>
                    </div>

                    <!-- Starting Price -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Starting Bid *</label>
                        <input type="number" name="starting_price" step="0.01" value="{{ old('starting_price') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50"
                            placeholder="0.00" required>
                    </div>

                    <!-- Bidding Start Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bidding Start Date *</label>
                        <input type="date" name="start_date"
                            value="{{ old('start_date') }}"
                            min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50"
                            required>
                    </div>

                    <!-- Bidding End Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bidding End Date *</label>
                        <input type="date" name="end_date"
                            value="{{ old('end_date') }}"
                            min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50"
                            required>
                    </div>
                </div>

                <!-- Bidding Duration Section -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Bidding Time *</label>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <input type="time" name="start_time" value="{{ old('start_time') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50" required>
                            <label class="block text-xs text-gray-500 text-center mt-2">Start Time</label>
                        </div>
                        <div>
                            <input type="time" name="end_time" value="{{ old('end_time') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50" required>
                            <label class="block text-xs text-gray-500 text-center mt-2">End Time</label>
                        </div>
                    </div>
                </div>

                <!-- Description and Image Upload -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description & Information *</label>
                        <textarea name="info" rows="6"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-gray-50 resize-none"
                            placeholder="Describe your item in detail..." required>{{ old('info') }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Image (Optional)</label>
                        <div id="upload-box" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-amber-400 transition-colors">
                            <input type="file" name="image" id="image-upload" class="hidden" accept="image/*" />
                            <label for="image-upload" class="cursor-pointer block">
                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm text-gray-600">Click to upload</span>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                            </label>

                            <!-- Preview -->
                            <div id="preview-container" class="mt-4 hidden">
                                <img id="preview-image" src="" alt="Preview" class="mx-auto rounded-md shadow-sm max-h-24" />
                                <p id="file-name" class="mt-2 text-gray-700 text-xs"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span>Submit Listing</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const imageInput = document.getElementById('image-upload');
const previewContainer = document.getElementById('preview-container');
const previewImage = document.getElementById('preview-image');
const fileNameDisplay = document.getElementById('file-name');

imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();

        reader.addEventListener('load', function() {
            previewImage.setAttribute('src', this.result);
            previewContainer.classList.remove('hidden');
        });

        reader.readAsDataURL(file);
        fileNameDisplay.textContent = file.name;
    } else {
        previewContainer.classList.add('hidden');
        previewImage.setAttribute('src', '');
        fileNameDisplay.textContent = '';
    }
});
</script>
@endsection
