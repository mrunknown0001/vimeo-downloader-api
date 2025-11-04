<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                :root {
                    color-scheme: light;
                    --font-family: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                    --bg-color: #f7f8fb;
                    --bg-gradient: radial-gradient(circle at 15% 20%, rgba(99, 102, 241, 0.18), transparent 55%), radial-gradient(circle at 85% 0%, rgba(14, 165, 233, 0.2), transparent 55%), linear-gradient(135deg, #ffffff 0%, #f5f7ff 60%, #edf5ff 100%);
                    --surface: rgba(255, 255, 255, 0.86);
                    --surface-muted: rgba(255, 255, 255, 0.7);
                    --border: rgba(99, 102, 241, 0.12);
                    --border-strong: rgba(99, 102, 241, 0.24);
                    --primary: #6366f1;
                    --primary-dark: #4f46e5;
                    --accent: #0ea5e9;
                    --success: #22c55e;
                    --warning: #f97316;
                    --text-primary: #0f172a;
                    --text-secondary: #475569;
                    --text-tertiary: #6b7280;
                    --shadow-lg: 0 40px 80px -40px rgba(15, 23, 42, 0.45);
                    --shadow-md: 0 25px 55px -30px rgba(15, 23, 42, 0.35);
                    --shadow-soft: 0 18px 44px -30px rgba(15, 23, 42, 0.3);
                    --radius-lg: 28px;
                    --radius-md: 20px;
                    --radius-sm: 14px;
                }

                @media (prefers-color-scheme: dark) {
                    :root {
                        color-scheme: dark;
                        --bg-color: #050608;
                        --bg-gradient: radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.2), transparent 55%), radial-gradient(circle at 90% 5%, rgba(56, 189, 248, 0.18), transparent 55%), linear-gradient(145deg, #0f172a 0%, #0b1120 100%);
                        --surface: rgba(15, 23, 42, 0.78);
                        --surface-muted: rgba(15, 23, 42, 0.62);
                        --border: rgba(148, 163, 184, 0.12);
                        --border-strong: rgba(94, 234, 212, 0.25);
                        --text-primary: #f8fafc;
                        --text-secondary: #cbd5f5;
                        --text-tertiary: #94a3b8;
                        --shadow-lg: 0 40px 80px -40px rgba(15, 23, 42, 0.9);
                        --shadow-md: 0 28px 55px -28px rgba(14, 116, 144, 0.5);
                        --shadow-soft: 0 24px 46px -28px rgba(15, 118, 110, 0.44);
                    }

                    .hero-visual .spotlight-card,
                    .metrics-card,
                    .feature-card,
                    .step-card {
                        backdrop-filter: saturate(140%) blur(20px);
                    }
                }

                * {
                    box-sizing: border-box;
                }

                html,
                body {
                    min-height: 100%;
                }

                body {
                    margin: 0;
                    font-family: var(--font-family);
                    background: var(--bg-gradient), var(--bg-color);
                    color: var(--text-primary);
                    line-height: 1.6;
                    -webkit-font-smoothing: antialiased;
                }

                a {
                    color: inherit;
                    text-decoration: none;
                }

                a:hover {
                    text-decoration: underline;
                }

                :focus-visible {
                    outline: 2px solid var(--accent);
                    outline-offset: 3px;
                }

                .landing-body {
                    display: flex;
                    flex-direction: column;
                    min-height: 100vh;
                }

                .container {
                    width: min(1120px, calc(100% - 3.5rem));
                    margin: 0 auto;
                }

                @media (max-width: 768px) {
                    .container {
                        width: calc(100% - 2.25rem);
                    }
                }

                .site-header {
                    padding: 1.25rem 0 0.75rem;
                }

                .header-inner {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1.5rem;
                    padding: 0.85rem 1.6rem;
                    background: var(--surface);
                    border: 1px solid var(--border);
                    border-radius: 999px;
                    box-shadow: var(--shadow-soft);
                    backdrop-filter: saturate(140%) blur(18px);
                }

                .brand {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.7rem;
                    font-weight: 600;
                    letter-spacing: -0.02em;
                }

                .brand-icon {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 2.35rem;
                    height: 2.35rem;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--primary), var(--accent));
                    color: #ffffff;
                    font-size: 1.15rem;
                    box-shadow: 0 10px 18px -12px rgba(79, 70, 229, 0.8);
                }

                .auth-nav {
                    display: inline-flex;
                    gap: 0.75rem;
                    align-items: center;
                    flex-wrap: wrap;
                }

                .auth-link {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.55rem 1.2rem;
                    border-radius: 999px;
                    border: 1px solid transparent;
                    font-size: 0.95rem;
                    font-weight: 500;
                    color: var(--text-secondary);
                    background: transparent;
                    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                }

                .auth-link:hover {
                    text-decoration: none;
                    background: rgba(99, 102, 241, 0.08);
                }

                .auth-link.auth-link--primary {
                    background: var(--primary);
                    color: #ffffff;
                    box-shadow: 0 18px 38px -20px rgba(79, 70, 229, 0.75);
                }

                .auth-link.auth-link--primary:hover {
                    background: var(--primary-dark);
                }

                .main-content {
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                }

                .hero {
                    display: flex;
                    align-items: center;
                    gap: 4rem;
                    padding: clamp(3rem, 9vw, 6.5rem) 0 clamp(2.5rem, 6vw, 4.5rem);
                }

                .hero-content {
                    flex: 1.25;
                    display: flex;
                    flex-direction: column;
                    gap: 1.75rem;
                }

                .eyebrow {
                    font-size: 0.8rem;
                    font-weight: 600;
                    letter-spacing: 0.3em;
                    text-transform: uppercase;
                    color: var(--text-secondary);
                }

                h1 {
                    margin: 0;
                    font-size: clamp(2.6rem, 5vw, 3.8rem);
                    line-height: 1.1;
                    letter-spacing: -0.035em;
                }

                .hero-subtitle {
                    margin: 0;
                    font-size: 1.05rem;
                    color: var(--text-secondary);
                    max-width: 46ch;
                }

                .info-panel {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 0.75rem;
                    margin: 0.5rem 0 0.75rem;
                }

                .info-pill {
                    padding: 0.6rem 1rem;
                    border-radius: 999px;
                    background: var(--surface);
                    border: 1px solid var(--border);
                    font-weight: 500;
                    font-size: 0.9rem;
                    color: var(--text-secondary);
                    box-shadow: var(--shadow-soft);
                }

                .hero-note {
                    margin: 0.25rem 0 0.4rem;
                    padding: 1rem 1.2rem;
                    border-radius: var(--radius-sm);
                    background: var(--surface);
                    border: 1px solid var(--border);
                    color: var(--text-secondary);
                    box-shadow: var(--shadow-soft);
                }

                .hero-note strong {
                    color: var(--text-primary);
                }

                .hero-badges {
                    display: flex;
                    gap: 1.25rem;
                    flex-wrap: wrap;
                }

                .badge {
                    display: grid;
                    gap: 0.15rem;
                    padding: 0.75rem 1.15rem;
                    border-radius: var(--radius-sm);
                    background: var(--surface);
                    border: 1px solid var(--border);
                    min-width: 140px;
                    box-shadow: var(--shadow-soft);
                }

                .badge-value {
                    font-size: 1.4rem;
                    font-weight: 600;
                }

                .badge-label {
                    font-size: 0.85rem;
                    color: var(--text-secondary);
                }

                .hero-visual {
                    flex: 1;
                    display: flex;
                    justify-content: center;
                }

                .spotlight-card {
                    width: min(420px, 100%);
                    display: grid;
                    gap: 1.2rem;
                    padding: 2rem;
                    background: var(--surface);
                    border-radius: var(--radius-lg);
                    border: 1px solid var(--border);
                    box-shadow: var(--shadow-lg);
                    backdrop-filter: blur(16px);
                }

                .spotlight-card header {
                    font-weight: 600;
                    letter-spacing: 0.08em;
                    text-transform: uppercase;
                    color: var(--text-tertiary);
                }

                .spotlight-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: grid;
                    gap: 0.9rem;
                }

                .spotlight-item {
                    display: grid;
                    gap: 0.35rem;
                    padding: 0.85rem 1rem;
                    border-radius: var(--radius-sm);
                    background: var(--surface-muted);
                    border: 1px solid var(--border);
                }

                .spotlight-title {
                    font-weight: 600;
                }

                .spotlight-text {
                    font-size: 0.9rem;
                    color: var(--text-secondary);
                }

                .spotlight-foot {
                    display: grid;
                    gap: 0.35rem;
                    padding: 0.95rem 1.05rem;
                    border-radius: var(--radius-sm);
                    background: rgba(99, 102, 241, 0.08);
                    border: 1px dashed rgba(99, 102, 241, 0.25);
                    font-size: 0.88rem;
                    color: var(--text-secondary);
                }

                .spotlight-foot strong {
                    color: var(--text-primary);
                }

                .section {
                    padding: clamp(3rem, 7vw, 5.8rem) 0;
                }

                .section-heading {
                    display: grid;
                    gap: 0.7rem;
                    margin-bottom: 2.6rem;
                    text-align: center;
                    max-width: 60ch;
                    margin-left: auto;
                    margin-right: auto;
                }

                .section-heading h2 {
                    margin: 0;
                    font-size: clamp(2rem, 3.5vw, 2.6rem);
                    letter-spacing: -0.02em;
                }

                .section-heading p {
                    margin: 0;
                    color: var(--text-secondary);
                }

                .step-grid {
                    display: grid;
                    gap: 1.5rem;
                    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                }

                .step-card {
                    background: var(--surface);
                    border: 1px solid var(--border);
                    border-radius: var(--radius-md);
                    padding: 1.8rem;
                    display: grid;
                    gap: 0.9rem;
                    box-shadow: var(--shadow-soft);
                }

                .step-index {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 2.6rem;
                    height: 2.6rem;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--primary), var(--accent));
                    color: #ffffff;
                    font-weight: 600;
                    box-shadow: 0 10px 22px -14px rgba(99, 102, 241, 0.8);
                }

                .step-card h3 {
                    margin: 0;
                    font-size: 1.25rem;
                }

                .step-card p {
                    margin: 0;
                    color: var(--text-secondary);
                }

                .section-muted {
                    background: rgba(99, 102, 241, 0.04);
                    border-top: 1px solid rgba(99, 102, 241, 0.08);
                    border-bottom: 1px solid rgba(99, 102, 241, 0.08);
                }

                .feature-grid {
                    display: grid;
                    gap: 1.5rem;
                    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                }

                .feature-card {
                    background: var(--surface);
                    border: 1px solid var(--border);
                    border-radius: var(--radius-md);
                    padding: 1.9rem;
                    display: grid;
                    gap: 0.85rem;
                    box-shadow: var(--shadow-soft);
                }

                .feature-icon {
                    font-size: 1.85rem;
                }

                .feature-card h3 {
                    margin: 0;
                    font-size: 1.22rem;
                }

                .feature-card p {
                    margin: 0;
                    color: var(--text-secondary);
                }

                .metrics-card {
                    background: var(--surface);
                    border: 1px solid var(--border);
                    border-radius: var(--radius-lg);
                    padding: clamp(2rem, 6vw, 3rem);
                    box-shadow: var(--shadow-md);
                    display: grid;
                    gap: 2.5rem;
                }

                .metrics-header {
                    display: grid;
                    gap: 0.75rem;
                    max-width: 60ch;
                    margin: 0 auto;
                    text-align: center;
                }

                .metrics-grid {
                    display: grid;
                    gap: 1.6rem;
                    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                }

                .metric-value {
                    display: block;
                    font-size: 2rem;
                    font-weight: 700;
                }

                .metric-label {
                    color: var(--text-secondary);
                    font-size: 0.95rem;
                }

                .cta {
                    padding: clamp(3.25rem, 7vw, 5.25rem) 0;
                }

                .cta-inner {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 2rem;
                    padding: clamp(2.25rem, 6vw, 3rem);
                    border-radius: var(--radius-lg);
                    background: linear-gradient(135deg, var(--primary), var(--accent));
                    color: #ffffff;
                    box-shadow: 0 30px 70px -32px rgba(79, 70, 229, 0.75);
                }

                .cta-inner h2 {
                    margin: 0 0 0.6rem;
                    font-size: clamp(1.9rem, 3.3vw, 2.4rem);
                    letter-spacing: -0.02em;
                }

                .cta-inner p {
                    margin: 0;
                    color: rgba(255, 255, 255, 0.82);
                    max-width: 38ch;
                }

                .cta-actions {
                    display: flex;
                    align-items: center;
                    gap: 0.9rem;
                    flex-wrap: wrap;
                }

                .btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.85rem 1.65rem;
                    border-radius: 999px;
                    font-weight: 600;
                    font-size: 0.98rem;
                    border: 1px solid transparent;
                    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                }

                .btn--light {
                    background: #ffffff;
                    color: var(--primary);
                }

                .btn--light:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 16px 36px -18px rgba(255, 255, 255, 0.9);
                }

                .btn--outline {
                    background: transparent;
                    border-color: rgba(255, 255, 255, 0.6);
                    color: #ffffff;
                }

                .btn--outline:hover {
                    background: rgba(255, 255, 255, 0.12);
                }

                .site-footer {
                    padding: 3rem 0 3.5rem;
                }

                .footer-inner {
                    border-top: 1px solid var(--border);
                    padding-top: 2rem;
                    display: grid;
                    gap: 1.5rem;
                }

                .footer-brand {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.6rem;
                    font-weight: 600;
                }

                .footer-links {
                    display: inline-flex;
                    gap: 1.25rem;
                    flex-wrap: wrap;
                    font-size: 0.95rem;
                }

                .footer-links a {
                    color: var(--text-secondary);
                }

                .footer-links a:hover {
                    color: var(--primary);
                    text-decoration: none;
                }

                .footer-copy {
                    margin: 0;
                    color: var(--text-tertiary);
                    font-size: 0.88rem;
                }

                @media (max-width: 1024px) {
                    .hero {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .hero-visual {
                        width: 100%;
                    }
                }

                @media (max-width: 768px) {
                    .header-inner {
                        flex-direction: column;
                        align-items: stretch;
                        gap: 1rem;
                    }

                    .auth-nav {
                        justify-content: flex-start;
                    }
                }

                @media (max-width: 640px) {
                    .container {
                        width: calc(100% - 1.6rem);
                    }

                    .hero-badges {
                        flex-direction: column;
                        align-items: flex-start;
                    }


                    .cta-inner {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .cta-actions {
                        width: 100%;
                    }

                    .cta-actions .btn {
                        width: 100%;
                    }
                }
            </style>
        @endif
    </head>
    <body class="landing-body">
        <header class="site-header">
            <div class="container header-inner">
                <a class="brand" href="{{ url('/') }}">
                    <span class="brand-icon" aria-hidden="true">⬇</span>
                    <span class="brand-name">{{ config('app.name', 'Laravel') }}</span>
                </a>
                @if (Route::has('login'))
                    <nav class="auth-nav">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="auth-link auth-link--primary">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="auth-link">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="auth-link auth-link--primary">
                                    Create account
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>
        <main class="main-content">
            <section class="hero container">
                <div class="hero-content">
                    <p class="eyebrow">Third-party Vimeo API</p>
                    <h1>External API for downloading Vimeo video assets</h1>
                    <p class="hero-subtitle">Integrate our independent service to fetch authorized Vimeo videos, accelerate compliant backups, and feed editing pipelines—once you have the creator’s permission.</p>
                    <div class="info-panel">
                        <span class="info-pill">REST + webhook driven endpoints</span>
                        <span class="info-pill">HD · 4K · 8K Vimeo sources</span>
                        <span class="info-pill">Signed download URL generation</span>
                    </div>
                    <p class="hero-note"><strong>Important:</strong> {{ config('app.name', 'Vimeo Downloader') }} is a third-party solution that is not affiliated with Vimeo. Always confirm that you hold the legal rights to download and store any asset before calling our API.</p>
                    <div class="hero-badges">
                        <div class="badge">
                            <span class="badge-value">99.8%</span>
                            <span class="badge-label">API uptime (past 12 months)</span>
                        </div>
                        <div class="badge">
                            <span class="badge-value">350&nbsp;ms</span>
                            <span class="badge-label">Median response time</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="spotlight-card">
                        <header>How the external API supports your stack</header>
                        <ul class="spotlight-list">
                            <li class="spotlight-item">
                                <span class="spotlight-title">Direct asset retrieval</span>
                                <span class="spotlight-text">Generate time-limited download URLs via our API while honoring Vimeo’s token exchange and the creator’s allowances.</span>
                            </li>
                            <li class="spotlight-item">
                                <span class="spotlight-title">Metadata passthrough</span>
                                <span class="spotlight-text">Return structured JSON containing titles, descriptions, chapters, and subtitle manifests alongside the media payload.</span>
                            </li>
                            <li class="spotlight-item">
                                <span class="spotlight-title">Compliance guardrails</span>
                                <span class="spotlight-text">Built-in rate limiting, IP allowlists, and audit webhooks make it clear who invoked downloads and when.</span>
                            </li>
                        </ul>
                        <div class="spotlight-foot">
                            <strong>Reminder:</strong>
                            <span>This third-party API is independent of Vimeo. Always store access tokens securely and expire them after the download window closes.</span>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section" id="how-it-works">
                <div class="container">
                    <div class="section-heading">
                        <h2>Integrate the API in three clear stages</h2>
                        <p>Follow this flow to remain compliant while automating Vimeo downloads you are authorized to perform.</p>
                    </div>
                    <div class="step-grid">
                        <article class="step-card">
                            <span class="step-index">1</span>
                            <h3>Secure authorization</h3>
                            <p>Collect the creator’s approval, exchange Vimeo OAuth credentials, and register the project inside {{ config('app.name', 'Vimeo Downloader') }}.</p>
                        </article>
                        <article class="step-card">
                            <span class="step-index">2</span>
                            <h3>Call the download endpoint</h3>
                            <p>Pass the Vimeo asset ID to our /videos/{id}/download route, then capture the signed URL, metadata bundle, and status webhooks.</p>
                        </article>
                        <article class="step-card">
                            <span class="step-index">3</span>
                            <h3>Distribute responsibly</h3>
                            <p>Deliver the downloaded file to approved stakeholders, log retention dates, and purge the asset when contractual access expires.</p>
                        </article>
                    </div>
                </div>
            </section>
            <section class="section section-muted">
                <div class="container">
                    <div class="section-heading">
                        <h2>Why teams choose this external API</h2>
                        <p>Independent infrastructure that complements Vimeo while giving engineering teams dependable download automation.</p>
                    </div>
                    <div class="feature-grid">
                        <article class="feature-card">
                            <span class="feature-icon" aria-hidden="true">🔗</span>
                            <h3>Non-affiliated yet compatible</h3>
                            <p>Built to respect Vimeo’s public and partner APIs while operating as a completely separate service you can self-host or consume.</p>
                        </article>
                        <article class="feature-card">
                            <span class="feature-icon" aria-hidden="true">⚙️</span>
                            <h3>Flexible developer tooling</h3>
                            <p>SDKs, Postman collections, and OpenAPI specs make it straightforward to wire downloads into CI/CD or DAM pipelines.</p>
                        </article>
                        <article class="feature-card">
                            <span class="feature-icon" aria-hidden="true">🧾</span>
                            <h3>Detailed audit records</h3>
                            <p>Every download request is logged with user, IP, and asset fingerprints so compliance teams can trace access instantly.</p>
                        </article>
                        <article class="feature-card">
                            <span class="feature-icon" aria-hidden="true">🛡️</span>
                            <h3>Policy-aware safeguards</h3>
                            <p>Rate limiting, DRM checks, and optional watermark detection help prevent misuse and keep creators’ expectations intact.</p>
                        </article>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="container">
                    <div class="metrics-card">
                        <div class="metrics-header">
                            <h2>API performance you can depend on</h2>
                            <p>Operational stats reported by customers embedding the {{ config('app.name', 'Vimeo Downloader') }} third-party API.</p>
                        </div>
                        <div class="metrics-grid">
                            <div>
                                <span class="metric-value">4.6M</span>
                                <span class="metric-label">Vimeo downloads proxied in the past year</span>
                            </div>
                            <div>
                                <span class="metric-value">12</span>
                                <span class="metric-label">Global edge regions serving signed URLs</span>
                            </div>
                            <div>
                                <span class="metric-value">< 1%</span>
                                <span class="metric-label">Error rate across authenticated requests</span>
                            </div>
                            <div>
                                <span class="metric-value">15 min</span>
                                <span class="metric-label">Default lifespan of generated download links</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="cta">
                <div class="container cta-inner">
                    <div>
                        <h2>Ready to integrate an external Vimeo downloader?</h2>
                        <p>Review the API docs, request sandbox credentials, and ship faster while maintaining respect for creator rights.</p>
                    </div>
                    <div class="cta-actions">
                        <a class="btn btn--light" href="#how-it-works">View integration flow</a>
                        <a class="btn btn--outline" href="mailto:support@example.com">Request API keys</a>
                    </div>
                </div>
            </section>
        </main>
        <footer class="site-footer">
            <div class="container footer-inner">
                <div class="footer-brand">
                    <span class="brand-icon" aria-hidden="true">⬇</span>
                    <span>{{ config('app.name', 'Laravel') }}</span>
                </div>
                <div class="footer-links">
                    <a href="#how-it-works">API workflow</a>
                    <a href="#how-it-works">Documentation</a>
                    <a href="mailto:support@example.com">Support</a>
                </div>
                <p class="footer-copy">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
