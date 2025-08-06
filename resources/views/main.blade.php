<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to E-Bidding</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Formal Black, White, Gold Theme */
        :root {
            --gold-primary: #d4af37;
            --gold-secondary: #b8941f;
            --gold-accent: #f7d794;
            --black-primary: #000000;
            --black-secondary: #1a1a1a;
            --black-tertiary: #2d2d2d;
            --white-primary: #ffffff;
            --white-secondary: #f8f9fa;
            --gray-light: #f5f5f5;
            --gray-border: #e5e5e5;
            --text-gray: #666666;
        }

        /* Base Styles */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            background: var(--white-primary);
            color: var(--black-primary);
        }

        /* Formal Navigation */
        .navbar {
            background: var(--white-primary);
            border-bottom: 2px solid var(--gold-primary);
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo-container {
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        /* Larger Logo */
        .logo-container img {
            height: 80px !important;
            width: auto !important;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-item {
            color: var(--black-primary);
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--gold-primary), var(--gold-secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-item:hover {
            color: var(--gold-primary);
            background: var(--gray-light);
        }

        .nav-item:hover::after {
            width: 80%;
        }

        .nav-item.active {
            color: var(--gold-primary);
        }

        .nav-item.active::after {
            width: 80%;
        }

        .nav-login-btn {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            color: var(--white-primary);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid var(--gold-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-login-btn:hover {
            background: linear-gradient(135deg, var(--gold-secondary), var(--gold-primary));
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: var(--gray-light);
        }

        .mobile-menu-btn span {
            width: 25px;
            height: 3px;
            background: var(--black-primary);
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
            background: var(--white-primary);
            padding: 2rem;
            transition: all 0.3s ease;
            border-right: 2px solid var(--gold-primary);
            z-index: 1001;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
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
            border-bottom: 1px solid var(--gray-border);
            transition: all 0.3s ease;
            color: var(--black-primary);
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .mobile-nav-item:hover {
            padding-left: 1rem;
            color: var(--gold-primary);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--white-primary) 0%, var(--gray-light) 100%);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 120px;
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
                radial-gradient(circle at 20% 30%, rgba(212, 175, 55, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(184, 148, 31, 0.03) 0%, transparent 40%);
            pointer-events: none;
        }

        .hero-content {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--black-primary) 0%, var(--gold-primary) 50%, var(--black-primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-gray);
            margin-bottom: 3rem;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-accent {
            display: inline-block;
            background: var(--gold-primary);
            color: var(--white-primary);
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .hero-cta {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .cta-primary {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            color: var(--white-primary);
            padding: 1.25rem 3rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid var(--gold-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .cta-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .cta-primary:hover::before {
            left: 100%;
        }

        .cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
        }

        .cta-secondary {
            background: transparent;
            color: var(--black-primary);
            padding: 1.25rem 3rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid var(--black-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-secondary:hover {
            background: var(--black-primary);
            color: var(--white-primary);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        /* About Section */
        .about-section {
            background: var(--gray-light);
            position: relative;
            padding: 8rem 0;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 900;
            color: var(--black-primary);
            text-align: center;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-title-accent {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--text-gray);
            text-align: center;
            margin-bottom: 5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-text p {
            color: var(--text-gray);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .about-visual {
            background: var(--white-primary);
            border: 3px solid var(--gold-primary);
            border-radius: 15px;
            padding: 4rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .visual-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.3);
        }

        .visual-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--black-primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .visual-subtext {
            color: var(--gold-primary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Manual Section */
        .manual-section {
            background: var(--white-primary);
            position: relative;
            padding: 8rem 0;
        }

        .manual-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .manual-visual {
            background: var(--gray-light);
            border: 3px solid var(--gold-primary);
            border-radius: 15px;
            padding: 4rem;
            margin: 4rem auto;
            max-width: 600px;
            position: relative;
            cursor: pointer;
            transition: all 0.4s ease;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .manual-visual:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(212, 175, 55, 0.3);
        }

        .manual-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.3);
        }

        .manual-title {
            font-size: 2rem;
            font-weight: 900;
            color: var(--black-primary);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .manual-description {
            color: var(--text-gray);
            margin-bottom: 2.5rem;
            line-height: 1.6;
            font-size: 1.05rem;
        }

        .download-btn {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            color: var(--white-primary);
            padding: 1.25rem 3rem;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            border: 2px solid var(--gold-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            overflow: hidden;
        }

        .download-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: var(--white-primary);
            border: 2px solid var(--gold-primary);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.2);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .feature-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--black-primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .feature-desc {
            color: var(--text-gray);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Contact Us Section */
        .contact-section {
            background: var(--black-primary);
            color: var(--white-primary);
            position: relative;
            padding: 8rem 0;
        }

        .contact-section::before {
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

        .contact-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold-primary);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border-left: 4px solid var(--gold-primary);
        }

        .contact-item-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-item-content h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--gold-primary);
        }

        .contact-item-content p {
            color: #cccccc;
            margin: 0;
        }

        .contact-form {
            background: var(--white-primary);
            padding: 3rem;
            border-radius: 15px;
            border: 2px solid var(--gold-primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .contact-form h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--black-primary);
            margin-bottom: 2rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--black-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--gray-border);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white-primary);
            color: var(--black-primary);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            color: var(--white-primary);
            padding: 1rem 2rem;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        /* Animations */
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.3s; }
        .stagger-3 { animation-delay: 0.5s; }

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

            .logo-container img {
                height: 50px !important;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .navbar-container {
                padding: 0 1rem;
            }

            .hero-content {
                padding: 0 1rem;
            }

            .about-container,
            .manual-container,
            .contact-container {
                padding: 0 1rem;
            }

            .logo-container img {
                height: 40px !important;
            }

            .cta-primary,
            .cta-secondary,
            .download-btn {
                padding: 1rem 2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Formal Navigation -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50" id="navbar">
        <div class="navbar-container flex items-center justify-between py-4">
            <!-- Larger Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/logo-sgcc.png') }}" alt="SGCC Logo" class="object-contain">
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="nav-menu">
                <a href="#home" class="nav-item">Home</a>
                <a href="#about" class="nav-item">About Us</a>
                <a href="#manual" class="nav-item">User Manual</a>
                <a href="#contact" class="nav-item">Contact Us</a>
            </div>

            <!-- Login Button with Icon -->
            <a href="/login" class="nav-login-btn">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
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
            <a href="#home" class="mobile-nav-item">Home</a>
            <a href="#about" class="mobile-nav-item">About Us</a>
            <a href="#manual" class="mobile-nav-item">User Manual</a>
            <a href="#contact" class="mobile-nav-item">Contact Us</a>
        </nav>
        <div class="mt-8">
            <a href="/login" class="nav-login-btn inline-block">Login</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-content fade-in">
            <h1 class="hero-title stagger-2">E-Bidding Excellence</h1>
            <p class="hero-subtitle stagger-3">
                Experience the future of precious metals bidding with our secure, professional platform.
                Join the elite community of gold and silver collectors and bidders across Malaysia and Indonesia.
            </p>
            <div class="hero-cta stagger-3">
                <a href="/login" class="cta-primary">Start Bidding</a>
                <a href="#about" class="cta-secondary">Discover More</a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <div class="about-container">
            <div class="fade-in stagger-1">
                <h2 class="section-title">About <span class="section-title-accent">SGCC</span></h2>
                <p class="section-subtitle">
                    The most trusted precious metals bidding platform in Southeast Asia
                </p>
            </div>

            <div class="about-content fade-in stagger-2">
                <!-- Content -->
                <div class="about-text">
                    <p>
                        The <strong>Silver Gold Collector Club (SGCC)</strong> stands as the premier platform for discerning gold and silver enthusiasts, collectors, and professional bidders throughout Malaysia and Indonesia. We have established ourselves as the definitive marketplace for authentic precious metals bidding.
                    </p>

                    <p>
                        Our specialized focus encompasses the finest gold bars (jongkong emas), premium ingots (emas batangan), and certified silver bullion. Through our advanced live bidding technology, members engage in transparent, real-time auctions that set the industry standard for integrity and fairness.
                    </p>

                    <p>
                        Beyond exceptional bidding services, SGCC provides exclusive market intelligence, price analytics, and expert guidance on precious metals investment strategies. We maintain the highest standards of security, transparency, and professionalism in every transaction.
                    </p>

                    <div class="mt-8">
                        <a href="#manual" class="cta-primary">Explore Platform</a>
                    </div>
                </div>
            <!-- Visual Element -->
                <div class="about-visual">
                    <div class="visual-image">
                        <img src="{{ asset('images/main.jpg') }}" alt="Premium Gold Bars" class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Manual Section -->
    <section id="manual" class="manual-section">
        <div class="manual-container">
            <div class="fade-in stagger-1">
                <h2 class="section-title">User <span class="section-title-accent">Manual</span></h2>
                <p class="section-subtitle">
                    Master the platform with our comprehensive bidding guide
                </p>
            </div>

            <div class="manual-visual fade-in stagger-2" onclick="downloadManual()">
                <div class="manual-icon">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="manual-title">Professional Bidding Guide</h3>
                <p class="manual-description">
                    Access our exclusive manual featuring advanced bidding strategies, market analysis techniques,
                    security protocols, and expert insights from seasoned precious metals professionals.
                </p>
                <div class="download-btn">
                    Download
                </div>
            </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="contact-section">
        <div class="contact-container">
            <div class="fade-in stagger-1">
                <h2 class="section-title" style="color: var(--white-primary);">Contact <span class="section-title-accent">Us</span></h2>
                <p class="section-subtitle" style="color: #cccccc;">
                    Get in touch with our professional team for expert guidance and support
                </p>
            </div>

            <div class="contact-content fade-in stagger-2">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h3>Get In Touch</h3>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="contact-item-content">
                            <h4>Office Address</h4>
                            <p>Silver Gold Collector Club<br>
                            Kuala Lumpur, Malaysia<br>
                            Jakarta, Indonesia</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div class="contact-item-content">
                            <h4>Phone Numbers</h4>
                            <p>Malaysia: +60 123 456 789<br>
                            Indonesia: +62 123 456 789<br>
                            24/7 Premium Support</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div class="contact-item-content">
                            <h4>Email Address</h4>
                            <p>info@sgcc-trading.com<br>
                            support@sgcc-trading.com<br>
                            Response within 2 hours</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="contact-item-content">
                            <h4>Business Hours</h4>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Emergency Support Only</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h3>Send Us A Message</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required placeholder="Please describe your inquiry in detail..."></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Active navigation highlighting
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-item, .mobile-nav-item');

            function highlightActiveSection() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (scrollY >= (sectionTop - 200)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', highlightActiveSection);

            // Contact form handling
            const contactForm = document.getElementById('contactForm');
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(contactForm);
                const data = Object.fromEntries(formData);

                // Show success message (in real implementation, you'd send this to a server)
                alert('Thank you for your message! Our team will respond within 2 business hours.');

                // Reset form
                contactForm.reset();
            });
        });

        // Manual download function
        function downloadManual() {
            // Placeholder for actual download functionality
            alert('Premium manual download would be implemented here with actual PDF file.');
            // In real implementation:
            // window.open('/path/to/premium-manual.pdf', '_blank');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.feature-card, .about-visual, .manual-visual, .contact-item');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Form input focus effects
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
