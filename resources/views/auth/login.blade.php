<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Members</title>
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            position: relative;
        }

        /* Subtle decorative background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 20%, rgba(251, 191, 36, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(217, 119, 6, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 40% 90%, rgba(245, 158, 11, 0.02) 0%, transparent 50%);
            z-index: -2;
        }

        /* Geometric pattern overlay */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(90deg, rgba(0, 0, 0, 0.01) 1px, transparent 1px),
                linear-gradient(rgba(0, 0, 0, 0.01) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -1;
        }

        .form-container {
            background: #ffffff;
            box-shadow:
                0 0 0 1px rgba(0, 0, 0, 0.05),
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06),
                0 20px 40px -4px rgba(0, 0, 0, 0.05);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b, #d97706, #b45309);
            border-radius: 24px 24px 0 0;
        }

        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 15px;
            font-weight: 500;
            color: #1f2937;
            position: relative;
        }

        .input-field:focus {
            transform: translateY(-1px);
            box-shadow:
                0 0 0 3px rgba(251, 191, 36, 0.15),
                0 4px 12px rgba(217, 119, 6, 0.1);
            border-color: #f59e0b;
            outline: none;
            background: #ffffff;
        }

        .input-field::placeholder {
            color: #9ca3af;
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, #92400e 0%, #b45309 25%, #d97706 50%, #f59e0b 75%, #fbbf24 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow:
                0 4px 15px rgba(146, 64, 14, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            border-radius: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px rgba(146, 64, 14, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        }

        .btn-login:hover::before {
            opacity: 1;
        }

        .btn-login span {
            position: relative;
            z-index: 1;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-down {
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            position: relative;
            display: inline-block;
        }

        .logo-container::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(45deg, #fbbf24, #f59e0b, #d97706, #b45309);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .logo-container:hover::before {
            opacity: 0.1;
        }

        .logo-glow {
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .logo-glow:hover {
            transform: scale(1.05);
        }

        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 16px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 48px;
        }

        .alert-box {
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 14px;
            position: relative;
            overflow: hidden;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.05) 100%);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.05) 100%);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .recaptcha-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            padding: 20px;
            background: rgba(249, 250, 251, 0.5);
            border-radius: 16px;
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .recaptcha-container>div {
            transform: scale(0.9);
            transform-origin: center;
        }

        .compact-spacing {
            margin-bottom: 16px;
        }

        .title-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .title-section h1 {
            background: linear-gradient(135deg, #92400e 0%, #b45309 25%, #d97706 50%, #f59e0b 75%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .title-section p {
            color: #6b7280;
            font-size: 16px;
            font-weight: 500;
        }

        .compact-form {
            padding: 40px;
            max-width: 450px;
            width: 100%;
        }

        .floating-decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.08) 0%, rgba(217, 119, 6, 0.05) 100%);
            animation: float 8s ease-in-out infinite;
            z-index: -1;
        }

        .floating-decoration:nth-child(1) {
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            bottom: -100px;
            left: -100px;
            animation-delay: 4s;
            width: 150px;
            height: 150px;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(180deg) scale(1.1);
                opacity: 1;
            }
        }

        .register-link {
            display: inline-block;
            position: relative;
            color: #d97706;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            transition: width 0.3s ease;
        }

        .register-link:hover::after {
            width: 100%;
        }

        .register-link:hover {
            color: #b45309;
            transform: translateY(-1px);
        }

        .forgot-link {
            display: inline-block;
            position: relative;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #d97706;
            transform: translateY(-1px);
        }

        /* Input field enhancements */
        .input-group {
            position: relative;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0;
        }

        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            background: white;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-checkbox:checked {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            border-color: #f59e0b;
        }

        .custom-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .checkbox-label {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .compact-form {
                padding: 24px;
                margin: 16px;
            }

            .title-section h1 {
                font-size: 24px;
            }

            .input-field {
                padding: 14px 16px;
                font-size: 14px;
            }
        }

        @media (max-height: 700px) {
            .compact-form {
                padding: 24px;
            }

            .input-field {
                padding: 12px 16px;
                font-size: 14px;
            }

            .title-section h1 {
                font-size: 24px;
                margin-bottom: 4px;
            }
        }

        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleFields() {
            const category = document.getElementById('category').value;
            document.getElementById('mykadField').style.display = (category === 'WARGANEGARA MALAYSIA') ? 'block' : 'none';
            document.getElementById('passportField').style.display = (category === 'BUKAN WARGANEGARA') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>

    <div class="fade-in relative z-10">
        <div class="title-section">
            <div class="logo-container">
                <img src="/images/logo-sgcc.png" alt="SGCC Logo" class="w-24 mx-auto mb-4 logo-glow">
            </div>
            <h1>LOGIN MEMBERS</h1>
            <p>Welcome back to our community</p>
        </div>

        @if (session('success'))
            <div class="alert-box alert-success slide-down">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-box alert-error slide-down">
                <ul class="list-disc list-inside text-left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="form-container compact-form">
            @csrf

            <div class="space-y-4">
                <div class="input-group">
                    <select id="category" name="category" onchange="toggleFields()"
                        class="input-field w-full compact-spacing">
                        <option value="">CATEGORIES</option>
                        <option value="WARGANEGARA MALAYSIA">WARGANEGARA MALAYSIA</option>
                        <option value="BUKAN WARGANEGARA">BUKAN WARGANEGARA</option>
                    </select>
                </div>

                <input type="text" id="mykadField" name="mykad" placeholder="MYKAD" maxlength="12"
                    class="input-field w-full compact-spacing hidden"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                <input type="text" id="passportField" name="passport" placeholder="PASSPORT NO." maxlength="9"
                    class="input-field w-full compact-spacing hidden"
                    oninput="this.value=this.value.replace(/[^a-zA-Z0-9]/g,'')">

                <div class="input-group relative">
                    <input type="password" id="current_password" name="password" placeholder="PASSWORD"
                        class="input-field w-full compact-spacing">
                    <button type="button"
                        class="absolute right-5 top-4 text-sm text-gray-600 toggle-password"
                        data-target="current_password">Show</button>
                </div>


                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    <label class="text-gray-700 text-sm">Remember Me</label>
                </div>

                <div class="recaptcha-container">
                    {{-- <div class="g-recaptcha" data-sitekey="6LegUWIrAAAAAHAIBqcHs2x37o9bXEEUdQeZ6cBp"></div> --}}
                </div>

                <button type="submit" class="btn-login w-full py-4 mt-6">
                    <span>LOGIN</span>
                </button>

                <div class="text-center mt-6 space-y-3">
                    <a href="#" class="forgot-link text-sm block">Forgot Password?</a>
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="register-link ml-1">Register Here</a>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Add smooth focus transitions
        document.querySelectorAll('.input-field').forEach(field => {
            field.addEventListener('focus', function() {
                this.style.borderColor = '#f59e0b';
            });

            field.addEventListener('blur', function() {
                this.style.borderColor = '#e5e7eb';
            });
        });
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
</body>

</html>
