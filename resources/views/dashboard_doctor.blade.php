<!DOCTYPE html>
<html>
<head>

    <title>Doctor Dashboard - Healthsistant</title>

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
            background:linear-gradient(135deg,#f8f5f5,#f2f2f2);
            min-height:100vh;
            color:#111827;
        }

        .main-container{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            padding:40px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
        }

        .topbar h1{
            font-size:42px;
        }

        .topbar p{
            color:#6b7280;
            font-size:16px;
        }

        .welcome-box{
            background:white;
            padding:20px 28px;
            border-radius:22px;
            box-shadow:0 8px 25px rgba(22,101,52,0.08);
            text-align:right;
        }

        .welcome-box h3{
            color:#166534;
        }

        /* Adjusted layout to elegantly hold 2 compact cards instead of 3 */
        .overview{
            display:grid;
            grid-template-columns: repeat(2, minmax(220px, 350px));
            gap:28px;
            margin-bottom:50px;
        }

        /* Slightly shrunk down card internal padding to make it smaller */
        .overview-card{
            background:white;
            padding:28px 34px;
            border-radius:28px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            border-top:5px solid #22c55e;
        }

        .overview-icon{
            width:60px;
            height:60px;
            border-radius:20px;
            background:#dcfce7;            
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:20px;
        }

        .overview-icon i{
            color:#166534;
            font-size:26px;
        }

        .overview-card h2{
            font-size:48px;
            margin-bottom:6px;
        }

        .overview-card p{
            color:#6b7280;
            font-size:15px;
        }

        .section-title{
            font-size:28px;
            margin-bottom:28px;
            margin-top:20px;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:30px;
            margin-bottom:50px;
        }

        .card{
            background:white;
            border-radius:30px;
            padding:38px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            position:relative;
        }

        .card::before{
            content:"";
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:6px;
            background:linear-gradient(90deg,#166534,#22c55e);
        }

        .card-icon{
            width:70px;
            height:70px;
            border-radius:22px;
            background:#dcfce7;
            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:28px;
        }

        .card-icon i{
            color:#166534;
            font-size:30px;
        }

        .card h2{
            margin-bottom:16px;
        }

        .card p{
            color:#6b7280;
            margin-bottom:30px;
        }

        .card a{
            display:inline-flex;
            text-decoration:none;
            background:#16a34a;
            color:white;
            padding:14px 26px;
            border-radius:14px;
            font-weight:600;
        }

        .queue-table-card{
            background:white;
            border-radius:28px;
            padding:30px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            overflow-x:auto;
        }

        .queue-table{
            width:100%;
            border-collapse:collapse;
        }

        .queue-table th{
            background:#166534;
            color:white;
            padding:16px;
            text-align:left;
        }

        .queue-table td{
            padding:16px;
            border-bottom:1px solid #f1f5f9;
        }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.doctor_sidebar')

    <div class="content">

        <div class="topbar">
            <div>
                <h1>Doctor Dashboard</h1>
                <p>
                    Manage patient assessments and clinical system tools.
                </p>
            </div>

            <div class="welcome-box">
                <h3>Welcome, {{ session('name') }}</h3>
                <span>Doctor</span>
            </div>
        </div>

        <div class="overview">
            <!-- Card 1: Active Patients Queue -->
            <div class="overview-card">
                <div class="overview-icon">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <h2>{{ count($patients) }}</h2>
                <p>Patients In Queue</p>
            </div>

            <!-- Card 2: Completed Today -->
            <div class="overview-card">
                <div class="overview-icon">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <h2>{{ $completedCount ?? 12 }}</h2>
                <p>Treated Today</p>
            </div>
        </div>

        <h2 class="section-title">Today's Available Specialists</h2>

        <div class="queue-table-card">
            <table class="queue-table">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($availableDoctors ?? [] as $doctor)
                    <tr>
                        <td>{{ $doctor->userID }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>
                            @if($doctor->role == 'doctor_cardiology')
                                Cardiology
                            @elseif($doctor->role == 'doctor_haematology')
                                Haematology
                            @else
                                {{ $doctor->role }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 

        <h2 class="section-title" style="margin-top: 50px;">Quick Actions</h2>

        <div class="cards">
            <!-- Module 1: Patient Queue -->
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h2>Patient Queue</h2>
                <p>Review queued patients and perform medical assessment updates.</p>
                <a href="/patient/queue">Open Module</a>
            </div>

            <!-- Module 2: Patient Records -->
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <h2>Patient Records</h2>
                <p>Browse past medical histories, diagnostic results, and health reports.</p>
                <a href="/doctor/patient-records">Open Records</a>
            </div>

            <!-- Module 3: My Profile Settings -->
            <div class="card">
                <div class="card-icon">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <h2>My Profile</h2>
                <p>Manage account settings, working shift status, and duty profiles.</p>
                <a href="/doctor/profile">Open Profile</a>
            </div>
        </div>

    </div>
</div>

</body>
</html>