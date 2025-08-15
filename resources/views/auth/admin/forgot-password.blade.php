<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Laluan Admin - No One Is Left Behind</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS dari fail login anda, tetapi dengan perubahan untuk halaman lupa kata laluan */
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

        /* Right side - Forgot Password form */
        .form-section {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 35px;
        }

        .form-container {
            width: 100%;
            max-width: 380px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #b8860b, #daa520);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .subtitle {
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

        .submit-btn {
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

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn i {
            margin-right: 6px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #b8860b;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #996f00;
        }

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
        
        .notification.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
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
                display: none; /* Sembunyikan banner pada peranti mudah alih */
            }

            .form-section {
                padding: 25px 20px;
            }

            .title {
                font-size: 24px;
            }

            .header {
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="banner-section">
            <div class="image-container">
                <img src="{{ asset('images/main.jpg') }}" alt="No One Is Left Behind" class="banner-image">
            </div>
        </div>

        <div class="form-section">
            <div class="form-container">
                {{-- Papar mesej ralat atau kejayaan --}}
                @if (session('status'))
                    <div class="notification success">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="notification error">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif
                
                <div class="header">
                    <h1 class="title">Forgot Your Password?</h1>
                    <p class="subtitle">Sila masukkan alamat e-mel anda. Pautan set semula akan dihantar.</p>
                </div>

                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" id="email" required placeholder="Enter your email" autofocus>
                        <i class="fas fa-envelope icon"></i>
                    </div>

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        Send Reset Link
                    </button>
                </form>

                <a href="{{ route('admin.login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to login
                </a>
            </div>
        </div>
    </div>

    <script>
        // Papar notifikasi sementara
        document.addEventListener('DOMContentLoaded', function() {
            const successNotif = document.querySelector('.notification.success');
            const errorNotif = document.querySelector('.notification.error');
            
            if (successNotif) {
                setTimeout(() => successNotif.remove(), 5000);
            }
            if (errorNotif) {
                setTimeout(() => errorNotif.remove(), 5000);
            }
        });
    </script>
</body>
</html>