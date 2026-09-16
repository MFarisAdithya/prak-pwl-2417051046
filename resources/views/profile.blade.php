<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Student Archive &mdash; {{ $nama ?? 'M. Faris Adithya' }}</title>
    
    <!-- Google Font: Montserrat (All typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Parchment & Antique Paper Palette */
            --color-paper-base: #F5E5C4;
            --color-paper-light: #FDF4DF;
            --color-paper-mid: #E8D0A1;
            --color-paper-burn: #C59E60;
            --color-paper-dark: #8C622C;
            --color-wood-bg: #F4EFE6;

            /* Typography Colors: Rich Coffee & Burned Sienna */
            --color-ink-primary: #332014;
            --color-ink-secondary: #563B26;
            --color-ink-muted: #7A573B;
            --color-accent-gold: #B38838;
            --color-accent-gold-light: #DFC07D;
            --color-border-subtle: rgba(140, 98, 44, 0.4);

            /* Typography */
            --font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background-color: var(--color-wood-bg);
            color: var(--color-ink-primary);
            font-family: var(--font-family);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.25rem;
            position: relative;
            overflow-x: hidden;
            /* Background vintage ambiance */
            background-image: 
                radial-gradient(circle at 50% 30%, #FAF6EE 0%, #EDE4D3 70%, #E2D5C0 100%),
                url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.035'/%3E%3C/svg%3E");
            background-attachment: fixed;
        }

        /* Decorative Botanical Twig Branches in the Corners (Inspired by the reference image) */
        .botanical-branch {
            position: fixed;
            width: 170px;
            height: 170px;
            pointer-events: none;
            z-index: 1;
            opacity: 0.88;
            filter: drop-shadow(0 2px 4px rgba(92, 60, 20, 0.15));
            transition: transform 0.5s ease;
        }

        .branch-top-left {
            top: 25px;
            left: 25px;
        }

        .branch-bottom-right {
            bottom: 25px;
            right: 25px;
        }

        /* Main Parchment Paper Card */
        .parchment-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 590px;
            /* Aged Parchment Texture with Paper grain and edge burns */
            background: 
                url("{{ asset('assets/paper-texture.png') }}") center/cover no-repeat,
                radial-gradient(ellipse at 50% 45%, #FDF4E1 0%, #F5E2B8 45%, #E3C58B 80%, #CFA765 100%);
            border-radius: 8px;
            padding: 3.6rem 3.2rem 3rem;
            /* Thin burned ink border */
            border: 1.5px solid var(--color-paper-dark);
            /* Burned edges & vintage parchment shadows */
            box-shadow: 
                inset 0 0 65px rgba(140, 98, 44, 0.35),
                inset 0 0 20px rgba(92, 59, 21, 0.25),
                0 3px 6px rgba(60, 40, 15, 0.08),
                0 15px 35px rgba(60, 40, 15, 0.16),
                0 30px 65px rgba(60, 40, 15, 0.14);
            animation: parchmentAppear 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Subtle Deckled / Rough Inner Framing */
        .parchment-card::after {
            content: '';
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(140, 98, 44, 0.45);
            border-radius: 6px;
            pointer-events: none;
            box-shadow: inset 0 0 15px rgba(180, 136, 68, 0.12);
        }

        /* Dog-ear Curled Corners (Top-Left and Bottom-Right like the reference image!) */
        .corner-fold-tl {
            position: absolute;
            top: 0;
            left: 0;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #B58A46 0%, #8C622C 45%, transparent 50%);
            border-bottom-right-radius: 4px;
            box-shadow: 2px 2px 6px rgba(50, 30, 10, 0.3);
            pointer-events: none;
            z-index: 5;
        }

        .corner-fold-br {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 42px;
            height: 42px;
            background: linear-gradient(315deg, #A77C38 0%, #7E5420 45%, transparent 50%);
            border-top-left-radius: 4px;
            box-shadow: -2px -2px 6px rgba(50, 30, 10, 0.3);
            pointer-events: none;
            z-index: 5;
        }

        /* Vintage Monogram Archive Seal */
        .archive-seal {
            position: absolute;
            top: 26px;
            right: 28px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 1.5px dashed var(--color-paper-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(253, 244, 225, 0.7);
            box-shadow: 0 2px 6px rgba(60, 40, 15, 0.1);
            z-index: 6;
            transition: all 0.4s ease;
        }

        .archive-seal:hover {
            transform: rotate(10deg) scale(1.08);
            border-color: var(--color-ink-primary);
            box-shadow: 0 4px 12px rgba(60, 40, 15, 0.18);
        }

        .seal-monogram {
            font-family: var(--font-family);
            font-weight: 800;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            color: var(--color-ink-primary);
        }

        /* Header / Editorial Title */
        .archive-header {
            text-align: center;
            margin-bottom: 2.2rem;
            position: relative;
        }

        .divider-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin: 0.6rem 0;
        }

        .divider-line {
            height: 1.5px;
            flex: 1;
            max-width: 120px;
            background: linear-gradient(90deg, transparent, var(--color-paper-dark), transparent);
        }

        .divider-diamond {
            color: var(--color-paper-dark);
            font-size: 0.75rem;
            line-height: 1;
        }

        .archive-title {
            font-family: var(--font-family);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.36em;
            text-transform: uppercase;
            color: var(--color-ink-primary);
            margin-top: 0.25rem;
        }

        .archive-subtitle {
            font-family: var(--font-family);
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--color-ink-muted);
            margin-top: 0.35rem;
        }

        /* Profile Portrait Center */
        .profile-photo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.8rem;
            position: relative;
        }

        .profile-ring-outer {
            width: 148px;
            height: 148px;
            border-radius: 50%;
            padding: 5px;
            /* Thin dark brown outer ring */
            border: 2px solid var(--color-ink-primary);
            background: rgba(253, 244, 225, 0.85);
            box-shadow: 
                0 4px 16px rgba(60, 40, 15, 0.16),
                0 1px 3px rgba(60, 40, 15, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.45s ease;
        }

        .profile-ring-outer:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 
                0 10px 26px rgba(60, 40, 15, 0.24),
                0 3px 8px rgba(179, 136, 56, 0.3);
        }

        .profile-ring-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            /* Thin golden paper ring */
            border: 1.5px solid var(--color-paper-dark);
            padding: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FDF6E8;
            overflow: hidden;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        /* Classic Academic Silhouette Avatar Fallback */
        .avatar-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(145deg, #F3E5C7 0%, #DFC59B 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-ink-secondary);
        }

        /* Identity Block: Name & Subtitle in Montserrat */
        .identity-block {
            text-align: center;
            margin-bottom: 2.2rem;
        }

        .student-name {
            font-family: var(--font-family);
            font-size: 2.15rem;
            font-weight: 800;
            color: var(--color-ink-primary);
            line-height: 1.2;
            letter-spacing: 0.02em;
            margin-bottom: 0.45rem;
            text-shadow: 0 1px 2px rgba(255, 255, 255, 0.5);
        }

        .student-role {
            font-family: var(--font-family);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.26em;
            text-transform: uppercase;
            color: var(--color-ink-muted);
            display: inline-block;
            padding: 0 0.5rem;
        }

        /* Information Grid: KELAS & NPM in Montserrat */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 2.2rem;
        }

        .info-card {
            background: rgba(255, 248, 235, 0.75);
            border: 1.5px solid var(--color-paper-dark);
            border-radius: 6px;
            padding: 1.2rem 1.25rem 1.15rem;
            position: relative;
            box-shadow: 
                inset 0 0 15px rgba(200, 160, 100, 0.15),
                0 3px 8px rgba(60, 40, 15, 0.06);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        /* Antique Gold Top Accent Bar */
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--color-paper-dark), var(--color-accent-gold), var(--color-accent-gold-light));
            opacity: 0.9;
            transition: height 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 250, 240, 0.9);
            box-shadow: 
                inset 0 0 20px rgba(200, 160, 100, 0.25),
                0 8px 20px rgba(60, 40, 15, 0.12);
        }

        .info-card:hover::before {
            height: 4px;
        }

        .info-label {
            font-family: var(--font-family);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--color-ink-muted);
            margin-bottom: 0.45rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-label-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: var(--color-accent-gold);
            display: inline-block;
        }

        .info-value {
            font-family: var(--font-family);
            font-size: 1.32rem;
            font-weight: 700;
            color: var(--color-ink-primary);
            line-height: 1.25;
            letter-spacing: 0.01em;
        }

        /* Academic Identity Footer in Montserrat */
        .archive-footer {
            text-align: center;
            position: relative;
            padding-top: 1.4rem;
        }

        .footer-line {
            height: 1.5px;
            width: 100%;
            background: linear-gradient(90deg, transparent, var(--color-paper-dark), transparent);
            margin-bottom: 1.15rem;
            position: relative;
        }

        .footer-line::after {
            content: '◇';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ECD4A4;
            padding: 0 10px;
            font-size: 0.7rem;
            color: var(--color-paper-dark);
            border-radius: 4px;
        }

        .univ-major {
            font-family: var(--font-family);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.26em;
            text-transform: uppercase;
            color: var(--color-ink-primary);
            margin-bottom: 0.3rem;
        }

        .univ-name {
            font-family: var(--font-family);
            font-size: 0.94rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--color-ink-secondary);
        }

        /* Entry Animation */
        @keyframes parchmentAppear {
            0% {
                opacity: 0;
                transform: translateY(22px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 620px) {
            body {
                padding: 1.5rem 1rem;
            }

            .parchment-card {
                padding: 2.8rem 1.6rem 2.2rem;
            }

            .student-name {
                font-size: 1.75rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.9rem;
            }

            .botanical-branch {
                display: none;
            }

            .archive-seal {
                top: 18px;
                right: 20px;
                width: 38px;
                height: 38px;
            }
        }

        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .parchment-card {
                box-shadow: none !important;
                border: 2px solid #8C622C !important;
                max-width: 100% !important;
            }
            .botanical-branch {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Botanical Twig Branches (Matching the Reference Image style & warm golden-brown color #8C622C) -->
    <svg class="botanical-branch branch-top-left" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Main Stem -->
        <path d="M12 12 C 45 42, 85 88, 140 142" stroke="#8C622C" stroke-width="2.6" stroke-linecap="round"/>
        <!-- Side Twigs with Berry Nodes -->
        <path d="M42 42 L 24 66" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="21" cy="70" r="5.5" fill="#8C622C"/>
        <path d="M62 62 L 86 38" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="90" cy="34" r="6" fill="#8C622C"/>
        <path d="M84 84 L 62 108" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="58" cy="112" r="5.8" fill="#8C622C"/>
        <path d="M104 104 L 128 80" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="132" cy="76" r="5.5" fill="#8C622C"/>
        <path d="M124 124 L 112 146" stroke="#8C622C" stroke-width="2" stroke-linecap="round"/>
        <circle cx="109" cy="151" r="5" fill="#8C622C"/>
        <circle cx="142" cy="144" r="5.5" fill="#8C622C"/>
    </svg>

    <svg class="botanical-branch branch-bottom-right" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Main Stem -->
        <path d="M148 148 C 115 118, 75 72, 20 18" stroke="#8C622C" stroke-width="2.6" stroke-linecap="round"/>
        <!-- Side Twigs with Berry Nodes -->
        <path d="M118 118 L 136 94" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="139" cy="90" r="5.5" fill="#8C622C"/>
        <path d="M98 98 L 74 122" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="70" cy="126" r="6" fill="#8C622C"/>
        <path d="M76 76 L 98 52" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="102" cy="48" r="5.8" fill="#8C622C"/>
        <path d="M56 56 L 32 80" stroke="#8C622C" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="28" cy="84" r="5.5" fill="#8C622C"/>
        <path d="M36 36 L 48 14" stroke="#8C622C" stroke-width="2" stroke-linecap="round"/>
        <circle cx="51" cy="9" r="5" fill="#8C622C"/>
        <circle cx="18" cy="16" r="5.5" fill="#8C622C"/>
    </svg>

    <!-- Main Parchment Paper Profile Card -->
    <main class="parchment-card">
        <!-- Curled Corner Fold Effects (like the reference image) -->
        <div class="corner-fold-tl"></div>
        <div class="corner-fold-br"></div>

        <!-- Academic Monogram Seal (FA) in Montserrat -->
        <div class="archive-seal" title="M. Faris Adithya &bull; Seal">
            <span class="seal-monogram">FA</span>
        </div>

        <!-- Header -->
        <header class="archive-header">
            <div class="divider-row">
                <span class="divider-line"></span>
                <span class="divider-diamond">&#9671;</span>
                <span class="divider-line"></span>
            </div>
            <h2 class="archive-title">THE STUDENT ARCHIVE</h2>
            <p class="archive-subtitle">PERSONAL PROFILE</p>
            <div class="divider-row">
                <span class="divider-line"></span>
                <span class="divider-diamond">&#9671;</span>
                <span class="divider-line"></span>
            </div>
        </header>

        <!-- Profile Photo -->
        <div class="profile-photo-container">
            <div class="profile-ring-outer">
                <div class="profile-ring-inner">
                    <img 
                        src="{{ asset('assets/profile.jpg') }}" 
                        alt="{{ $nama ?? 'M. Faris Adithya' }}"
                        class="profile-img"
                        onerror="this.style.display='none'; document.getElementById('avatar-fallback').style.display='flex';"
                    >
                    <div id="avatar-fallback" class="avatar-placeholder" style="display: none;">
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="currentColor" opacity="0.8">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Name & Subtitle (All Montserrat) -->
        <div class="identity-block">
            <h1 class="student-name">{{ $nama ?? 'M. Faris Adithya' }}</h1>
            <p class="student-role">ILMU KOMPUTER STUDENT</p>
        </div>

        <!-- Student Information Cards: KELAS & NPM (All Montserrat) -->
        <section class="info-grid" aria-label="Student Academic Information">
            <div class="info-card">
                <div class="info-label">
                    <span class="info-label-dot"></span>
                    KELAS
                </div>
                <div class="info-value">{{ $kelas ?? 'Ilmu Komputer A' }}</div>
            </div>

            <div class="info-card">
                <div class="info-label">
                    <span class="info-label-dot"></span>
                    NPM
                </div>
                <div class="info-value">{{ $NPM ?? '2417051046' }}</div>
            </div>
        </section>

        <!-- University Identity Footer (All Montserrat) -->
        <footer class="archive-footer">
            <div class="footer-line"></div>
            <p class="univ-major">ILMU KOMPUTER</p>
            <p class="univ-name">UNIVERSITAS LAMPUNG</p>
        </footer>
    </main>

    <script>
        const img = document.querySelector('.profile-img');
        if (img && (!img.complete || img.naturalWidth === 0)) {
            img.onerror();
        }
    </script>
</body>
</html>