@extends('layouts.app')

@section('content')
<div class="flex justify-center py-10 bg-gray-100">
    <!-- Main Content -->
    <main class="w-full max-w-4xl bg-white rounded-2xl shadow-md p-8">

        <!-- Flash message -->
        @if(session('success'))
            <div class="mb-4 text-green-600 font-medium text-sm bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Info Centered -->
<div class="flex flex-col items-center mb-6">
    <div class="w-28 h-28 rounded-full border-4 border-yellow-500 overflow-hidden">
        <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('images/main.jpg') }}"
             alt="" class="w-full h-full object-cover">
    </div>
    <h2 class="mt-4 text-xl font-semibold text-gray-800">{{ $member->name }}</h2>
    <p class="text-sm text-gray-500 uppercase">{{ $member->category }}</p>
</div>


        <!-- Upload / Delete Buttons -->
        <div class="flex justify-center items-center mb-6 gap-4">
            <!-- Upload -->
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md shadow">
                Upload Photo
            </button>

            <!-- Delete -->
            @if($member->photo)
                <form action="{{ route('profile.delete.photo') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow">
                        Delete Photo
                    </button>
                </form>
            @endif
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ $member->name }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $member->email }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-300">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($member->category == 'WARGANEGARA MALAYSIA')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">MyKad</label>
                        <input type="text" name="mykad" value="{{ $member->mykad }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                @else
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Passport</label>
                        <input type="text" name="passport" value="{{ $member->passport }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ $member->phone }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="address" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $member->address }}</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <button type="reset"
                        class="px-6 py-2 border border-yellow-500 text-yellow-500 rounded-md hover:bg-yellow-50">
                    Discard Changes
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    Save Changes
                </button>
            </div>
        </form>
    </main>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-sm relative">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Upload Profile Photo</h3>

        <form action="{{ route('profile.upload.photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" accept="image/*"
                   class="block w-full border border-gray-300 rounded-md mb-4 px-3 py-2">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 rounded-md">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    Upload
                </button>
            </div>
        </form>

        <button onclick="document.getElementById('uploadModal').classList.add('hidden')"
                class="absolute top-2 right-3 text-gray-500 text-xl font-bold">&times;</button>
    </div>
</div>
@endsection
