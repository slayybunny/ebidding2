<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - No One Is Left Behind</title>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #cd853f 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            height: 90vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .banner {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .banner img {
            width: 100%;
            max-width: 90%;
        }

        .form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
            overflow-y: auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 600;
            color: #b8860b;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            background: #f8f9fa;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #b8860b;
            background: white;
            box-shadow: 0 0 0 2px rgba(184, 134, 11, 0.1);
        }

        .form-group .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-group input:focus + .icon,
        .form-group select:focus + .icon {
            color: #b8860b;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-check {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 15px 0;
            font-size: 14px;
            line-height: 1.4;
        }

        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            accent-color: #b8860b;
        }

        .form-check label {
            color: #555;
        }

        .form-check a {
            color: #b8860b;
            text-decoration: none;
            font-weight: 500;
        }

        .form-check a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            background: linear-gradient(135deg, #b8860b, #daa520);
            border: none;
            color: white;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(135deg, #a77900, #c79400);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .text-center {
            text-align: center;
            margin-top: 15px;
            color: #666;
        }

        .text-center a {
            color: #b8860b;
            text-decoration: none;
            font-weight: 500;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                margin: 10px;
            }

            .banner {
                min-height: 200px;
            }

            .banner-content i {
                font-size: 60px;
            }

            .banner-content h3 {
                font-size: 24px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-header h2 {
                font-size: 24px;
            }
        }

        /* Input filled state */
        .form-group input.filled,
        .form-group select.filled {
            border-color: #28a745;
            background: #f8fff9;
        }

        .form-group input.filled + .icon,
        .form-group select.filled + .icon {
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Banner Image -->
    <div class="banner">
        <img src="/images/main.jpg" alt="No One Is Left Behind">
    </div>

    <!-- Registration Form -->
    <div class="form-container">
        <div class="form-header">
            <h2>Create Admin Account</h2>
            <p>Please fill in the following information to create an account</p>
        </div>

        <form method="POST" action="{{ route('admin.register.store') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                    <i class="fas fa-user icon"></i>
                    @error('first_name') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                    <i class="fas fa-user icon"></i>
                    @error('last_name') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    <i class="fas fa-envelope icon"></i>
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    <i class="fas fa-at icon"></i>
                    @error('username') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fas fa-lock icon"></i>
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    <i class="fas fa-shield-alt icon"></i>
                </div>
            </div>

            <div class="form-group">
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="content_admin" {{ old('role') == 'content_admin' ? 'selected' : '' }}>Content Admin</option>
                    <option value="user_admin" {{ old('role') == 'user_admin' ? 'selected' : '' }}>User Admin</option>
                    <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                </select>
                <i class="fas fa-crown icon"></i>
                @error('role') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" id="terms" required>
                <label for="terms">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                </label>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <div class="text-center">
            Already have an account? <a href="{{ route('admin.login') }}">Sign In</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const termsCheckbox = document.getElementById("terms");
        const submitBtn = document.querySelector(".btn");

        // Prevent form submission if terms not checked
        form.addEventListener("submit", function (e) {
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert("You must agree to the Terms of Service and Privacy Policy.");
                termsCheckbox.focus();
                return;
            }

            // Add loading state
            submitBtn.classList.add("loading");
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        });

        // Input validation and styling
        const inputs = document.querySelectorAll("input, select");
        inputs.forEach(input => {
            input.addEventListener("input", function() {
                if (this.value.trim() !== "") {
                    this.classList.add("filled");
                } else {
                    this.classList.remove("filled");
                }
            });

            // Add focus animation
            input.addEventListener("focus", function() {
                this.parentElement.style.transform = "scale(1.02)";
            });

            input.addEventListener("blur", function() {
                this.parentElement.style.transform = "scale(1)";
            });
        });

        // Password strength indicator
        const passwordInput = document.querySelector('input[name="password"]');
        const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');

        if (passwordInput && confirmPasswordInput) {
            confirmPasswordInput.addEventListener("input", function() {
                if (this.value !== passwordInput.value && this.value !== "") {
                    this.style.borderColor = "#e53e3e";
                } else if (this.value === passwordInput.value && this.value !== "") {
                    this.style.borderColor = "#48bb78";
                } else {
                    this.style.borderColor = "#e2e8f0";
                }
            });
        }

        // Smooth scroll to error
        const firstError = document.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

</body>
</html>