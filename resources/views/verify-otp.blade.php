@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    @if(session('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="mb-4 text-blue-600">{{ session('info') }}</div>
    @endif

    <h2 class="text-xl font-bold mb-4">Verify Your Phone Number</h2>
    <form method="POST" action="{{ route('profile.otp.verify') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">OTP Code</label>
            <input type="text" name="otp" class="mt-1 block w-full border px-3 py-2 rounded-md" required>
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">Verify</button>
    </form>
</div>
@endsection
