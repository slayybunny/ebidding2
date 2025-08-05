<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Members</title>
    {{--<script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        .btn-register {
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
        }

        .btn-register::before {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px rgba(146, 64, 14, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        }

        .btn-register:hover::before {
            opacity: 1;
        }

        .btn-register span {
            position: relative;
            z-index: 1;
        }

        .btn-register:active {
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
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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

        .recaptcha-container > div {
            transform: scale(0.9);
            transform-origin: center;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
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
            max-width: 550px;
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
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg) scale(1.1);
                opacity: 1;
            }
        }

        .login-link {
            display: inline-block;
            position: relative;
            color: #d97706;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            transition: width 0.3s ease;
        }

        .login-link:hover::after {
            width: 100%;
        }

        .login-link:hover {
            color: #b45309;
            transform: translateY(-1px);
        }

        /* Input field enhancements */
        .input-group {
            position: relative;
        }

        .input-field:focus + .input-focus-line {
            width: 100%;
        }

        .input-focus-line {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 0;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            transition: width 0.3s ease;
            border-radius: 0 0 16px 16px;
        }

        @media (max-width: 640px) {
            .compact-form {
                padding: 24px;
                margin: 16px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
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
    </style>
    <script>
        function toggleFields() {
            const category = document.getElementById('category').value;
            const mykadFields = document.getElementById('mykadFields');
            const passportFields = document.getElementById('passportFields');

            if (category === 'WARGANEGARA MALAYSIA') {
                mykadFields.classList.remove('hidden');
                mykadFields.classList.add('form-row', 'slide-down');
                passportFields.classList.add('hidden');
                passportFields.classList.remove('form-row', 'slide-down');
            } else if (category === 'BUKAN WARGANEGARA') {
                passportFields.classList.remove('hidden');
                passportFields.classList.add('form-row', 'slide-down');
                mykadFields.classList.add('hidden');
                mykadFields.classList.remove('form-row', 'slide-down');
            } else {
                mykadFields.classList.add('hidden');
                mykadFields.classList.remove('form-row', 'slide-down');
                passportFields.classList.add('hidden');
                passportFields.classList.remove('form-row', 'slide-down');
            }
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
            <h1>REGISTER MEMBERS</h1>
            <p>Join our community today</p>
        </div>

        <div id="alerts">
            <!-- Success/Error messages will appear here -->
        </div>

        <form method="POST" action="/register" class="form-container compact-form" id="registerForm" novalidate>
            @csrf
            <div class="space-y-4">
                <div class="input-group">
                    <select id="category" name="category" onchange="toggleFields()" class="input-field w-full compact-spacing" required>
                        <option value="">SELECT CATEGORY</option>
                        <option value="WARGANEGARA MALAYSIA">WARGANEGARA MALAYSIA</option>
                        <option value="BUKAN WARGANEGARA">BUKAN WARGANEGARA</option>
                    </select>
                </div>

                <div class="input-group">
                    <input type="text" name="name" placeholder="FULL NAME" maxlength="100" class="input-field w-full compact-spacing" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                </div>

                <div class="input-group">
                    <input type="text" name="phone" placeholder="PHONE NUMBER" maxlength="14" class="input-field w-full compact-spacing" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div id="mykadFields" class="compact-spacing hidden">
                    <div class="input-group">
                        <input type="text" name="mykad" placeholder="MYKAD" maxlength="12" class="input-field" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="input-group">
                        <input type="text" name="confirm_mykad" placeholder="CONFIRM MYKAD" maxlength="12" class="input-field" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>

                <div id="passportFields" class="compact-spacing hidden">
                    <div class="input-group">
                        <input type="text" name="passport" placeholder="PASSPORT NO." maxlength="9" class="input-field" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
                    </div>
                    <div class="input-group">
                        <input type="text" name="confirm_passport" placeholder="CONFIRM PASSPORT" maxlength="9" class="input-field" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
                    </div>
                </div>

                <div class="form-row compact-spacing">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="EMAIL" class="input-field" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email_confirmation" placeholder="CONFIRM EMAIL" class="input-field" required>
                    </div>
                </div>

                <div class="form-row compact-spacing">
    <div class="input-group relative">
        <input type="password" id="password" name="password" placeholder="PASSWORD" class="input-field" required>
        <button type="button" class="absolute right-3 top-2.5 text-sm text-gray-600 toggle-password"
            data-target="password">Show</button>
    </div>
    <div class="input-group relative">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="CONFIRM PASSWORD" class="input-field" required>
        <button type="button" class="absolute right-3 top-2.5 text-sm text-gray-600 toggle-password"
            data-target="password_confirmation">Show</button>
    </div>
</div>


                <button type="submit" class="btn-register w-full text-white py-4 mt-6 text-sm">
                    <span>REGISTER NOW</span>
                </button>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Already have an account?
                    <a href="/login" class="login-link ml-1">Login Here</a>
                </p>
            </div>
        </form>
    </div>

    <script>
    // Highlight input border on focus/blur
    document.querySelectorAll('.input-field').forEach(field => {
        field.addEventListener('focus', function() {
            this.style.borderColor = '#f59e0b';
        });

        field.addEventListener('blur', function() {
            this.style.borderColor = '#e5e7eb';
        });
    });

    // Toggle field based on category (MyKad/Passport)
    function toggleFields() {
        const category = document.getElementById('category').value;
        const mykadFields = document.getElementById('mykadFields');
        const passportFields = document.getElementById('passportFields');

        if (category === 'WARGANEGARA MALAYSIA') {
            mykadFields.classList.remove('hidden');
            mykadFields.classList.add('form-row', 'slide-down');
            passportFields.classList.add('hidden');
            passportFields.classList.remove('form-row', 'slide-down');
        } else if (category === 'BUKAN WARGANEGARA') {
            passportFields.classList.remove('hidden');
            passportFields.classList.add('form-row', 'slide-down');
            mykadFields.classList.add('hidden');
            mykadFields.classList.remove('form-row', 'slide-down');
        } else {
            mykadFields.classList.add('hidden');
            mykadFields.classList.remove('form-row', 'slide-down');
            passportFields.classList.add('hidden');
            passportFields.classList.remove('form-row', 'slide-down');
        }
    }
    document.addEventListener('DOMContentLoaded', toggleFields);

    // Validasi padanan sebelum submit
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("registerForm");

        form.addEventListener("submit", function (e) {
            const errors = [];

            const email = form.querySelector('input[name="email"]').value.trim();
            const emailConfirm = form.querySelector('input[name="email_confirmation"]').value.trim();

            const password = form.querySelector('input[name="password"]').value;
            const passwordConfirm = form.querySelector('input[name="password_confirmation"]').value;

            const category = form.querySelector('#category').value;

            const mykad = form.querySelector('input[name="mykad"]')?.value.trim();
            const confirmMykad = form.querySelector('input[name="confirm_mykad"]')?.value.trim();

            const passport = form.querySelector('input[name="passport"]')?.value.trim();
            const confirmPassport = form.querySelector('input[name="confirm_passport"]')?.value.trim();

            if (email !== emailConfirm) {
                errors.push("Email and Confirm Email do not match.");
            }

            if (password !== passwordConfirm) {
                errors.push("Password and Confirm Password do not match.");
            }

            if (category === "WARGANEGARA MALAYSIA" && mykad !== confirmMykad) {
                errors.push("MyKad and Confirm MyKad do not match.");
            }

            if (category === "BUKAN WARGANEGARA" && passport !== confirmPassport) {
                errors.push("Passport and Confirm Passport do not match.");
            }

            const alerts = document.getElementById('alerts');
            alerts.innerHTML = ''; // Clear previous messages

            if (errors.length > 0) {
                e.preventDefault(); // BLOCK form submission
                alerts.innerHTML = `
                    <div class="alert-box alert-error slide-down">
                        <ul class="list-disc list-inside space-y-1">
                            ${errors.map(err => `<li>${err}</li>`).join('')}
                        </ul>
                    </div>
                `;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
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
