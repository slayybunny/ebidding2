@extends('layouts.app') {{-- Change if your layout is different --}}

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white rounded-xl shadow-md p-6">
    <h2 class="text-xl font-bold mb-4 text-center">Change Password</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('change-password.update') }}">
        @csrf

        <div class="mb-4">
            <label for="current_password" class="block font-medium">Current Password</label>
            <div class="relative">
                <input type="password" name="current_password" id="current_password" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <button type="button" class="absolute right-3 top-2.5 text-sm text-gray-600 toggle-password"
                    data-target="current_password">Show</button>
            </div>
        </div>

        <div class="mb-4">
            <label for="new_password" class="block font-medium">New Password</label>
            <div class="relative">
                <input type="password" name="new_password" id="new_password" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <button type="button" class="absolute right-3 top-2.5 text-sm text-gray-600 toggle-password"
                    data-target="new_password">Show</button>
            </div>
        </div>

        <div class="mb-6">
            <label for="new_password_confirmation" class="block font-medium">Confirm New Password</label>
            <div class="relative">
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <button type="button" class="absolute right-3 top-2.5 text-sm text-gray-600 toggle-password"
                    data-target="new_password_confirmation">Show</button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md">
            Update Password
        </button>
    </form>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input.type === 'password') {
                input.type = 'text';
                this.innerText = 'Hide';
            } else {
                input.type = 'password';
                this.innerText = 'Show';
            }
        });
    });
</script>
@endsection
