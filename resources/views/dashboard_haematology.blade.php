<!DOCTYPE html>
<html>

<head>
    <title>Haematology Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#fdf2f8;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            margin-bottom:35px;
        }

        .welcome-box{
            background:white;
            padding:22px 30px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
            text-align:right;
        }

        .welcome-box h3{
            color:#9d174d;
            margin-bottom:5px;
            font-size:18px;
            font-weight:600;
        }

        .welcome-box span{
            color:#64748b;
            font-size:14px;
        }

        .main-container{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            padding:40px;
        }

        .page-title{
            font-size:40px;
            font-weight:700;
            color:#0f172a;
            margin-bottom:10px;
        }

        .page-subtitle{
            font-size:20px;
            color:#64748b;
            margin-bottom:35px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:25px;
            margin-bottom:35px;
        }

        .stat-card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
            border-top:5px solid #db2777;
        }

        .stat-number{
            font-size:42px;
            font-weight:700;
            color:#9d174d;
        }

        .stat-label{
            margin-top:8px;
            color:#64748b;
            font-size:16px;
        }

        .dashboard-grid{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:25px;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
        }

        .card-title{
            font-size:28px;
            font-weight:600;
            color:#0f172a;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#db2777;
            color:white;
            padding:14px;
            text-align:left;
        }

        td{
            padding:14px;
            border-bottom:1px solid #e5e7eb;
        }

        tr:hover{
            background:#fdf2f8;
        }

        .status{
            background:#dcfce7;
            color:#15803d;
            padding:6px 12px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

        .summary-item{
            margin-bottom:20px;
            padding-bottom:15px;
            border-bottom:1px solid #e5e7eb;
        }

        .summary-label{
            color:#64748b;
            font-size:14px;
        }

        .summary-value{
            font-size:24px;
            font-weight:700;
            color:#9d174d;
            margin-top:5px;
        }

        .department-status{
            background:#dcfce7;
            color:#15803d;
            text-align:center;
            padding:15px;
            border-radius:12px;
            font-weight:600;
            margin-top:20px;
        }

    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.haematology_sidebar')

    <div class="content">

        <div class="topbar">

            <div>

                <h1 class="page-title">
                    Haematology Dashboard
                </h1>

                <p class="page-subtitle">
                    Manage haematology referrals, assessments and patient monitoring
                </p>

            </div>

            <div class="welcome-box">

                <h3>
                    Welcome, {{ session('name') }}
                </h3>

                <span>
                    Haematology Specialist
                </span>

            </div>

        </div>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-number">{{ $referrals }}</div>
                <div class="stat-label">Pending Referrals</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">{{ $completed }}</div>
                <div class="stat-label">Completed Assessments</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">{{ $admitted }}</div>
                <div class="stat-label">Admitted Patients</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">{{ $discharged }}</div>
                <div class="stat-label">Discharged Patients</div>
            </div>

        </div>

        <div class="dashboard-grid">

            <div class="card">

                <div class="card-title">
                    Recent Haematology Cases
                </div>

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Symptoms</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($recentPatients as $patient)

                        <tr>
                            <td>{{ $patient->PatientID }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->symptoms }}</td>
                            <td>
                                <span class="status">
                                    {{ $patient->status }}
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" style="text-align:center;">
                                No records found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card">

                <div class="card-title">
                    Department Summary
                </div>

                <div class="summary-item">
                    <div class="summary-label">
                        Total Referrals
                    </div>
                    <div class="summary-value">
                        {{ $referrals }}
                    </div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">
                        Cases Reviewed
                    </div>
                    <div class="summary-value">
                        {{ $completed }}
                    </div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">
                        Active Admissions
                    </div>
                    <div class="summary-value">
                        {{ $admitted }}
                    </div>
                </div>

                <div class="department-status">
                    Department Operational
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>