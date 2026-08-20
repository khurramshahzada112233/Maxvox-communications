<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaxVox Communications | Premier U.S. Campaign Call Center</title>
    <!-- Fonts matching the premium aesthetic -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Oswald:wght@400;700&family=Montserrat:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: #ffffff;
            color: #1A202C; /* Charcoal Grey Main Text */
            overflow-x: hidden;
            padding-top: 100px;
        }

        /* Premium Minimal Top Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background-color: #ffffff;
            border-bottom: 2px solid #008080; /* Teal Green Bottom Border */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        /* Clean Text Logo Layout */
        .logo-text-container {
            text-decoration: none;
            display: flex;
            flex-direction: column;
        }

        .logo-main-text {
            font-family: 'Oswald', sans-serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #008080; /* Teal Green Logo Main */
            text-transform: uppercase;
            line-height: 1;
        }

        .logo-sub-text {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            color: #1A202C; /* Charcoal Grey Logo Sub */
            text-transform: uppercase;
            margin-top: 4px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px; /* Adjusted gap to accommodate social icons nicely */
        }

        .nav-links a {
            text-decoration: none;
            color: #1A202C; /* Charcoal Grey */
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .nav-links a:hover {
            color: #008080; /* Teal Green Hover */
        }

        /* Social Icons Styling in Navbar */
        .nav-links a.social-link {
            font-size: 16px;
            text-transform: none;
            letter-spacing: normal;
        }

        /* Custom Header Styling Typefaces */
        .w4-sub-header {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #008080; /* Teal Green Sub-header */
            display: block;
            margin-bottom: 15px;
            font-style: italic;
        }

        .w4-main-title {
            font-family: 'Oswald', sans-serif;
            font-size: 42px;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.3;
            color: #1A202C; /* Charcoal Grey */
            font-weight: 700;
        }

        /* Premium Background Image Fallback Strategy */
        .hero-section {
            position: relative;
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 0;
            overflow: hidden;
            background: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover;
        }

        /* HTML5 Native Video Stream Controller */
        .hero-video-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2;
            transform: translate(-50%, -50%);
            object-fit: cover;
            display: block;
        }

        /* Cinematic Contrast Filter Overlay - Charcoal Blend */
        .hero-video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(26, 32, 44, 0.85) 0%, rgba(13, 16, 22, 0.95) 100%);
            z-index: -1;
        }

        /* Centered Full-Width Hero Grid */
        .hero-container {
            width: 80%;
            max-width: 1000px;
            display: block;
            text-align: center;
            z-index: 1;
        }

        .hero-content h1 {
            color: #ffffff;
            font-family: 'Oswald', sans-serif;
            font-size: 52px;
            text-transform: uppercase;
            line-height: 1.2;
            letter-spacing: 1px;
            margin-bottom: 35px;
        }

        /* Apply Button - Charcoal & Teal Setup */
        .hero-btn-apply {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #008080; /* Teal Green */
            color: #ffffff;
            text-decoration: none;
            padding: 16px 40px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            border: 1px solid #008080;
            margin-bottom: 40px;
        }

        .hero-btn-apply:hover {
            background-color: transparent;
            color: #ffffff;
            border-color: #ffffff;
        }

        /* Stats & Requirements Modules */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(0, 128, 128, 0.3); /* Teal Tint Border */
            padding: 25px 20px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-family: 'Oswald', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: #008080; /* Teal Green Numbers */
        }

        .stat-label {
            font-size: 11px;
            color: #dddddd;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 5px;
        }

        /* ==================== INTERACTIVE MODAL POPUP SYSTEM ==================== */
        .contact-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 32, 44, 0.85); /* Dark Charcoal transparent cover */
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s ease;
        }

        .contact-modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .contact-panel {
            background: #ffffff;
            width: 90%;
            max-width: 550px;
            max-height: 85vh;
            overflow-y: auto;
            padding: 40px;
            border-top: 5px solid #008080; /* Teal Top Border Accenting */
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            position: relative;
            transform: scale(0.85);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .contact-modal-overlay.active .contact-panel {
            transform: scale(1);
        }

        .modal-close-btn {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 32px;
            color: #1A202C;
            cursor: pointer;
            transition: color 0.3s;
            line-height: 1;
        }

        .modal-close-btn:hover {
            color: #008080;
        }

        .panel-section-title {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            color: #1A202C; /* Charcoal Grey */
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
            position: relative;
        }

        .panel-section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 35px;
            height: 2px;
            background-color: #008080; /* Teal Underline */
        }

        .panel-divider {
            border: 0;
            height: 1px;
            background: #eeeeee;
            margin: 25px 0;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            text-align: left;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .icon-box {
            color: #008080; /* Teal Icons */
            font-size: 16px;
            margin-top: 2px;
            width: 20px;
            text-align: center;
        }

        .contact-details label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: #888888;
            text-transform: uppercase;
            margin-bottom: 3px;
            letter-spacing: 1px;
        }

        .contact-details p {
            font-size: 13px;
            color: #1A202C; /* Charcoal Grey Text */
            font-weight: 600;
            line-height: 1.4;
        }

        /* Section Global Typography Framework */
        .section-padding {
            padding: 90px 10%;
        }

        .section-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }

        .section-header p {
            color: #555555;
            font-size: 15px;
            line-height: 1.7;
            margin-top: 15px;
        }

        /* Verticals Structured Cards Grid */
        .verticals-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .vertical-card {
            background: #ffffff;
            padding: 40px 30px;
            border: 1px solid #eeeeee;
            transition: all 0.3s ease;
        }

        .vertical-card:hover {
            border-color: #008080; /* Teal Border Hover */
        }

        .vertical-card i {
            font-size: 24px;
            color: #008080; /* Teal Icons */
            margin-bottom: 20px;
        }

        .vertical-card h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 18px;
            color: #1A202C; /* Charcoal Grey */
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .vertical-card p {
            font-size: 13px;
            color: #666666;
            line-height: 1.6;
        }

        /* Mission, Vision, Culture Dynamic Pillars */
        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 60px;
        }

        .pillar-card {
            background: #ffffff;
            padding: 40px 30px;
            border: 1px solid #eeeeee;
            border-bottom: 3px solid #1A202C; /* Charcoal Accent */
        }

        .pillar-card:nth-child(2) {
            border-bottom: 3px solid #008080; /* Teal Accent for middle card */
        }

        .pillar-card h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            color: #1A202C;
        }

        .pillar-card p {
            color: #555555;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Perks Framework Structural Alignment */
        .why-us-section {
            background-color: #f8fafc;
            border-top: 1px solid #eeeeee;
        }

        .perks-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .perk-card {
            display: flex;
            gap: 20px;
            background: #ffffff;
            padding: 35px;
            border: 1px solid #eeeeee;
        }

        .perk-icon {
            color: #008080; /* Teal Icons */
            font-size: 20px;
            margin-top: 3px;
        }

        .perk-info h4 {
            font-family: 'Oswald', sans-serif;
            font-size: 16px;
            color: #1A202C; /* Charcoal */
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .perk-info p {
            font-size: 13px;
            color: #555555;
            line-height: 1.6;
        }

        /* Uncapped Bonus Area - Highlighting theme colors */
        .uncapped-bonus {
            grid-column: span 2;
            background: #1A202C; /* Charcoal Background */
            color: #ffffff;
            text-align: center;
            padding: 40px;
            margin-top: 10px;
            border-top: 4px solid #008080; /* Teal Top Accent */
        }

        .uncapped-bonus h4 {
            font-family: 'Oswald', sans-serif;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
            color: #ffffff;
        }

        .uncapped-bonus p {
            font-size: 13px;
            color: #cccccc;
            letter-spacing: 0.5px;
        }

        /* Fixed Action Pointer - Teal Color */
        .floating-action {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #008080; /* Teal Green */
            color: #ffffff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            z-index: 999;
            transition: transform 0.3s;
        }

        .floating-action:hover {
            transform: scale(1.05);
            background-color: #1A202C; /* Turns Charcoal on hover */
        }

        /* Screen Media Breakpoints */
        @media(max-width: 1024px) {
            .hero-container, .verticals-container, .pillars-grid, .perks-grid {
                grid-template-columns: 1fr;
            }
            .uncapped-bonus {
                grid-column: span 1;
            }
            .navbar {
                padding: 15px 5%;
            }
            .nav-links {
                gap: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Premium Header Navbar with Typography Logo -->
    <header class="navbar">
        <a href="#" class="logo-text-container">
            <span class="logo-main-text">MaxVox</span>
            <span class="logo-sub-text">Communications</span>
        </a>
        <nav class="nav-links">
            <a href="#about">About Us</a>
            <a href="#why-us">Why Work With Us</a>
            <a href="#perks">Perks</a>
            <!-- Clickable Contact Us Link -->
            <a onclick="toggleModal(true)">Contact Us</a>
            
            <!-- Social Media Links with Proper Icons -->
            <a href="https://www.facebook.com/share/1BbGb5DE9j/" target="_blank" class="social-link" title="Facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/maxvox_communications?igsh=YXo1amsycjZ1dnhz" target="_blank" class="social-link" title="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>

            <a href="apply.html">Apply Now</a>
        </nav>
    </header>

    <!-- Main Content Hero Canvas with Rich Visual Fallback Strategy -->
    <section class="hero-section">
        <video id="bgVideo" class="hero-video-bg" autoplay loop muted playsinline preload="auto">
            <source src="https://v1.mixkit.co/videos/preview/mixkit-business-people-working-together-in-an-office-42171-large.mp4" type="video/mp4">
        </video>
        <div class="hero-video-overlay"></div>
        
        <div class="hero-container">
            <div class="hero-content">
                <h1>Build Your Career With One of Pakistan's Fast Growing U.S. Campaign Call Centers.</h1>
                
                <a href="apply.html" class="hero-btn-apply">
                    Apply Now <i class="fa-solid fa-arrow-right" style="font-size: 12px; margin-left: 5px;"></i>
                </a>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">250+</div>
                        <div class="stat-label">Applicants</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">7 Days</div>
                        <div class="stat-label">Training</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">70</div>
                        <div class="stat-label">Growth Score</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE CONTACT & CAMPAIGN MODAL WINDOW -->
    <div class="contact-modal-overlay" id="contactModal" onclick="closeModalOutside(event)">
        <div class="contact-panel">
            <span class="modal-close-btn" onclick="toggleModal(false)">&times;</span>
            
            <!-- Section 1: Contact Information -->
            <div class="panel-section-title">Contact Information</div>
            
            <div class="contact-item">
                <div class="icon-box"><i class="fa-regular fa-envelope"></i></div>
                <div class="contact-details">
                    <label>Email Address</label>
                    <p>carriers@maxvoxcommunications.com</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <div class="contact-details">
                    <label>WhatsApp / Mobile</label>
                    <p>+92 320 5042512</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                <div class="contact-details">
                    <label>Landline</label>
                    <p>+92 51 8744882</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                <div class="contact-details">
                    <label>Office Address</label>
                    <p>Office 26 & 27, Mid City Center, Murree Road, Rawalpindi, Pakistan</p>
                </div>
            </div>

            <hr class="panel-divider">

            <!-- Section 2: ACA / Medicare Campaign & Eligibility Info Header -->
            <div class="panel-section-title">Campaign & Eligibility</div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-regular fa-clock"></i></div>
                <div class="contact-details">
                    <label>Operations Shift</label>
                    <p>Night Shift: 6 PM - 4 AM</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-solid fa-user-check"></i></div>
                <div class="contact-details">
                    <label>Hiring Criteria</label>
                    <p>Age 18+, Strong English Communication, Career-Driven Mindset</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="icon-box"><i class="fa-solid fa-briefcase"></i></div>
                <div class="contact-details">
                    <label>Core Verticals</label>
                    <p>U.S. Final Expense, Medicare Advantage, ACA Health Insurance</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section with Clean Typography Matrix -->
    <section class="section-padding" style="background-color: #ffffff;" id="about">
        <div class="section-header">
            <span class="w4-sub-header">Our Company</span>
            <h2 class="w4-main-title">About MaxVox Communications</h2>
            <p>MaxVox Communications is a Pakistan-based premier call center specializing in major U.S. healthcare and insurance campaigns. We are dedicated to top-tier hiring, rigorous professional training, and continuous performance growth across multiple specialized verticals.</p>
        </div>

        <div class="verticals-container">
            <div class="vertical-card">
                <i class="fa-solid fa-shield-heart"></i>
                <h3>U.S. Final Expense Life Insurance</h3>
                <p>Focused agent allocation on driving outbound conversions for standard enterprise-level global verticals.</p>
            </div>
            <div class="vertical-card">
                <i class="fa-solid fa-user-doctor"></i>
                <h3>Medicare Advantage & Supplement</h3>
                <p>Comprehensive solutions providing premium navigation through intricate U.S. Health structural designs.</p>
            </div>
            <div class="vertical-card">
                <i class="fa-solid fa-hospital"></i>
                <h3>ACA Health Insurance Systems</h3>
                <p>Targeted operational strategies under Affordable Care Act systems optimizing floor performance milestones.</p>
            </div>
        </div>

        <div class="pillars-grid">
            <div class="pillar-card">
                <h3>🎯 Mission</h3>
                <p>To foster a disciplined, high-reward workplace where communication professionals hone enterprise-level skills, deliver exceptional value in U.S. healthcare and insurance verticals, and maximize their earning potential through performance.</p>
            </div>
            <div class="pillar-card">
                <h3>🚀 Vision</h3>
                <p>To become Pakistan’s premier, trusted recruitment and operational hub for top-tier call center talent, recognized globally for excellence in executing complex offshore campaigns.</p>
            </div>
            <div class="pillar-card">
                <h3>🌟 Culture</h3>
                <p>Built on data-driven professional coaching, transparent performance standards, high floor energy, and a leadership team deeply invested in sustainable career growth and agent well-being.</p>
            </div>
        </div>
    </section>

    <!-- Perks Framework System -->
    <section class="section-padding why-us-section" id="why-us">
        <div class="section-header">
            <span class="w4-sub-header">Careers & Growth</span>
            <h2 class="w4-main-title">Why Work With Us</h2>
            <p>MaxVox is custom-built for ambitious candidates who thrive in a polished, professional office environment, demand practical enterprise coaching, and want their hard work recognized through industry-leading performance rewards.</p>
        </div>

        <div class="section-header" style="margin-bottom: 20px;" id="perks">
            <span class="w4-sub-header" style="font-size: 18px;">What We Offer (Our Perks & Benefits)</span>
        </div>

        <div class="perks-grid">
            <div class="perk-card">
                <div class="perk-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                <div class="perk-info">
                    <h4>Comprehensive Health Insurance</h4>
                    <p>Ensuring peace of mind and secure medical coverage for our dedicated team members.</p>
                </div>
            </div>

            <div class="perk-card">
                <div class="perk-icon"><i class="fa-solid fa-piggy-bank"></i></div>
                <div class="perk-info">
                    <h4>Provident Fund Scheme</h4>
                    <p>Helping our employees build long-term financial security and savings for their future.</p>
                </div>
            </div>

            <div class="perk-card">
                <div class="perk-icon"><i class="fa-solid fa-utensils"></i></div>
                <div class="perk-info">
                    <h4>Catered Dinners & Team Outings</h4>
                    <p>Regular company-sponsored dinners and outdoor recreational trips to unwind and celebrate our success together.</p>
                </div>
            </div>

            <div class="perk-card">
                <div class="perk-icon"><i class="fa-solid fa-gamepad"></i></div>
                <div class="perk-info">
                    <h4>Engaging Fun Activities</h4>
                    <p>A vibrant workplace culture featuring indoor games, stress-relief sessions, and energetic floor activities.</p>
                </div>
            </div>

            <div class="uncapped-bonus">
                <h4>Uncapped Commissions & Cash Rewards</h4>
                <p>Daily, weekly, and monthly performance bonuses that reward your hard work instantly.</p>
            </div>
        </div>
    </section>

    <!-- Floating Trigger Widget -->
    <div class="floating-action" onclick="window.open('https://wa.me/923205042512', '_blank')">
        <i class="fa-brands fa-whatsapp"></i>
    </div>

    <!-- Interactive Logic Script for Modal Window Control -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('contactModal');
            if (show) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; /* Stops background scroll when open */
            } else {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function closeModalOutside(e) {
            if (e.target.id === 'contactModal') {
                toggleModal(false);
            }
        }
    </script>

</body>
</html>
