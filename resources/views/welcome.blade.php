<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packito - Laravel Package Generator</title>
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --gray: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: var(--dark);
            line-height: 1.6;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .hero {
            padding: 180px 0 100px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 40px;
        }

        .features {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background-color: rgba(52, 152, 219, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .feature-icon i {
            color: var(--primary);
            font-size: 24px;
        }

        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--gray);
        }

        .cta {
            padding: 100px 0;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .cta h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto 40px;
            opacity: 0.9;
        }

        .cta .btn {
            background-color: white;
            color: var(--primary);
            font-size: 18px;
            padding: 15px 30px;
        }

        .cta .btn:hover {
            background-color: var(--light);
        }

        footer {
            background-color: var(--secondary);
            color: white;
            padding: 40px 0 20px;
            text-align: center;
        }

        .copyright {
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bdc3c7;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 150px 0 80px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 18px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo">
                    <!-- Replace with your actual logo -->
                    <img src="{{ asset('logo.png') }}" alt="Packito Logo">

                </a>
                <div class="nav-actions">
                    <a href="/login" class="btn btn-outline">Login</a>
                    <a href="/register" class="btn">Register</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Generate Laravel Packages Faster</h1>
            <p>Packito automates the boilerplate code for your Laravel packages, so you can focus on what matters -
                building great functionality.</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="/register" class="btn" style="font-size: 18px; padding: 15px 30px;">Get Started</a>
                <a href="#features" class="btn-outline" style="font-size: 18px; padding: 15px 30px;">Learn More</a>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Package Development Made Simple</h2>
                <p>Packito provides everything you need to kickstart your Laravel package development</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3>Boilerplate Generator</h3>
                    <p>Automatically generate the standard Laravel package structure with a single command.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3>Service Provider</h3>
                    <p>Pre-configured service providers with common setups for faster implementation.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Artisan Commands</h3>
                    <p>Generate ready-to-use Artisan commands with proper registration.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Migration Support</h3>
                    <p>Easily create and manage package database migrations.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-vial"></i>
                    </div>
                    <h3>Test Scaffolding</h3>
                    <p>Pre-configured PHPUnit test cases for your package components.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Deployment Ready</h3>
                    <p>Packages are pre-configured for Packagist and Composer.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Ready to Build Better Packages?</h2>
            <p>Join thousands of Laravel developers who save hours on every package they create.</p>
            <a href="/register" class="btn">Create Free Account</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>Packito - The Laravel Package Generator</p>
            <div class="copyright">
                <p>&copy; 2023 Packito. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
