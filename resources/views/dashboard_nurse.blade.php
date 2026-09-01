<!DOCTYPE html>
<html>
<head>

    <title>Nurse Dashboard - Healthsistant</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            font-family:'Poppins',sans-serif;

           background:
            linear-gradient(
                135deg,
                #f8fbff,
                #eef6ff
            );

            min-height:100vh;

            color:#111827;
        }

        /* ================= LAYOUT ================= */

        .main-container{

            display:flex;

            min-height:100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{

            width:290px;

            background:linear-gradient(
            180deg,
            #1e40af,
            #1e3a8a
        );

            padding:30px 22px;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

            box-shadow:5px 0 25px rgba(0,0,0,0.08);
        }

        /* ================= LOGO ================= */

        .logo-section{

            margin-bottom:45px;
        }

        .logo{

            display:flex;

            align-items:center;

            gap:14px;
        }

        .logo-box{

            width:58px;

            height:58px;

            border-radius:18px;

            background:rgba(255,255,255,0.15);

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:24px;

            backdrop-filter:blur(8px);
        }

        .logo h2{

            font-size:30px;

            color:white;

            font-weight:700;
        }

        .logo-sub{

            margin-top:10px;

            color:rgba(255,255,255,0.75);

            font-size:15px;

            line-height:1.7;
        }

        /* ================= MENU ================= */

        .menu{

            margin-top:40px;
        }

        .menu-title{
            font-size:13px;
            color:rgba(255,255,255,0.5);
            margin-bottom:18px;
            padding-left:12px;
            letter-spacing:1px;
        }

        .menu a{

            display:flex;

            align-items:center;

            gap:14px;

            text-decoration:none;

            color:white;

            padding:15px 18px;

            border-radius:16px;

            margin-bottom:14px;

            transition:0.3s;

            font-size:15px;

            font-weight:500;
        }

        .menu a i{

            width:20px;
        }

        .menu a:hover{

            background:rgba(255,255,255,0.12);

            transform:translateX(4px);
        }

        .menu .active{

    background:white;

    color:#2563eb;

    font-weight:600;
}

        /* ================= LOGOUT ================= */

        .logout-btn a{

            display:flex;

            align-items:center;

            justify-content:center;

            gap:10px;

            text-decoration:none;

            background:white;

            color:#2563eb;

            padding:15px;

            border-radius:16px;

            font-weight:600;

            transition:0.3s;
        }

        .logout-btn a:hover{

            background:#f3f4f6;
        }

        /* ================= CONTENT ================= */

        .content{
            flex:1;
            padding:40px;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(96,165,250,0.15),
                    transparent 35%
                );
        }

        /* ================= TOPBAR ================= */

        .topbar{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:40px;
        }

        .topbar h1{

        font-size:32px;

        font-weight:700;

        color:#0f172a;

        margin-bottom:8px;
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
        font-weight:600;
        color:#2563eb;
        margin-bottom:6px;
    }

        .welcome-box span{
            color:#6b7280;
            font-size:12px;
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

            background:linear-gradient(
            90deg,
            #2563eb,
            #60a5fa
        );
        }

        .overview-card:hover{
            transform:translateY(-6px);
            box-shadow:0 15px 35px rgba(127,29,29,0.12);
        }

        .overview-icon{
            width:62px;
            height:62px;
            border-radius:18px;
            background:linear-gradient(
                135deg,
                #dbeafe,
                #bfdbfe
            );

            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:25px;
        }

        .overview-icon i{
            color:#2563eb;
            font-size:24px;
        }

        .overview-card h2{

    font-size:32px;

    font-weight:700;

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

        /* ================= ACTION CARDS ================= */

        .cards{

    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

@media(max-width:1200px){

    .cards{

        grid-template-columns:1fr;
    }
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

    height:5px;

    background:linear-gradient(
        90deg,
        #2563eb,
        #60a5fa
    );
}

        .card:hover{

            transform:translateY(-7px);

            box-shadow:0 18px 40px rgba(127,29,29,0.12);
        }

        .card-icon{

    width:60px;

    height:60px;

    border-radius:16px;

    background:linear-gradient(
        135deg,
        #dbeafe,
        #bfdbfe
    );

    display:flex;

    justify-content:center;

    align-items:center;

    margin-bottom:20px;
}

.card-icon i{
    color:#2563eb;
}

        .card h2{

    font-size:24px;

    font-weight:600;

    margin-bottom:16px;

    color:#111827;
}

        .card p{
            color:#6b7280;
            line-height:1.6;
            margin-bottom:20px;
            font-size:15px;
        }

        .card a{

            display:inline-flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
            background:linear-gradient(
            135deg,
            #2563eb,
            #1d4ed8
            );

            color:white;
            padding:10px 18px;
            border-radius:14px;
            font-size:15px;
            font-weight:600;
            transition:0.3s;
        }

        .card a:hover{

            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(127,29,29,0.2);
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:1000px){

            .sidebar{

                display:none;
            }

            .content{

                padding:25px;
            }

            .topbar{

                flex-direction:column;

                align-items:flex-start;

                gap:20px;
            }
        }

    </style>

</head>

<body>

<div class="main-container">

    <!-- ================= SIDEBAR ================= -->

    <div class="sidebar">

        <div>

            <!-- LOGO -->

            <div class="logo-section">

                <div class="logo">

                    <div class="logo-box">

                        <i class="fa-solid fa-heart-pulse"></i>

                    </div>

                    <h2>Healthsistant</h2>

                </div>

                <div class="logo-sub">

                    Hospital Disease Analysis & Prediction System

                </div>

            </div>

            <!-- MENU -->

            <div class="menu">

                <div class="menu-title">

                    NURSE PANEL

                </div>

                <a href="/dashboard/nurse" class="active">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>

                <a href="/patient/add">
                    <i class="fa-solid fa-user-plus"></i>
                    Add Patient
                </a>

                <a href="/patient/list">
                    <i class="fa-solid fa-hospital-user"></i>
                    View Patients
                </a>

                <a href="/doctor/availability">
                    <i class="fa-solid fa-user-doctor"></i>
                    Available Doctors
                </a>
            </div>

        </div>

        <!-- LOGOUT -->

        <div class="logout-btn">
            <a href="/logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>

    <!-- ================= CONTENT ================= -->

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>Nurse Dashboard</h1>

                <p>

                    Manage patient registration and monitor hospital records

                </p>

            </div>

            <div class="welcome-box">

                <h3>
                    Welcome, {{ session()->all()['name'] ?? 'NO NAME FOUND' }}
                </h3>

                <span>
                    Front Desk Nurse
                </span>

            </div>

        </div>

        <!-- OVERVIEW -->

        <div class="overview">

            <div class="overview-card">

                <div class="overview-icon">

                    <i class="fa-solid fa-user-plus"></i>

                </div>

                <h2>{{ $registeredToday }}</h2>

                <p>Registered Patients Today</p>

            </div>

            <div class="overview-card">

                <div class="overview-icon">

                    <i class="fa-solid fa-hospital-user"></i>

                </div>

                <h2>{{ $totalPatients }}</h2>

                <p>Total Patients</p>

            </div>

            <div class="overview-card">

                <div class="overview-icon">

                    <i class="fa-solid fa-notes-medical"></i>

                </div>

                <h2>{{ $todayRecords }}</h2>

                <p>Today's Records</p>

            </div>

        </div>

        <!-- QUICK ACTIONS -->

        <h2 class="section-title">
            Quick Actions
        </h2>

        <div class="cards">

    <!-- ADD PATIENT -->

    <div class="card">

        <div class="card-icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>

        <h2>Add Patient</h2>

        <p>
            Register new patients and update healthcare information.
        </p>

        <a href="/patient/add">
            Add Patient
        </a>

    </div>

    <!-- PATIENT LIST -->

    <div class="card">

        <div class="card-icon">
            <i class="fa-solid fa-hospital-user"></i>
        </div>

        <h2>Patient List</h2>

        <p>
            View and manage patient records efficiently within the system.
        </p>

        <a href="/patient/list">
            See Patient
        </a>
    </div>

    <!-- AVAILABLE DOCTORS -->

    <div class="card">

        <div class="card-icon">
            <i class="fa-solid fa-user-doctor"></i>
        </div>

        <h2>Available Doctors</h2>

        <p>
            View and manage doctor availability for patient assignment.
        </p>

        <a href="/doctor/availability">
            View Doctors
        </a>

    </div>      
</div>
</body>
</html>