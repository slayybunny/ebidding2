<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - No One Is Left Behind</title>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #cd853f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.08)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.06)"/><circle cx="90" cy="10" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="90" r="1" fill="rgba(255,255,255,0.05)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1100px;
            width: 100%;
            height: calc(100vh - 30px);
            max-height: 650px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Left side - Full image display */
        .banner-section {
            position: relative;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-image {
            max-width: 90%;
            max-height: 90%;
            width: auto;
            height: auto;
            object-fit: contain;
            object-position: center;
            background: white;
        }

        /* Brand overlay on image */
        .brand-overlay {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(15px);
            z-index: 3;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .brand-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Right side - Login form */
        .login-section {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 35px;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
        }

        .welcome-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #b8860b, #daa520);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            color: #6b7280;
            font-size: 15px;
            font-weight: 500;
        }

        .form-group {
            position: relative;
            margin-bottom: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px 14px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #f9fafb;
            color: #1f2937;
            height: 50px;
            line-height: 1.4;
        }

        .form-group input:focus {
            outline: none;
            border-color: #daa520;
            background: white;
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
            transform: translateY(-1px);
        }

        .form-group .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
            transition: color 0.3s ease;
            width: 16px;
            height: 16px;
            line-height: 16px;
            text-align: center;
        }

        .form-group input:focus + .icon {
            color: #daa520;
        }

        .form-group input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #daa520;
            cursor: pointer;
        }

        .remember-me label {
            font-size: 13px;
            font-weight: 500;
            color: #4b5563;
            cursor: pointer;
        }

        .forgot-password {
            color: #b8860b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #996f00;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #b8860b, #daa520);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(184, 134, 11, 0.3);
            position: relative;
            overflow: hidden;
            height: 50px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn i {
            margin-right: 6px;
        }

        /* Validation styles - Compact */
        .form-group.success input {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .form-group.success .icon {
            color: #10b981;
        }

        .form-group.error input {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .form-group.error .icon {
            color: #ef4444;
        }

        /* Compact validation message - no positioning to avoid overflow */
        .validation-message {
            font-size: 11px;
            font-weight: 500;
            margin-top: 3px;
            min-height: 14px;
        }

        .validation-message.success {
            color: #10b981;
        }

        .validation-message.error {
            color: #ef4444;
        }

        /* Loading state */
        .login-btn.loading {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .login-btn.loading:hover {
            transform: none;
            box-shadow: 0 6px 20px rgba(156, 163, 175, 0.3);
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 12px 20px;
            border-radius: 10px;
            z-index: 1000;
            font-weight: 600;
            font-size: 14px;
            animation: slideInRight 0.5s ease-out;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .notification.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .notification.info {
            background: linear-gradient(135deg, #b8860b, #daa520);
            color: white;
        }

        .notification.warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                grid-template-columns: 1fr;
                height: calc(100vh - 20px);
                max-height: none;
            }

            .banner-section {
                min-height: 200px;
                padding: 0;
            }

            .image-container {
                height: 100%;
                max-width: none;
            }

            .brand-overlay {
                bottom: 10px;
                left: 10px;
                right: 10px;
                padding: 12px;
            }

            .brand-title {
                font-size: 16px;
            }

            .brand-subtitle {
                font-size: 12px;
            }

            .login-section {
                padding: 25px 20px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .welcome-header {
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-options {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 5px;
            }

            .login-section {
                padding: 20px 15px;
            }

            .welcome-title {
                font-size: 22px;
            }
        }

        /* Animations */
        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .banner-section {
            animation: slideInFromLeft 0.8s ease-out;
        }

        .login-section {
            animation: slideInFromRight 0.8s ease-out;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }

        .form-options {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .login-btn {
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }
        .login-btn.loading {
    background: #9ca3af;
    cursor: not-allowed;
}

    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section - Image -->
        <div class="banner-section">
            <div class="image-container">
                <img src="/images/main.jpg" alt="No One Is Left Behind" class="banner-image">

            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="login-section">
            <div class="login-container">

            {{-- ✅ NOTIFIKASI LOGIN --}}
            @if(session('error'))
                <div class="notification warning">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="notification success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

                <div class="welcome-header">
                    <h1 class="welcome-title">Welcome Back!</h1>
                    <p class="welcome-subtitle">Please sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('admin.login') }}">
    @csrf

                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter your username" required>
                        <i class="fas fa-user icon"></i>
                        <div class="validation-message" id="username-msg"></div>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter your password" required>
                        <i class="fas fa-lock icon"></i>
                        <div class="validation-message" id="password-msg"></div>
                    </div>

                    <div class="form-group">
                        <input type="password" id="repassword" placeholder="Confirm your password" required>
                        <i class="fas fa-shield-alt icon"></i>
                        <div class="validation-message" id="repassword-msg"></div>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form validation
        function showValidation(element, type, message) {
            const formGroup = element.parentElement;
            const messageEl = formGroup.querySelector('.validation-message');

            formGroup.className = `form-group ${type}`;
            messageEl.className = `validation-message ${type}`;
            messageEl.textContent = message;
        }

        function clearValidation(element) {
            const formGroup = element.parentElement;
            const messageEl = formGroup.querySelector('.validation-message');

            formGroup.className = 'form-group';
            messageEl.className = 'validation-message';
            messageEl.textContent = '';
        }

        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const repassword = document.getElementById('repassword').value;

            let isValid = true;

            // Username validation
            if (!username) {
                showValidation(document.getElementById('username'), 'error', 'Username is required');
                isValid = false;
            } else if (username.length < 3) {
                showValidation(document.getElementById('username'), 'error', 'Username must be at least 3 characters');
                isValid = false;
            } else {
                showValidation(document.getElementById('username'), 'success', 'Looks good!');
            }

            // Password validation
            if (!password) {
                showValidation(document.getElementById('password'), 'error', 'Password is required');
                isValid = false;
            } else if (password.length < 6) {
                showValidation(document.getElementById('password'), 'error', 'Password must be at least 6 characters');
                isValid = false;
            } else {
                showValidation(document.getElementById('password'), 'success', 'Strong password!');
            }

            // Re-password validation
            if (!repassword) {
                showValidation(document.getElementById('repassword'), 'error', 'Please confirm your password');
                isValid = false;
            } else if (password !== repassword) {
                showValidation(document.getElementById('repassword'), 'error', 'Passwords do not match');
                isValid = false;
            } else {
                showValidation(document.getElementById('repassword'), 'success', 'Passwords match!');
            }

            if (isValid) {
                // Success animation
                const button = document.querySelector('.login-btn');
                const originalText = button.innerHTML;

                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
                button.classList.add('loading');
                button.disabled = true;

                setTimeout(() => {
                    showNotification('success', `<i class="fas fa-check-circle"></i> Welcome back, ${username}!`);

                    button.innerHTML = originalText;
                    button.classList.remove('loading');
                    button.disabled = false;
                }, 2000);
            }
        });

        // Real-time validation
        document.getElementById('username').addEventListener('input', function() {
            const value = this.value;
            if (value.length === 0) {
                clearValidation(this);
            } else if (value.length < 3) {
                showValidation(this, 'error', 'Username must be at least 3 characters');
            } else {
                showValidation(this, 'success', 'Looks good!');
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            const value = this.value;
            if (value.length === 0) {
                clearValidation(this);
            } else if (value.length < 6) {
                showValidation(this, 'error', 'Password must be at least 6 characters');
            } else {
                showValidation(this, 'success', 'Strong password!');
            }

            // Re-validate re-password if it has value
            const repassword = document.getElementById('repassword');
            if (repassword.value) {
                if (value === repassword.value) {
                    showValidation(repassword, 'success', 'Passwords match!');
                } else {
                    showValidation(repassword, 'error', 'Passwords do not match');
                }
            }
        });

        document.getElementById('repassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const value = this.value;

            if (value.length === 0) {
                clearValidation(this);
            } else if (password !== value) {
                showValidation(this, 'error', 'Passwords do not match');
            } else {
                showValidation(this, 'success', 'Passwords match!');
            }
        });

        // Enhanced input interactions
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Forgot password handler
        document.querySelector('.forgot-password').addEventListener('click', function(e) {
            e.preventDefault();
            showNotification('warning', `<i class="fas fa-key"></i> Password recovery feature coming soon!`);
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const button = form.querySelector(".login-btn");

        form.addEventListener("submit", function () {
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
            button.classList.add("loading");
            button.disabled = true;
        });
    });
</script>

</body>
</html>