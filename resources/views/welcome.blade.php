<!DOCTYPE html>
<html>
<head>
    <title>Healthsistant</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#fff5f5; /* Soft, warm, clinical red tint */
            color:#1f2937;
            min-height:100vh;
        }

        /* ================= NAVBAR ================= */

        .navbar{

            width:100%;

            height:80px;

            background:white;

            display:flex;

            justify-content:space-between;

            align-items:center;

            padding:0 70px;

            box-shadow:0 2px 10px rgba(0,0,0,0.05);

            position:sticky;

            top:0;

            z-index:1000;
        }

        .logo{

            display:flex;

            align-items:center;

            gap:12px;
        }

        .logo-icon{

            width:42px;

            height:42px;

            border-radius:12px;

            background:linear-gradient(135deg,#b91c1c,#7f1d1d);

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:18px;
        }

        .logo h2{

            font-size:24px;

            color:#7f1d1d;

            font-weight:700;
        }

        .nav-links a{

            text-decoration:none;

            color:#7f1d1d;

            font-weight:600;

            padding:12px 24px;

            border-radius:10px;

            transition:0.3s;
        }

        .nav-links a:hover{

            background:#7f1d1d;

            color:white;
        }

        /* ================= HERO SECTION ================= */

        .hero{

            width:100%;

            min-height:calc(100vh - 80px);

            display:flex;

            align-items:center;

            justify-content:space-between;

            padding:80px 100px;

            gap:60px;
        }

        .hero-left{

            flex:1;
        }

        .hero-left h1{

            font-size:58px;

            line-height:1.2;

            color:#111827;

            margin-bottom:25px;

            font-weight:700;
        }

        .hero-left h1 span{

            color:#991b1b;
        }

        .hero-left p{

            font-size:17px;

            color:#6b7280;

            line-height:1.8;

            margin-bottom:40px;

            max-width:700px;
        }

        /* ================= BUTTONS ================= */

        .buttons{

            display:flex;

            gap:18px;

            flex-wrap:wrap;
        }

        .btn-primary{

            text-decoration:none;

            background:#991b1b;

            color:white;

            padding:15px 30px;

            border-radius:12px;

            font-weight:600;

            transition:0.3s;

            box-shadow:0 8px 20px rgba(153,27,27,0.2);
        }

        .btn-primary:hover{

            background:#7f1d1d;

            transform:translateY(-2px);
        }

        .btn-secondary{

            text-decoration:none;

            background:white;

            color:#991b1b;

            padding:15px 30px;

            border-radius:12px;

            font-weight:600;

            border:1px solid #e5e7eb;

            transition:0.3s;
        }

        .btn-secondary:hover{

            background:#f3f4f6;
        }

        /* ================= RIGHT CARD ================= */

        .hero-right{

            flex:1;

            display:flex;

            justify-content:center;
        }

        .dashboard-card{

            width:100%;

            max-width:520px;

            background:white;

            border-radius:24px;

            padding:35px;

            box-shadow:0 10px 40px rgba(0,0,0,0.08);
        }

        .dashboard-header{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:35px;
        }

        .dashboard-header h3{

            font-size:22px;

            color:#111827;
        }

        .status{

            background:#dcfce7;

            color:#166534;

            padding:8px 14px;

            border-radius:30px;

            font-size:13px;

            font-weight:600;
        }

        /* ================= STATS ================= */

        .stats{

            display:grid;

            grid-template-columns:repeat(2,1fr);

            gap:20px;

            margin-bottom:30px;
        }

        .stat-box{

            background:#f9fafb;

            border-radius:18px;

            padding:25px;

            border:1px solid #f1f5f9;
        }

        .stat-box i{

            font-size:22px;

            color:#991b1b;

            margin-bottom:15px;
        }

        .stat-box h2{

            font-size:30px;

            margin-bottom:5px;

            color:#111827;
        }

        .stat-box p{

            color:#6b7280;

            font-size:14px;
        }

        /* ================= ANALYTICS ================= */

        .analytics{

            margin-top:20px;
        }

        .analytics h4{

            margin-bottom:20px;

            color:#111827;
        }

        .chart{

            display:flex;

            align-items:flex-end;

            gap:16px;

            height:180px;
        }

        .bar{

            flex:1;

            border-radius:12px 12px 0 0;

            background:linear-gradient(to top,#7f1d1d,#dc2626);

            transition:0.3s;
        }

        .bar:hover{

            opacity:0.8;
        }

        /* ================= FEATURES ================= */

        .features{

            width:100%;

            padding:40px 100px 100px;

            display:grid;

            grid-template-columns:repeat(3,1fr);

            gap:30px;
        }

        .feature-card{

            background:white;

            border-radius:24px;

            padding:35px;

            box-shadow:0 5px 20px rgba(0,0,0,0.05);

            transition:0.3s;
        }

        .feature-card:hover{

            transform:translateY(-5px);
        }

        .feature-icon{

            width:60px;

            height:60px;

            border-radius:16px;

            background:#fee2e2;

            display:flex;

            justify-content:center;

            align-items:center;

            margin-bottom:20px;
        }

        .feature-icon i{

            color:#991b1b;

            font-size:24px;
        }

        .feature-card h3{

            margin-bottom:15px;

            color:#111827;
        }

        .feature-card p{

            color:#6b7280;

            line-height:1.7;

            font-size:15px;
        }

        /* ================= FOOTER ================= */

        .footer{

            background:white;

            border-top:1px solid #e5e7eb;

            padding:25px;

            text-align:center;

            color:#6b7280;

            font-size:14px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:1100px){

            .hero{

                flex-direction:column;

                padding:60px 30px;
            }

            .features{

                grid-template-columns:1fr;

                padding:40px 30px 80px;
            }

            .hero-left h1{

                font-size:42px;
            }

            .navbar{

                padding:0 25px;
            }
        }

    </style>

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <div class="navbar">

        <div class="logo">

            <div class="logo-icon">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <h2>Healthsistant</h2>

        </div>

        <div class="nav-links">

            <a href="/login">

                Login

            </a>

        </div>

    </div>

    <!-- ================= HERO ================= -->

    <section class="hero">

        <div class="hero-left">

            <h1>

                Hospital Patient Management And <br>

                <span>Disease Trend Analytics System</span>

            </h1>

            <p>

                Healthsistant is a modern healthcare management system designed for
                disease monitoring, patient management, admission tracking,
                analytic based medical records.
            </p>
        </div>

        <!-- ================= DASHBOARD CARD ================= -->

        <div class="hero-right">

            <div class="dashboard-card">

                <div class="dashboard-header">

                    <h3>Hospital Overview</h3>

                    <div class="status">

                        System Active

                    </div>

                </div>

                <div class="stats">

                    <div class="stat-box">

                        <i class="fa-solid fa-user-group"></i>

                        <h2>1,245</h2>

                        <p>Total Patients</p>

                    </div>

                    <div class="stat-box">

                        <i class="fa-solid fa-virus"></i>

                        <h2>328</h2>

                        <p>Disease Cases</p>

                    </div>

                    <div class="stat-box">

                        <i class="fa-solid fa-bed"></i>

                        <h2>87</h2>

                        <p>Admissions</p>

                    </div>

                    <div class="stat-box">

                        <i class="fa-solid fa-chart-line"></i>

                        <h2>92%</h2>

                        <p>Prediction Accuracy</p>

                    </div>

                </div>

                <div class="analytics">

                    <h4>Disease Trend Analytics</h4>

                    <div class="chart">

                        <div class="bar" style="height:90px;"></div>

                        <div class="bar" style="height:140px;"></div>

                        <div class="bar" style="height:110px;"></div>

                        <div class="bar" style="height:160px;"></div>

                        <div class="bar" style="height:120px;"></div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= FEATURES ================= -->

    <section class="features">

        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-chart-simple"></i>

            </div>

            <h3>Prediction Analytics</h3>

            <p>

                Analyze disease trends and support prediction decisions
                using historical hospital data and ICD records.

            </p>

        </div>

        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-notes-medical"></i>

            </div>

            <h3>Patient Management</h3>

            <p>

                Efficiently manage patient records, admissions,
                diagnosis information and healthcare operations.

            </p>

        </div>

        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-shield-heart"></i>

            </div>

            <h3>Healthcare Monitoring</h3>

            <p>

                Monitor healthcare trends and improve operational
                awareness with centralized hospital insights.

            </p>

        </div>

    </section>

    <!-- ================= FOOTER ================= -->

    <div class="footer">

        © 2026 Healthsistant — ICD Based Disease Trend Analysis and Prediction System

    </div>

</body>
</html>