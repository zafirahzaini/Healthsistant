<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard - Healthsistant</title>

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
            background: linear-gradient(135deg, #fff8f8, #fef2f2);
            min-height:100vh;
            color:#111827;
        }

        /* ================= LAYOUT ================= */
        .main-container{
            display:flex;
            min-height:100vh;
        }

        .logout-btn a:hover{
            background:#f3f4f6;
        }

        /* ================= CONTENT ================= */
        .content{
            flex:1;
            padding:40px;
            background: radial-gradient(circle at top right, rgba(127,29,29,0.08), transparent 30%);
        }

        /* ================= TOPBAR ================= */
        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
        }

        .topbar h1{
            font-size:42px;
            color:#111827;
            margin-bottom:10px;
        }

        .topbar p{
            color:#6b7280;
            font-size:20px;
        }

        .welcome-box{
            background:white;
            padding:20px 28px;
            border-radius:22px;
            box-shadow:0 8px 25px rgba(127,29,29,0.08);
            text-align:right;
            border:1px solid rgba(127,29,29,0.08);
        }

        .welcome-box h3{
            font-size:18px;
            color:#7f1d1d;
            margin-bottom:6px;
        }

        .welcome-box span{
            color:#6b7280;
            font-size:14px;
        }

        /* ================= OVERVIEW ================= */
        .overview{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:25px;
            margin-bottom:45px;
        }

        .overview-card{
            background:white;
            border-radius:28px;
            padding:30px;
            transition:0.3s;
            border:1px solid rgba(127,29,29,0.08);
            box-shadow:0 10px 30px rgba(0,0,0,0.04);
            position:relative;
            overflow:hidden;
        }

        .overview-card::before{
            content:"";
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:5px;
            background:linear-gradient(90deg, #7f1d1d, #dc2626);
        }

        .overview-card:hover{
            transform:translateY(-6px);
            box-shadow:0 15px 35px rgba(127,29,29,0.12);
        }

        .overview-top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .overview-icon{
            width:62px;
            height:62px;
            border-radius:18px;
            background:linear-gradient(135deg, #fee2e2, #fecaca);
            display:flex;
            justify-content:center;
            align-items:center;
            color:#991b1b;
            font-size:24px;
        }

        .overview-card h2{
            font-size:38px;
            color:#111827;
            margin-bottom:10px;
        }

        .overview-card p{
            color:#6b7280;
            font-size:15px;
        }

        /* ================= SECTION TITLE ================= */
        .section-title{
            font-size:28px;
            margin-bottom:28px;
            color:#111827;
        }

        /* ================= CARDS ================= */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:30px;
        }

        .card{
            background:white;
            border-radius:30px;
            padding:38px;
            transition:0.3s;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            border:1px solid rgba(127,29,29,0.08);
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:"";
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:6px;
            background:linear-gradient(90deg, #7f1d1d, #dc2626);
        }

        .card:hover{
            transform:translateY(-7px);
            box-shadow:0 18px 40px rgba(127,29,29,0.12);
        }

        .card-icon{
            width:70px;
            height:70px;
            border-radius:22px;
            background:linear-gradient(135deg, #fee2e2, #fecaca);
            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:28px;
        }

        .card-icon i{
            font-size:30px;
            color:#991b1b;
        }

        .card h2{
            font-size:30px;
            margin-bottom:16px;
            color:#111827;
        }

        .card p{
            color:#6b7280;
            line-height:1.9;
            margin-bottom:30px;
            font-size:15px;
        }

        .card a{
            display:inline-flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
            background:linear-gradient(135deg, #7f1d1d, #991b1b);
            color:white;
            padding:14px 26px;
            border-radius:14px;
            font-size:14px;
            font-weight:600;
            transition:0.3s;
        }

        .card a:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(127,29,29,0.2);
        }

        @media(max-width:1000px){
            .sidebar{ display:none; }
            .content{ padding:25px; }
            .topbar{ flex-direction:column; align-items:flex-start; gap:20px; }
        }
    </style>
</head>
<body>

<div class="main-container">

   @include('layouts.admin_sidebar')

    <!-- ================= CONTENT ================= -->
    <div class="content">
        <div class="topbar">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Monitor hospital operations and healthcare system activities</p>
            </div>

            <div class="welcome-box">
                <h3>Welcome, {{ session('name') }}</h3>
            </div>
        </div>

        <!-- OVERVIEW -->
        <div class="overview">

            <!-- Real Total Staff Counter -->
            <div class="overview-card">
                <div class="overview-top">
                    <div class="overview-icon">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                </div>
                <h2>{{ $totalStaff }}</h2>
                <p>Total Medical Staff</p>
            </div>

            <!-- Real Registered Patients Counter -->
            <div class="overview-card">
                <div class="overview-top">
                    <div class="overview-icon">
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>
                </div>
                <h2>{{ $totalPatients }}</h2>
                <p>Registered Patients</p>
            </div>

            <!-- Real Dynamic Alternative Metric 1: Waiting Triage Queue -->
            <div class="overview-card">
                <div class="overview-top">
                    <div class="overview-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <h2>{{ $waitingCount }}</h2>
                <p>Patients in Queue</p>
            </div>

            <!-- Real Dynamic Alternative Metric 2: Active Inpatients -->
            <div class="overview-card">
                <div class="overview-top">
                    <div class="overview-icon">
                        <i class="fa-solid fa-bed-pulse"></i>
                    </div>
                </div>
                <h2>{{ $admittedCount }}</h2>
                <p>Active Admissions</p>
            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <h2 class="section-title">Quick Actions</h2>

        <div class="cards">

            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <h2>Add Staff</h2>
                <p>Create staff accounts and assign healthcare roles securely.</p>
                <a href="/staff/add">Open Module</a>
            </div>

            <!-- REPLACED MODULE: Patient Journey Tracker -->
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-route"></i>
                </div>
                <h2>Patient Journey</h2>
                <p>Track patient movement, diagnostics tracking, and status metrics.</p>
                <a href="/patient-journey">Open Module</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h2>Run Prediction</h2>
                <p>Analyze disease trends and generate prediction insights.</p>
                <a href="/prediction">Open Module</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-bed-pulse"></i>
                </div>
                <h2>Admissions</h2>
                <p>Manage hospital admissions and patient information.</p>
                <a href="/admission/list">Open Module</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>