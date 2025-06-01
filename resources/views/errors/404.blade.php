<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | Packito</title>
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

        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .error-content {
            text-align: center;
            padding: 80px 0;
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 16px;
        }

        p {
            color: var(--gray);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto 32px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin: 0 8px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .error-image {
            max-width: 400px;
            margin: 0 auto 40px;
        }

        .error-image img {
            width: 100%;
            height: auto;
        }

        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 24px 0;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 16px;
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
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 80px;
            }

            h1 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }

            .btn {
                display: block;
                margin: 10px auto;
                max-width: 200px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="error-content">
            <div class="error-image">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                    </path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="error-code">404</div>
            <h1>Page Not Found</h1>
            <p>We're working on it! The page you're looking for may have been moved or doesn't exist. In the meantime,
                here are some helpful links</p>
            <div class="action-buttons">
                <a href="/" class="btn">Go to Homepage</a>
                <a href="/docs" class="btn btn-outline">View Documentation</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <a href="/features">Features</a>
            <a href="/pricing">Pricing</a>
            <a href="/blog">Blog</a>
            <a href="/contact">Contact</a>
        </div>
        <div class="copyright">&copy; <span id="year"></span> Packito. All rights reserved.</div>
    </footer>
</body>

</html>
<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
