<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packito - Generate Laravel Packages in Seconds | Automated Package Scaffolding</title>
    <meta name="description"
        content="Packito automates Laravel package creation with boilerplate code, service providers, tests & Composer config. Save hours on package development.">
    <meta name="keywords"
        content="laravel package generator, php package creator, laravel boilerplate, package scaffolding, composer package generator">
    <meta name="author" content="Packito">
    <meta property="og:title" content="Packito - Laravel Package Generator">
    <meta property="og:description" content="Automate your Laravel package development workflow">
    <meta property="og:image" content="https://packito.net/images/social-preview.jpg">
    <meta property="og:url" content="https://packito.net">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="https://packito.net" />

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "Packito",
      "description": "Laravel package generator tool",
      "url": "https://packito.net",
      "applicationCategory": "DeveloperTool",
      "operatingSystem": "Web",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      }
    }
    </script>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        @supports (font-variation-settings: normal) {
            * {
                font-family: 'Inter var', -apple-system, BlinkMacSystemFont, sans-serif;
            }
        }

        body {
            color: var(--dark);
            line-height: 1.6;
            background-color: var(--light);
        }

        header {
            background-color: var(--white);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: fixed;
            width: 100%;
            z-index: 100;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
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
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            gap: 12px;
        }

        .logo img {
            height: 36px;
            width: auto;
            loading: lazy;
        }

        .nav-actions {
            display: flex;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            font-size: 15px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            min-width: 120px;
            text-align: center;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(67, 97, 238, 0.05);
            transform: translateY(-1px);
        }

        .hero {
            padding: 180px 0 120px;
            background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.05) 0%, rgba(0, 0, 0, 0) 70%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: clamp(36px, 5vw, 52px);
            font-weight: 800;
            margin-bottom: 24px;
            line-height: 1.2;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero p {
            font-size: clamp(16px, 2vw, 20px);
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 40px;
            font-weight: 400;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .features {
            padding: 100px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-title h2 {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--dark);
        }

        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
            font-size: clamp(14px, 2vw, 18px);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
        }

        .feature-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 40px 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--light-gray);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-color: rgba(67, 97, 238, 0.2);
        }

        .feature-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        .feature-icon {
            background-color: rgba(67, 97, 238, 0.1);
            width: 64px;
            height: 64px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: var(--primary);
            font-size: 28px;
        }

        .feature-card h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--gray);
            font-size: 16px;
        }

        .testimonials {
            padding: 80px 0;
            background-color: var(--white);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .testimonial-card {
            background: var(--light);
            padding: 30px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        .testimonial-content {
            font-style: italic;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--primary);
        }

        .faq {
            padding: 80px 0;
        }

        .faq-item {
            margin-bottom: 30px;
            border-bottom: 1px solid var(--light-gray);
            padding-bottom: 20px;
        }

        .faq-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .faq-item p {
            color: var(--gray);
        }

        .cta {
            padding: 120px 0;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd' opacity='0.1'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            margin-bottom: 24px;
        }

        .cta p {
            font-size: clamp(16px, 2vw, 20px);
            max-width: 600px;
            margin: 0 auto 40px;
            opacity: 0.9;
            font-weight: 400;
        }

        .cta .btn {
            background-color: var(--white);
            color: var(--primary);
            font-size: 18px;
            padding: 16px 32px;
            font-weight: 600;
            min-width: 200px;
        }

        .cta .btn:hover {
            background-color: var(--light);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 60px 0 24px;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            gap: 12px;
        }

        .footer-logo img {
            height: 36px;
            width: auto;
            loading: lazy;
        }

        .footer-links {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .copyright {
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 160px 0 80px;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn,
            .btn-outline {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo">
                    <img src="{{ asset('logo.png') }}" alt="Packito - Laravel Package Generator Tool" width="36"
                        height="36" loading="lazy">
                </a>
                <div class="nav-actions">
                    <a href="/login" class="btn btn-outline">Login</a>
                    <a href="/register" class="btn">Register</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-content">
            <h1>Generate Laravel Packages in Seconds</h1>
            <p>Automate your Laravel package development with AI-powered scaffolding, boilerplate generation, and
                production-ready configurations. Save hours on every package.</p>
            <div class="hero-actions">
                <a href="/register" class="btn">Get Started Free</a>
                <a href="#features" class="btn btn-outline">Explore Features</a>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Advanced Laravel Package Generator</h2>
                <p>Everything you need to create, test, and publish Laravel packages with confidence</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3>Smart Scaffolding</h3>
                    <p>Generate complete package structures with PSR-4 namespaces, service providers, and config files
                        automatically.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Artisan Commands</h3>
                    <p>Create console commands with boilerplate registration and argument handling built-in.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Test Ready</h3>
                    <p>Pre-configured PHPUnit setup with example tests for your package components.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Migration Generator</h3>
                    <p>Easily create and manage package database migrations with proper publishing.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>CI/CD Integration</h3>
                    <p>Pre-configured GitHub Actions workflows for testing and deployment.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h3>Composer Ready</h3>
                    <p>Automatically generated composer.json with proper namespace mapping.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Trusted by Laravel Developers</h2>
                <p>Don't just take our word for it - see what developers are saying about Packito</p>
            </div>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-content">"Packito cut our package development time by 70%. What used to take
                        days now takes hours."</p>
                    {{-- <p class="testimonial-author">- Sarah K., Senior PHP Developer</p> --}}
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-content">"The automated test scaffolding alone is worth it. Perfect for
                        maintaining high-quality packages."</p>
                    {{-- <p class="testimonial-author">- Michael T., Laravel Team Lead</p> --}}
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-content">"Finally a tool that understands package development workflows. The
                        service provider generation is brilliant."</p>
                    {{-- <p class="testimonial-author">- David R., Open Source Contributor</p> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Everything you need to know about Packito</p>
            </div>
            <div class="faq-item">
                <h3>How does Packito help Laravel developers?</h3>
                <p>Packito automates the tedious parts of Laravel package development including boilerplate code
                    generation, service provider setup, test scaffolding, and Composer configuration. It enforces best
                    practices so you can focus on your package's unique functionality.</p>
            </div>
            <div class="faq-item">
                <h3>Is Packito compatible with Laravel 10?</h3>
                <p>Yes, Packito generates packages that are fully compatible with all recent Laravel versions including
                    Laravel 9, 10, and future releases. We continuously update our templates to match Laravel's evolving
                    standards.</p>
            </div>
            <div class="faq-item">
                <h3>Can I use Packito for commercial projects?</h3>
                <p>Absolutely. Packages generated with Packito are 100% yours with no licensing restrictions. Many
                    developers use Packito to create packages for client projects and commercial products.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container cta-content">
            <h2>Ready to Build Better Packages?</h2>
            <p>Join thousands of Laravel developers who save hours on every package they create with Packito's powerful
                generator.</p>
            <a href="/register" class="btn">Create Your Free Account</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="/" class="footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="Packito" width="36" height="36" loading="lazy">
                </a>
                <div class="footer-links">
                    <a href="/features">Features</a>
                    <a href="/pricing">Pricing</a>
                    <a href="/docs">Documentation</a>
                    <a href="/blog">Blog</a>
                    <a href="/privacy">Privacy</a>
                    <a href="/terms">Terms</a>
                </div>
                <p>The modern Laravel package generator</p>
                <div class="copyright">
                    <p>&copy;<span id="year"></span> Packito. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js"
    data-id="itsmeramsheed" data-description="Support me on Buy me a coffee!"
    data-message="☕ Love what I’m building?
If you’d like to support my work and help fuel more late-night coding sessions, consider buying me a coffee! Every cup helps. 🙌" data-color="#40DCA5" data-position="Right" data-x_margin="18"
    data-y_margin="18"></script>
