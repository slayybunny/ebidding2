<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Members</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

   <style>
    body {
        background: #fff;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .form-container {
        background: #ffffff;
        border-radius: 24px;
        max-width: 420px;
        width: 100%;
        padding: 2rem;
        box-shadow:
            0 0 0 1px rgba(0,0,0,0.05),
            0 4px 6px -1px rgba(0,0,0,0.1),
            0 20px 40px -4px rgba(0,0,0,0.05);
        position: relative;
    }
    .form-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        right: 0; height: 5px;
        background: linear-gradient(90deg, #fbbf24, #f59e0b, #d97706, #b45309);
        border-radius: 24px 24px 0 0;
    }
    .input-field {
        width: 100%;
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px 20px;
        font-size: 15px;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease;
    }
    .input-field:focus {
        border-color: #f59e0b;
        outline: none;
        box-shadow: 0 0 0 3px rgba(251,191,36,0.15);
    }
    .error-message {
        font-size: 13px;
        color: #dc2626;
        margin-bottom: 0.75rem;
        display: none;
    }
    .btn-login {
        background: linear-gradient(135deg, #92400e, #d97706, #fbbf24);
        border-radius: 16px;
        font-weight: 700;
        color: white;
        padding: 1rem;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(146,64,14,0.4);
    }
    .input-with-toggle {
    padding-right: 40px; /* cukup untuk icon saja */
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

    .input-group {
        position: relative;
    }
    .form-title {
        background: linear-gradient(135deg, #92400e 0%, #b45309 25%, #d97706 50%, #f59e0b 75%, #fbbf24 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 4px;
        text-align: center;
    }
    .form-subtitle {
        color: #6b7280;
        font-size: 15px;
        font-weight: 500;
        text-align: center;
        margin-bottom: 1.5rem;
    }
</style>

</head>
<body>

<form method="POST" action="/login" class="form-container">
    @csrf  {{-- INI PENTING --}}

@if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif



        <img src="/images/logo-sgcc.png" alt="SGCC Logo" class="w-24 mx-auto mb-4">
        <h1 class="text-xl font-bold text-gray-800">LOGIN MEMBERS</h1>
        <p class="text-gray-500 text-sm">Welcome back to our community</p>
    </div>

    <select id="category" name="category" onchange="toggleFields()" class="input-field">
        <option value="">CATEGORIES</option>
        <option value="WARGANEGARA MALAYSIA">WARGANEGARA MALAYSIA</option>
        <option value="BUKAN WARGANEGARA">BUKAN WARGANEGARA</option>
    </select>
    <div id="category-error" class="error-message">Please select a category</div>

    <input type="text" id="mykadField" name="mykad" placeholder="MYKAD" maxlength="12"
           class="input-field hidden" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
    <div id="mykad-error" class="error-message">MyKad must be exactly 12 digits</div>

    <input type="text" id="passportField" name="passport" placeholder="PASSPORT NO." maxlength="9"
           class="input-field hidden" oninput="this.value=this.value.replace(/[^a-zA-Z0-9]/g,'')">
    <div id="passport-error" class="error-message">Passport must be 6–9 characters (letters/numbers)</div>

    <div class="input-group">
        <input type="password" id="current_password" name="password" placeholder="PASSWORD" class="input-field">
        <button type="button" class="toggle-password" data-target="current_password" aria-label="Show password">
            <!-- Eye icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Eye off icon (hidden by default) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-closed hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a9.964 9.964 0 012.158-3.304M9.88 9.88a3 3 0 104.24 4.24M3 3l18 18" />
            </svg>
        </button>
    </div>
    <div id="password-error" class="error-message">
        Password must be at least 8 characters, include uppercase, lowercase, and a number
    </div>

    <button type="submit" class="btn-login mt-4">Login</button>

    <div class="text-center mt-6 space-y-3">
        <a href="#" class="text-sm text-gray-500 hover:text-yellow-700">Forgot Password?</a>
        <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="/register" class="text-yellow-600 font-semibold hover:text-yellow-800">Register Here</a>
        </p>
    </div>
</form>

<script>
    function toggleFields() {
        const category = document.getElementById('category').value;
        document.getElementById('mykadField').classList.toggle('hidden', category !== 'WARGANEGARA MALAYSIA');
        document.getElementById('passportField').classList.toggle('hidden', category !== 'BUKAN WARGANEGARA');
    }

    document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        const eyeOpen = btn.querySelector('.eye-open');
        const eyeClosed = btn.querySelector('.eye-closed');

        if (target.type === 'password') {
            target.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            target.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    });
});


    // Real-time validation
    document.getElementById('category').addEventListener('input', function () {
        document.getElementById('category-error').style.display = this.value ? 'none' : 'block';
    });

    document.getElementById('mykadField').addEventListener('input', function () {
        document.getElementById('mykad-error').style.display = /^\d{12}$/.test(this.value) ? 'none' : 'block';
    });

    document.getElementById('passportField').addEventListener('input', function () {
        document.getElementById('passport-error').style.display = /^[A-Za-z0-9]{6,9}$/.test(this.value) ? 'none' : 'block';
    });

    document.getElementById('current_password').addEventListener('input', function () {
        const pass = this.value;
        const valid = /[A-Z]/.test(pass) && /[a-z]/.test(pass) && /\d/.test(pass) && pass.length >= 8;
        document.getElementById('password-error').style.display = valid ? 'none' : 'block';
    });
</script>

</body>
</html>
