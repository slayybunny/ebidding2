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
        #create-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #create-btn.disabled {
        background-color: #ccc;
        cursor: not-allowed;
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
            <!-- Password -->
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div id="password-help" style="margin-top: 5px; font-size: 13px; display: none;"></div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                <div id="confirm-password-help" style="margin-top: 5px; font-size: 13px; display: none;"></div>
            </div>


            </div>

            <div class="form-group">
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="user_admin" {{ old('role') == 'user_admin' ? 'selected' : '' }}>User Admin</option>
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
    const passwordInput = document.getElementById("password");
    const passwordHelp = document.getElementById("password-help");
    const confirmPasswordInput = document.getElementById("password_confirmation");
    const confirmPasswordHelp = document.getElementById("confirm-password-help");

    // Password strength message
    passwordInput.addEventListener("input", function () {
        const value = this.value;
        let msg = "";

        const hasUpper = /[A-Z]/.test(value);
        const hasLower = /[a-z]/.test(value);
        const hasNumber = /[0-9]/.test(value);
        const hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(value);

        if (value.length < 8) {
            msg = "Too short, minimum 8 characters";
        } else if (!hasUpper || !hasLower || !hasNumber || !hasSymbol) {
            msg = "Add uppercase, lowercase, number & symbol";
        } else {
            msg = "Strong password";
        }

        passwordHelp.textContent = msg;
        passwordHelp.style.color = msg === "Strong password" ? "#28a745" : "#dc3545";
        passwordHelp.style.display = "block";
    });

    passwordInput.addEventListener("focus", function () {
        if (this.value !== "") passwordHelp.style.display = "block";
    });

    passwordInput.addEventListener("blur", function () {
        passwordHelp.style.display = "none";
    });

    // Confirm password match
    function checkConfirmPassword() {
        const passwordValue = passwordInput.value;
        const confirmValue = confirmPasswordInput.value;

        if (confirmValue === "") {
            confirmPasswordHelp.textContent = "Please re-enter your password";
            confirmPasswordHelp.style.color = "#dc3545";
        } else if (confirmValue !== passwordValue) {
            confirmPasswordHelp.textContent = "Passwords do not match";
            confirmPasswordHelp.style.color = "#dc3545";
        } else {
            confirmPasswordHelp.textContent = "Passwords match";
            confirmPasswordHelp.style.color = "#28a745";
        }

        confirmPasswordHelp.style.display = "block";
    }

    confirmPasswordInput.addEventListener("input", checkConfirmPassword);
    confirmPasswordInput.addEventListener("focus", checkConfirmPassword);
    confirmPasswordInput.addEventListener("blur", function () {
        confirmPasswordHelp.style.display = "none";
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const emailHelp = document.getElementById("email-help");

    function validateEmail() {
        const value = emailInput.value;

        if (value === "") {
            emailHelp.style.display = "none";
            return;
        }

        if (!value.includes("@")) {
            emailHelp.textContent = "Please enter a valid email (must contain @)";
            emailHelp.style.color = "#dc3545";
            emailHelp.style.display = "block";
        } else {
            emailHelp.textContent = "Valid email format";
            emailHelp.style.color = "#28a745";
            emailHelp.style.display = "block";
        }
    }

    emailInput.addEventListener("input", validateEmail);
    emailInput.addEventListener("focus", validateEmail);
    emailInput.addEventListener("blur", function () {
        emailHelp.style.display = "none";
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const emailHelp = document.getElementById("email-help");

    const passwordInput = document.getElementById("password");
    const passwordHelp = document.getElementById("password-help");

    const confirmPasswordInput = document.getElementById("password_confirmation");
    const confirmPasswordHelp = document.getElementById("confirm-password-help");

    const agreeCheckbox = document.getElementById("agree");
    const createBtn = document.getElementById("create-btn");

    // Validate email
    function validateEmail() {
        const value = emailInput.value;
        if (value === "") {
            emailHelp.style.display = "none";
            return false;
        }
        if (!value.includes("@")) {
            emailHelp.textContent = "Please enter a valid email (must contain @)";
            emailHelp.style.color = "#dc3545";
            emailHelp.style.display = "block";
            return false;
        } else {
            emailHelp.textContent = "Valid email format";
            emailHelp.style.color = "#28a745";
            emailHelp.style.display = "block";
            return true;
        }
    }

    // Validate password
    function validatePassword() {
        const value = passwordInput.value;
        let msg = "";

        const hasUpper = /[A-Z]/.test(value);
        const hasLower = /[a-z]/.test(value);
        const hasNumber = /[0-9]/.test(value);
        const hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(value);

        if (value.length < 8) {
            msg = "Too short, minimum 8 characters";
        } else if (!hasUpper || !hasLower || !hasNumber || !hasSymbol) {
            msg = "Add uppercase, lowercase, number & symbol";
        } else {
            msg = "Strong password";
        }

        passwordHelp.textContent = msg;
        passwordHelp.style.color = msg === "Strong password" ? "#28a745" : "#dc3545";
        passwordHelp.style.display = "block";

        return msg === "Strong password";
    }

    // Validate confirm password
    function validateConfirmPassword() {
        const passwordValue = passwordInput.value;
        const confirmValue = confirmPasswordInput.value;

        if (confirmValue === "") {
            confirmPasswordHelp.textContent = "Please re-enter your password";
            confirmPasswordHelp.style.color = "#dc3545";
        } else if (confirmValue !== passwordValue) {
            confirmPasswordHelp.textContent = "Passwords do not match";
            confirmPasswordHelp.style.color = "#dc3545";
        } else {
            confirmPasswordHelp.textContent = "Passwords match";
            confirmPasswordHelp.style.color = "#28a745";
        }

        confirmPasswordHelp.style.display = "block";
        return confirmValue === passwordValue && confirmValue !== "";
    }

    // Enable/disable button with style
    function toggleCreateButton() {
        const emailValid = validateEmail();
        const passwordValid = validatePassword();
        const confirmValid = validateConfirmPassword();
        const checkboxChecked = agreeCheckbox.checked;

        if (emailValid && passwordValid && confirmValid && checkboxChecked) {
            createBtn.disabled = false;
            createBtn.classList.remove("disabled");
        } else {
            createBtn.disabled = true;
            createBtn.classList.add("disabled");
        }
    }

    // Event listeners
    emailInput.addEventListener("input", () => {
        validateEmail();
        toggleCreateButton();
    });

    passwordInput.addEventListener("input", () => {
        validatePassword();
        toggleCreateButton();
    });

    confirmPasswordInput.addEventListener("input", () => {
        validateConfirmPassword();
        toggleCreateButton();
    });

    agreeCheckbox.addEventListener("change", toggleCreateButton);

    // Optional: hide helps on blur
    [emailInput, passwordInput, confirmPasswordInput].forEach(input => {
        input.addEventListener("blur", () => {
            const help = input.nextElementSibling;
            help.style.display = "none";
        });
    });

    // Optional: show helps on focus
    [emailInput, passwordInput, confirmPasswordInput].forEach(input => {
        input.addEventListener("focus", () => {
            const help = input.nextElementSibling;
            if (input.value !== "") help.style.display = "block";
        });
    });
});
</script>



</body>
</html>