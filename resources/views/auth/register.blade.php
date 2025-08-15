<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Members</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ====== CSS ASAL + KEMASAN ====== */
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(circle at 20% 20%, rgba(251, 191, 36, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(217, 119, 6, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 40% 90%, rgba(245, 158, 11, 0.02) 0%, transparent 50%);
            z-index: -2;
        }
        body::after {
            content: '';
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background-image:
                linear-gradient(90deg, rgba(0,0,0,0.01) 1px, transparent 1px),
                linear-gradient(rgba(0,0,0,0.01) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -1;
        }

        .form-container {
            background: #ffffff;
            box-shadow:
                0 0 0 1px rgba(0,0,0,0.05),
                0 4px 6px -1px rgba(0,0,0,0.1),
                0 2px 4px -1px rgba(0,0,0,0.06),
                0 20px 40px -4px rgba(0,0,0,0.05);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }
        .form-container::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg,#fbbf24,#f59e0b,#d97706,#b45309);
            border-radius: 24px 24px 0 0;
        }

        /* Make all inputs consistent size */
        .input-field {
            transition: all .25s ease;
            background: #fff;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            font-weight: 500;
            color: #1f2937;
            width: 100%;
            box-sizing: border-box;
            height: 48px; /* consistent height */
        }
        .input-field::placeholder { color: #94a3b8; font-weight: 500; }
        .input-field:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245,158,11,0.06);
            outline: none;
        }
        /* Row with two equal columns */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn-register {
            background: linear-gradient(135deg, #92400e 0%, #b45309 25%, #d97706 50%, #f59e0b 75%, #fbbf24 100%);
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px;
            color: white;
            cursor: pointer;
            transition: all .2s ease;
        }
        .btn-register:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.12); }

        .text-error { font-size: .84rem; color: #dc2626; margin-top: 6px; display: none; }
        .text-success { font-size: .84rem; color: #16a34a; margin-top: 6px; display: none; }

        .strength-meter { height: 6px; border-radius: 6px; background: #eef2f7; margin-top: 8px; overflow: hidden; }
        .strength-bar { height: 100%; width: 0%; transition: width .25s ease, background-color .25s ease; }

        /* container for input+toggle to position button inside */
        .input-wrap { position: relative; width: 100%; }
        .input-with-toggle { padding-right: 76px; } /* space for the show button */
     .input-wrap {
    position: relative;
    min-height: 48px; /* lock height */
    display: flex;
    align-items: center;
}

.input-with-toggle {
  padding-right: 40px; /* ruang untuk icon */
  height: 48px;        /* lock height supaya tak berubah */
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 16px;
  line-height: 1;
}

.toggle-password:hover {
    color: #f59e0b;
}

        .toggle-password:active { transform: translateY(-50%) scale(.98); }

        .alert-box { border-radius: 12px; padding: 12px 16px; margin-bottom: 16px; font-weight: 500; }
        .alert-error { background: rgba(254,226,226,0.6); color: #991b1b; border: 1px solid rgba(239,68,68,0.12); }

        /* mobile */
        @media (max-width: 640px) {
            .form-row { grid-template-columns: 1fr; gap: 12px; }
        }

        .strength-text {
    font-size: 0.84rem;
    font-weight: 600;
    margin-top: 4px;
    display: none;
}
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

<div class="fade-in relative z-10" style="width:100%;max-width:720px">
    <div class="title-section text-center mb-6">
        <img src="/images/logo-sgcc.png" alt="SGCC Logo" class="w-24 mx-auto mb-4">
        <h1 style="font-weight:800; font-size:24px; margin-bottom:6px">REGISTER MEMBERS</h1>
        <p style="color:#6b7280; margin:0">Join our community today</p>
    </div>

     <!-- Alert Session -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert-box alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert-box alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/register" class="form-container compact-form p-6" id="registerForm" novalidate>
        @csrf
        <div class="space-y-4">

            <!-- category single full width -->
            <div>
                <select id="category" name="category" class="input-field" required>
                    <option value="">SELECT CATEGORY</option>
                    <option value="WARGANEGARA MALAYSIA">WARGANEGARA MALAYSIA</option>
                    <option value="BUKAN WARGANEGARA">BUKAN WARGANEGARA</option>
                </select>
                <div id="categoryError" class="text-error" aria-live="polite"></div>
            </div>

            <!-- name -->
            <div>
                <input id="name" name="name" type="text" placeholder="FULL NAME" class="input-field" maxlength="100" required
                       oninput="this.value=this.value.replace(/[^a-zA-Z\s]/g,'')">
                <div id="nameError" class="text-error" aria-live="polite"></div>
            </div>

            <!-- phone -->
            <div>
                <input id="phone" name="phone" type="text" placeholder="PHONE NUMBER" class="input-field" maxlength="14" required
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                <div id="phoneError" class="text-error" aria-live="polite"></div>
            </div>

            <!-- MYKAD / PASSPORT area: each uses form-row but container is hidden/shown; width matches password -->
            <div id="mykadFields" style="display:none">
                <div class="form-row">
                    <div>
                        <input id="mykad" name="mykad" type="text" placeholder="MYKAD" class="input-field" maxlength="12"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    </div>
                    <div>
                        <input id="confirm_mykad" name="confirm_mykad" type="text" placeholder="CONFIRM MYKAD" class="input-field" maxlength="12"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    </div>
                </div>
                <div id="confirmMykadError" class="text-error" aria-live="polite"></div>
            </div>

            <div id="passportFields" style="display:none">
                <div class="form-row">
                    <div>
                        <input id="passport" name="passport" type="text" placeholder="PASSPORT NO." class="input-field" maxlength="9"
                               oninput="this.value=this.value.replace(/[^a-zA-Z0-9]/g,'')">
                    </div>
                    <div>
                        <input id="confirm_passport" name="confirm_passport" type="text" placeholder="CONFIRM PASSPORT" class="input-field" maxlength="9"
                               oninput="this.value=this.value.replace(/[^a-zA-Z0-9]/g,'')">
                    </div>
                </div>
                <div id="confirmPassportError" class="text-error" aria-live="polite"></div>
            </div>

            <!-- Email row (two equal columns, same width as password) -->
            <div class="form-row">
                <div>
                    <input id="email" name="email" type="email" placeholder="EMAIL" class="input-field" required>
                </div>
                <div>
                    <input id="email_confirmation" name="email_confirmation" type="email" placeholder="CONFIRM EMAIL" class="input-field" required>
                </div>
            </div>
            <div id="emailConfirmError" class="text-error" aria-live="polite"></div>

<!-- PASSWORD & CONFIRM PASSWORD -->
<div class="form-row">
    <!-- Password -->
    <div>
        <div class="input-wrap">
            <input type="password" id="password" name="password"
                   placeholder="PASSWORD"
                   class="input-field input-with-toggle" required>
            <button type="button" class="toggle-password" data-target="password">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477
                             0 8.268 2.943 9.542 7-1.274 4.057-5.065
                             7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-closed hidden" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112
                             19c-4.478 0-8.269-2.944-9.543-7a9.964
                             9.964 0 012.158-3.304M9.88 9.88a3
                             3 0 104.24 4.24M3 3l18 18" />
                </svg>
            </button>
        </div>
        <div class="strength-meter"><div id="strengthBar" class="strength-bar"></div></div>
        <div id="strengthText" class="strength-text"></div>
        <div id="passwordError" class="text-error" aria-live="polite"></div>
    </div>

    <!-- Confirm Password -->
    <div>
        <div class="input-wrap">
            <input type="password" id="password_confirmation" name="password_confirmation"
                   placeholder="CONFIRM PASSWORD"
                   class="input-field input-with-toggle" required>
            <button type="button" class="toggle-password" data-target="password_confirmation">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477
                             0 8.268 2.943 9.542 7-1.274 4.057-5.065
                             7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-closed hidden" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112
                             19c-4.478 0-8.269-2.944-9.543-7a9.964
                             9.964 0 012.158-3.304M9.88 9.88a3
                             3 0 104.24 4.24M3 3l18 18" />
                </svg>
            </button>
        </div>
        <div id="passwordConfirmError" class="text-error" aria-live="polite"></div>
    </div>
</div>


<!-- BUTTON REGISTER -->
<div class="mt-6">
    <button type="submit" class="btn-register w-full">
        REGISTER
    </button>
</div>


        <div class="text-center mt-6 space-y-3">
    <p class="text-sm text-gray-600">
        Already have an account?
        <a href="/login" class="text-yellow-600 font-semibold hover:text-yellow-800">Log in here</a>
    </p>
</div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Elements
    const category = document.getElementById('category');
    const mykadFields = document.getElementById('mykadFields');
    const passportFields = document.getElementById('passportFields');

    const email = document.getElementById('email');
    const emailConfirm = document.getElementById('email_confirmation');
    const emailConfirmError = document.getElementById('emailConfirmError');

    const pass = document.getElementById('password');
    const passConfirm = document.getElementById('password_confirmation');
    const passwordError = document.getElementById('passwordError');
    const passwordConfirmError = document.getElementById('passwordConfirmError');
    const strengthBar = document.getElementById('strengthBar');
    const strengthMsg = document.getElementById('passwordStrengthMsg');

    const mykad = document.getElementById('mykad');
    const confirmMykad = document.getElementById('confirm_mykad');
    const confirmMykadError = document.getElementById('confirmMykadError');

    const passport = document.getElementById('passport');
    const confirmPassport = document.getElementById('confirm_passport');
    const confirmPassportError = document.getElementById('confirmPassportError');

    const alerts = document.getElementById('alerts');
    const form = document.getElementById('registerForm');

    function showError(el, msg) {
        if (!el) return;
        if (msg) {
            el.textContent = msg;
            el.style.display = 'block';
        } else {
            el.textContent = '';
            el.style.display = 'none';
        }
    }

    // Toggle fields and clear hidden values
    function toggleFields() {
        const val = category.value;
        if (val === 'WARGANEGARA MALAYSIA') {
            mykadFields.style.display = 'block';
            passportFields.style.display = 'none';
            // clear passport values
            if (passport) passport.value = '';
            if (confirmPassport) confirmPassport.value = '';
            showError(confirmPassportError, '');
        } else if (val === 'BUKAN WARGANEGARA') {
            passportFields.style.display = 'block';
            mykadFields.style.display = 'none';
            if (mykad) mykad.value = '';
            if (confirmMykad) confirmMykad.value = '';
            showError(confirmMykadError, '');
        } else {
            mykadFields.style.display = 'none';
            passportFields.style.display = 'none';
            if (mykad) mykad.value = '';
            if (confirmMykad) confirmMykad.value = '';
            if (passport) passport.value = '';
            if (confirmPassport) confirmPassport.value = '';
            showError(confirmMykadError, '');
            showError(confirmPassportError, '');
        }
    }
    // initial
    toggleFields();
    category.addEventListener('change', toggleFields);

    // Password strength
    function calcStrength(pw) {
        let s = 0;
        if (pw.length >= 8) s++;
        if (/[A-Z]/.test(pw)) s++;
        if (/[a-z]/.test(pw)) s++;
        if (/[0-9]/.test(pw)) s++;
        if (/[^A-Za-z0-9]/.test(pw)) s++;
        return s;
    }
    function updateStrengthUI(pw) {
        const score = calcStrength(pw);
        const pct = (score / 5) * 100;
        strengthBar.style.width = pct + '%';
        let color = '#dc2626';
        let text = 'Weak';
        if (score >= 4) { color = '#16a34a'; text = 'Strong'; }
        else if (score >= 3) { color = '#f59e0b'; text = 'Medium'; }
        strengthBar.style.backgroundColor = color;
        if (pw.length === 0) {
            strengthMsg.style.display = 'none';
        } else {
            strengthMsg.style.display = 'block';
            strengthMsg.textContent = text;
            strengthMsg.style.color = color;
        }
    }

    // Real-time validation handlers
    function validateEmailConfirm() {
        if (!email || !emailConfirm) return;
        if (emailConfirm.value.trim() === '') { showError(emailConfirmError, ''); return; }
        showError(emailConfirmError, email.value.trim() !== emailConfirm.value.trim() ? 'Emails do not match.' : '');
    }
    email && email.addEventListener('input', validateEmailConfirm);
    emailConfirm && emailConfirm.addEventListener('input', validateEmailConfirm);

    pass && pass.addEventListener('input', (e) => {
        updateStrengthUI(e.target.value);
        if (passConfirm && passConfirm.value.length > 0) {
            showError(passwordConfirmError, pass.value !== passConfirm.value ? 'Passwords do not match.' : '');
        }
        showError(passwordError, '');
    });
    passConfirm && passConfirm.addEventListener('input', () => {
        showError(passwordConfirmError, pass.value !== passConfirm.value ? 'Passwords do not match.' : '');
    });

    if (confirmMykad) {
        confirmMykad.addEventListener('input', () => {
            if (category.value === 'WARGANEGARA MALAYSIA') {
                showError(confirmMykadError, (mykad && mykad.value.trim() !== confirmMykad.value.trim()) ? 'MyKad numbers do not match.' : '');
            } else showError(confirmMykadError, '');
        });
        mykad && mykad.addEventListener('input', () => {
            if (confirmMykad && confirmMykad.value.length > 0 && category.value === 'WARGANEGARA MALAYSIA') {
                showError(confirmMykadError, mykad.value.trim() !== confirmMykad.value.trim() ? 'MyKad numbers do not match.' : '');
            }
        });
    }
    if (confirmPassport) {
        confirmPassport.addEventListener('input', () => {
            if (category.value === 'BUKAN WARGANEGARA') {
                showError(confirmPassportError, (passport && passport.value.trim() !== confirmPassport.value.trim()) ? 'Passport numbers do not match.' : '');
            } else showError(confirmPassportError, '');
        });
        passport && passport.addEventListener('input', () => {
            if (confirmPassport && confirmPassport.value.length > 0 && category.value === 'BUKAN WARGANEGARA') {
                showError(confirmPassportError, passport.value.trim() !== confirmPassport.value.trim() ? 'Passport numbers do not match.' : '');
            }
        });
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


    // Final submit validation
    form.addEventListener('submit', (ev) => {
        const errors = [];

        // email
        if (email && emailConfirm && email.value.trim() !== emailConfirm.value.trim()) {
            errors.push('Email and Confirm Email do not match.');
            showError(emailConfirmError, 'Emails do not match.');
        } else showError(emailConfirmError, '');

        // password match
        if (pass && passConfirm && pass.value !== passConfirm.value) {
            errors.push('Password and Confirm Password do not match.');
            showError(passwordConfirmError, 'Passwords do not match.');
        } else showError(passwordConfirmError, '');

        // password rules
        const pw = pass ? pass.value : '';
        const pwOk = pw.length >= 8 && /[A-Z]/.test(pw) && /[a-z]/.test(pw) && /[0-9]/.test(pw) && /[^A-Za-z0-9]/.test(pw);
        if (!pwOk) {
            errors.push('Password does not meet requirements (min 8, upper, lower, number, special).');
            showError(passwordError, 'Password must be at least 8 characters, include upper & lower case letters, a number and a special character.');
        } else showError(passwordError, '');

        // category-specific
        if (category.value === 'WARGANEGARA MALAYSIA') {
            const a = mykad ? mykad.value.trim() : '';
            const b = confirmMykad ? confirmMykad.value.trim() : '';
            if (a === '' || b === '' || a !== b) {
                errors.push('MyKad and Confirm MyKad do not match.');
                showError(confirmMykadError, 'MyKad numbers do not match.');
            } else showError(confirmMykadError, '');
            showError(confirmPassportError, '');
        } else if (category.value === 'BUKAN WARGANEGARA') {
            const p = passport ? passport.value.trim() : '';
            const q = confirmPassport ? confirmPassport.value.trim() : '';
            if (p === '' || q === '' || p !== q) {
                errors.push('Passport and Confirm Passport do not match.');
                showError(confirmPassportError, 'Passport numbers do not match.');
            } else showError(confirmPassportError, '');
            showError(confirmMykadError, '');
        }

        // if any errors, show alert and prevent submit
        if (errors.length > 0) {
            ev.preventDefault();
            alerts.innerHTML = `<div class="alert-box alert-error slide-down"><ul class="list-disc list-inside">${errors.map(x=>`<li>${x}</li>`).join('')}</ul></div>`;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            // ensure hidden fields cleared to avoid sending stale values
            if (mykadFields.style.display === 'none') { mykad && (mykad.value = ''); confirmMykad && (confirmMykad.value=''); }
            if (passportFields.style.display === 'none') { passport && (passport.value = ''); confirmPassport && (confirmPassport.value=''); }
            // form will submit
        }
    });

}); // DOMContentLoaded
</script>
</body>
</html>
