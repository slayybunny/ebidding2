<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to E-Bidding</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .gold-color {
            color: #a89166;
        }

        .bg-gold {
            background-color: #c59b39;
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37, #b8941f);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-gold:hover::before {
            left: 100%;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #b8941f, #a68416);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
        }

        /* Enhanced Navigation Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .logo-container {
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            padding: 8px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(184, 148, 31, 0.1));
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.3);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }

        .nav-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -2px;
            left: 50%;
            background: linear-gradient(90deg, #d4af37, #b8941f, #d4af37);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-item:hover::after {
            width: 80%;
        }

        .nav-item:hover {
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(212, 175, 55, 0.3);
            background: rgba(212, 175, 55, 0.05);
        }

        .nav-login-btn {
            background: linear-gradient(135deg, #d4af37, #b8941f);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .nav-login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-login-btn:hover::before {
            left: 100%;
        }

        .nav-login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Mobile Menu Styles */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        .mobile-menu-btn span {
            width: 25px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37, #b8941f);
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 80%;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 2rem;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(212, 175, 55, 0.2);
            z-index: 1001;
        }

        .mobile-menu.active {
            left: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-nav-item {
            display: block;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .mobile-nav-item:hover {
            padding-left: 1rem;
            color: #d4af37;
        }

        /* Page Structure Improvements */
        .page-section {
            position: relative;
            overflow: hidden;
        }

        .main-image {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: brightness(1.05) contrast(1.1);
        }

        .main-image:hover {
            transform: scale(1.03);
            filter: brightness(1.1) contrast(1.15);
        }

        .welcome-text {
            background: linear-gradient(135deg, #d4af37, #b8941f, #d4af37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(212, 175, 55, 0.2);
            letter-spacing: 2px;
        }

        .fade-in {
            animation: fadeInUp 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.3s; }
        .stagger-3 { animation-delay: 0.5s; }
        .stagger-4 { animation-delay: 0.7s; }

        html {
            scroll-behavior: smooth;
        }

        /* HERO SECTION - Magic Gold Box Style */
        .hero-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(212, 175, 55, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(184, 148, 31, 0.06) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(212, 175, 55, 0.03) 0%, transparent 60%);
            pointer-events: none;
        }

        .magic-title {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 1rem;
            position: relative;
        }

        .magic-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 3rem;
        }

        .hero-gold-box {
            width: 300px;
            height: 200px;
            background: linear-gradient(135deg, #d4af37 0%, #b8941f 50%, #c59b39 100%);
            border-radius: 20px;
            position: relative;
            margin: 2rem auto;
            box-shadow:
                0 20px 60px rgba(212, 175, 55, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transform-style: preserve-3d;
            transition: all 0.6s ease;
            overflow: hidden;
        }

        .hero-gold-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-gold-box:hover {
            transform: perspective(1000px) rotateY(10deg) rotateX(5deg);
            box-shadow:
                0 30px 80px rgba(212, 175, 55, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .floating-sparkles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #fff;
            border-radius: 50%;
            animation: sparkle 2s ease-in-out infinite;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        @keyframes sparkle {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .sparkle:nth-child(1) { top: 20%; left: 30%; animation-delay: 0s; }
        .sparkle:nth-child(2) { top: 60%; left: 70%; animation-delay: 0.5s; }
        .sparkle:nth-child(3) { top: 80%; left: 20%; animation-delay: 1s; }
        .sparkle:nth-child(4) { top: 40%; left: 80%; animation-delay: 1.5s; }
        .sparkle:nth-child(5) { top: 30%; left: 60%; animation-delay: 0.3s; }

        /* PRODUCTS SECTION */
        .products-section {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }

        .products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.02) 50%, transparent 70%);
            pointer-events: none;
        }

        .section-title-dark {
            font-size: 3rem;
            font-weight: 900;
            color: #1a1a1a;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
        }

        .section-title-dark::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            border-radius: 2px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.1);
            border-radius: 25px;
            padding: 2rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.02) 50%, transparent 70%);
            pointer-events: none;
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .product-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .product-icon:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.4);
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* ABOUT SECTION - Blast Gold Box Style */
        .about-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 20%, rgba(212, 175, 55, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(184, 148, 31, 0.06) 0%, transparent 50%);
            pointer-events: none;
        }

        .blast-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1a1a1a;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .blast-subtitle {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 3rem;
        }

        .blast-container {
            position: relative;
            width: 300px;
            height: 200px;
            margin: 2rem auto;
            perspective: 1000px;
        }

        .blast-box {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 50%, #2a2a2a 100%);
            border-radius: 15px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transition: all 0.6s ease;
            overflow: hidden;
        }

        .blast-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            pointer-events: none;
        }

        .blast-box:hover {
            transform: rotateY(10deg) rotateX(5deg);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
        }

        .gold-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: #d4af37;
            border-radius: 50%;
            animation: explode 2s ease-out infinite;
        }

        @keyframes explode {
            0% {
                opacity: 0;
                transform: translate(0, 0) scale(0);
            }
            50% {
                opacity: 1;
                transform: translate(var(--tx), var(--ty)) scale(1);
            }
            100% {
                opacity: 0;
                transform: translate(calc(var(--tx) * 2), calc(var(--ty) * 2)) scale(0);
            }
        }

        .particle:nth-child(1) {
            width: 8px; height: 8px;
            --tx: -50px; --ty: -30px;
            animation-delay: 0s;
            top: 50%; left: 50%;
        }
        .particle:nth-child(2) {
            width: 6px; height: 6px;
            --tx: 40px; --ty: -40px;
            animation-delay: 0.2s;
            top: 50%; left: 50%;
        }
        .particle:nth-child(3) {
            width: 10px; height: 10px;
            --tx: -30px; --ty: 50px;
            animation-delay: 0.4s;
            top: 50%; left: 50%;
        }
        .particle:nth-child(4) {
            width: 7px; height: 7px;
            --tx: 60px; --ty: 20px;
            animation-delay: 0.6s;
            top: 50%; left: 50%;
        }
        .particle:nth-child(5) {
            width: 9px; height: 9px;
            --tx: -20px; --ty: -60px;
            animation-delay: 0.8s;
            top: 50%; left: 50%;
        }

        /* TESTIMONIALS SECTION */
        .testimonial-section {
            background: linear-gradient(135deg, #f1f5f9 0%, #ffffff 50%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }

        .testimonial-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.03) 50%, transparent 70%);
            pointer-events: none;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.1);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #d4af37;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            object-fit: cover;
        }

        .stars {
            color: #d4af37;
            font-size: 1.2rem;
            margin: 1rem 0;
        }

        .testimonial-text {
            color: #666;
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: #1a1a1a;
        }

        /* NEWSLETTER SECTION */
        .newsletter-section {
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .newsletter-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .newsletter-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1a1a1a;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .newsletter-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        .newsletter-form {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .newsletter-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 50px;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 1rem;
        }

        .newsletter-input:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .newsletter-btn {
            background: linear-gradient(135deg, #d4af37, #b8941f);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        /* MANUAL SECTION - Keep original */
        .manual-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }

        .manual-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(212, 175, 55, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(184, 148, 31, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .flipbook-container {
            perspective: 1200px;
            width: 420px;
            height: 320px;
            margin: 0 auto;
            position: relative;
        }

        .flipbook {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .flipbook.flipped {
            transform: rotateY(-180deg);
        }

        .page {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 2px solid rgba(212, 175, 55, 0.2);
        }

        .page-front {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border: 3px solid #d4af37;
            position: relative;
        }

        .page-front::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.05) 50%, transparent 70%);
            pointer-events: none;
        }

        .page-back {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            transform: rotateY(180deg);
            color: white;
            position: relative;
        }

        .page-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            pointer-events: none;
        }

        .page-content {
            padding: 25px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .manual-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #d4af37, #b8941f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
            transition: all 0.3s ease;
        }

        .manual-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
        }

        .download-btn {
            background: linear-gradient(135deg, #d4af37, #b8941f);
            color: white;
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
        }

        .download-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .download-btn:hover::before {
            left: 100%;
        }

        .download-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
        }

        .flip-instruction {
            color: #666;
            font-size: 14px;
            margin-top: 25px;
            animation: pulse 2s infinite;
            font-weight: 500;
        }

        .about-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(212, 175, 55, 0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.02) 50%, transparent 70%);
            pointer-events: none;
        }

        .about-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .floating-decoration {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(184, 148, 31, 0.1));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .floating-decoration:nth-child(1) { animation-delay: 0s; }
        .floating-decoration:nth-child(2) { animation-delay: 1s; }
        .floating-decoration:nth-child(3) { animation-delay: 2s; }

        .image-frame {
            position: relative;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            padding: 6px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        .image-frame:hover {
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .mock-interface {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            position: relative;
            overflow: hidden;
        }

        .mock-interface::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .navbar-container {
                justify-content: space-between;
            }

            .flipbook-container {
                width: 350px;
                height: 280px;
            }

            .welcome-text, .magic-title {
                font-size: 2rem;
            }

            .hero-gold-box, .blast-container {
                width: 250px;
                height: 160px;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-input {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 480px) {
            .flipbook-container {
                width: 300px;
                height: 240px;
            }

            .welcome-text, .magic-title {
                font-size: 1.5rem;
            }

            .hero-gold-box, .blast-container {
                width: 200px;
                height: 130px;
            }

            .section-title-dark {
                font-size: 2rem;
            }
        }
    </style>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

            function toggleMobileMenu() {
                mobileMenuBtn.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                mobileMenuOverlay.classList.toggle('active');
            }

            mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            mobileMenuOverlay.addEventListener('click', toggleMobileMenu);

            // Close mobile menu when clicking on nav links
            const mobileNavItems = document.querySelectorAll('.mobile-nav-item');
            mobileNavItems.forEach(item => {
                item.addEventListener('click', toggleMobileMenu);
            });

            // Flipbook functionality
            const flipbook = document.getElementById('flipbook');
            if (flipbook) {
                flipbook.addEventListener('click', function() {
                    this.classList.toggle('flipped');
                });
            }

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });
    </script>
</head>
<body class="bg-white font-sans text-gray-800 min-h-screen">
    <!-- Enhanced Navigation -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50" id="navbar">
        <div class="navbar-container flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/logo-sgcc.png') }}" alt="SGCC Logo" class="h-12 w-auto object-contain">
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="nav-menu">
                <a href="#home" class="nav-item gold-color hover:text-yellow-600">Home</a>
                <a href="#about" class="nav-item gold-color hover:text-yellow-600">About Us</a>
                <a href="#manual" class="nav-item gold-color hover:text-yellow-600">User Manual</a>
                <a href="#" class="nav-item gold-color hover:text-yellow-600">Contact Us</a>
            </div>

            <!-- Login Button -->
            <a href="/login" class="nav-login-btn">
                Login
            </a>

            <!-- Mobile Menu Button -->
            <div class="mobile-menu-btn" id="mobileMenuBtn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mb-8">
            <div class="logo-container inline-block">
                <img src="{{ asset('images/logo-sgcc.png') }}" alt="SGCC Logo" class="h-16 w-auto object-contain">
            </div>
        </div>
        <nav class="space-y-2">
            <a href="#home" class="mobile-nav-item gold-color hover:text-yellow-600">Home</a>
            <a href="#about" class="mobile-nav-item gold-color hover:text-yellow-600">About Us</a>
            <a href="#manual" class="mobile-nav-item gold-color hover:text-yellow-600">User Manual</a>
            <a href="#" class="mobile-nav-item gold-color hover:text-yellow-600">Contact Us</a>
        </nav>
        <div class="mt-8">
            <a href="/login" class="nav-login-btn inline-block">Login</a>
        </div>
    </div>

    <!-- Hero Section - Magic Gold Box Style -->
    <section id="home" class="page-section hero-section flex flex-col items-center justify-center min-h-screen space-y-8 py-20 pt-32 relative overflow-hidden">
        <!-- Floating Decorations -->
        <div class="floating-decoration w-20 h-20 top-32 left-10 opacity-20"></div>
        <div class="floating-decoration w-16 h-16 bottom-20 right-10 opacity-15"></div>
        <div class="floating-decoration w-12 h-12 top-1/2 left-5 opacity-10"></div>

        <!-- Magic Title -->
        <div class="text-center fade-in stagger-1">
            <h1 class="magic-title">MAGIC</h1>
            <h2 class="magic-subtitle">GOLD BOX</h2>
        </div>

        <!-- Hero Gold Box with Sparkles -->
        <div class="relative fade-in stagger-2">
            <div class="hero-gold-box">
                <div class="floating-sparkles">
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="fade-in stagger-3 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/login" class="btn-gold inline-flex items-center justify-center px-12 py-4 text-white font-bold text-lg uppercase tracking-wider rounded-full">
                <span class="mr-2">📱</span>
                Get Started
            </a>
            <a href="#about" class="btn-gold inline-flex items-center justify-center px-12 py-4 text-white font-bold text-lg uppercase tracking-wider rounded-full">
                <span class="mr-2">ℹ️</span>
                Learn More
            </a>
        </div>
    </section>

    <!-- Products Section - Gold Box Features -->
    <section class="page-section products-section py-20">
        <div class="container mx-auto px-4 max-w-6xl relative z-10">
            <!-- Section Title -->
            <h2 class="section-title-dark fade-in">
                Our Products
            </h2>

            <div class="product-grid fade-in stagger-2">
                <!-- Metal Exit -->
                <div class="product-card">
                    <div class="product-icon">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h3 class="product-title">Metal Exit</h3>
                    <p class="product-desc">Advanced metal detection and security systems</p>
                </div>

                <!-- Anomaly Detection -->
                <div class="product-card">
                    <div class="product-icon">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="product-title">Anomaly Detection</h3>
                    <p class="product-desc">Smart AI-powered anomaly detection technology</p>
                </div>

                <!-- API Security -->
                <div class="product-card">
                    <div class="product-icon">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2z"/>
                        </svg>
                    </div>
                    <h3 class="product-title">API Security</h3>
                    <p class="product-desc">Comprehensive API protection and monitoring</p>
                </div>

                <!-- Gold Money -->
                <div class="product-card">
                    <div class="product-icon">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="product-title">Gold Money</h3>
                    <p class="product-desc">Digital gold trading and investment platform</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section - Blast Gold Box Style -->
    <section id="about" class="page-section about-section py-20">
        <div class="container mx-auto px-4 max-w-6xl relative z-10">
            <!-- Section Title -->
            <div class="text-center mb-16 fade-in">
                <h2 class="blast-title">A New Models</h2>
                <h3 class="blast-subtitle">Blast Gold Box</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Side - Blast Gold Box -->
                <div class="flex justify-center fade-in stagger-2">
                    <div class="blast-container">
                        <div class="blast-box">
                            <div class="gold-particles">
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Content -->
                <div class="about-card p-10 fade-in stagger-3">
                    <div class="text-gray-700 leading-relaxed space-y-5 relative z-10">
                        <p class="text-lg font-medium">
                            The <strong>"Jual Beli Jongkong Emas & Emas Batangan Malaysia Indonesia | Silver Gold Collector Club (SGCC)"</strong> Official Empire is a dedicated Facebook group for gold and silver enthusiasts, collectors, and traders across Malaysia and Indonesia.
                        </p>
                        <p class="text-base">
                            The group serves as a trusted platform for members to buy and sell physical gold and silver—especially gold bars (jongkong emas), ingots (emas batangan), and silver bullion. It also facilitates live bidding sessions, allowing members to participate in real-time auctions, often referred to as "gold bidding."
                        </p>
                        <p class="text-base">
                            Beyond trade, the community shares valuable insights on market trends, gold prices, and best practices in precious metal investments. Operated under the identity of the Silver Gold Collector Club (SGCC), the group promotes transparency, safe transactions, and a sense of community among serious collectors and casual buyers alike.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="#" class="btn-gold inline-flex items-center justify-center px-8 py-3 text-white font-bold text-sm uppercase tracking-wider rounded-full">
                            <span class="mr-2">📖</span>
                            Read More
                        </a>
                        <a href="#" class="btn-gold inline-flex items-center justify-center px-8 py-3 text-white font-bold text-sm uppercase tracking-wider rounded-full">
                            <span class="mr-2">📞</span>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="page-section testimonial-section py-20">
        <div class="container mx-auto px-4 max-w-6xl relative z-10">
            <!-- Section Title -->
            <h2 class="section-title-dark fade-in">
                What Our Say Customer
            </h2>

            <div class="testimonial-grid fade-in stagger-2">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face" alt="Sarah Johnson" class="avatar mr-4">
                        <div>
                            <h4 class="testimonial-author">Sarah Johnson</h4>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        "Excellent service and genuine gold products. The bidding process is transparent and fair. Highly recommended for serious gold investors."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Ahmad Rahman" class="avatar mr-4">
                        <div>
                            <h4 class="testimonial-author">Ahmad Rahman</h4>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        "Been a member for 2 years now. Great community, competitive prices, and secure transactions. The best platform for gold trading in SEA."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="page-section newsletter-section py-20">
        <div class="container mx-auto px-4 relative z-10">
            <div class="newsletter-container fade-in">
                <h2 class="newsletter-title">Subscribe Our</h2>
                <h3 class="newsletter-subtitle">Newsletter</h3>

                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address" class="newsletter-input" required>
                    <button type="submit" class="newsletter-btn">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <!-- User Manual Section -->
    <section id="manual" class="page-section manual-section flex items-center justify-center min-h-screen py-20">
        <div class="container mx-auto px-4 max-w-4xl relative z-10">
            <!-- Section Title -->
            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center mb-6 fade-in section-title-gold">
                USER MANUAL
            </h2>

            <div class="text-center mb-12">
                <!-- Flipbook Container -->
                <div class="flipbook-container fade-in stagger-2">
                    <div class="flipbook" id="flipbook">
                        <!-- Front Page -->
                        <div class="page page-front">
                            <div class="page-content">
                                <div class="manual-icon">
                                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">USER MANUAL</h3>
                                <div class="w-full max-w-xs mx-auto mb-6">
                                    <div class="mock-interface rounded-xl p-5 relative overflow-hidden">
                                        <!-- Mock interface elements -->
                                        <div class="grid grid-cols-2 gap-3 mb-4">
                                            <div class="bg-white bg-opacity-30 rounded-lg h-14 flex items-center justify-center">
                                                <div class="w-10 h-10 bg-green-400 rounded-lg shadow-lg"></div>
                                            </div>
                                            <div class="bg-white bg-opacity-30 rounded-lg h-14 flex items-center justify-center">
                                                <div class="w-10 h-10 bg-blue-400 rounded-lg shadow-lg"></div>
                                            </div>
                                        </div>
                                        <div class="bg-white bg-opacity-20 rounded-lg h-8 mb-2"></div>
                                        <div class="bg-white bg-opacity-20 rounded-lg h-6"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Step-by-step guide to get started with our platform</p>
                            </div>
                        </div>

                        <!-- Back Page -->
                        <div class="page page-back">
                            <div class="page-content">
                                <h3 class="text-2xl font-bold mb-6">Download Manual</h3>
                                <p class="text-sm mb-6 opacity-90">Get the complete user guide with detailed instructions, tips, and best practices.</p>
                                <a href="#" class="download-btn">
                                    Download PDF
                                </a>
                                <div class="mt-6 text-xs opacity-75">
                                    <p>• Complete setup guide</p>
                                    <p>• Trading strategies</p>
                                    <p>• Security tips</p>
                                    <p>• FAQ section</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="flip-instruction fade-in stagger-3">
                    Click on the manual to flip and explore →
                </p>
            </div>
        </div>
    </section>
</body>
</html>
