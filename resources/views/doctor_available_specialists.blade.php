<!DOCTYPE html>
<html>
<head>
    <title>Available Specialists</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #eef5ff, #f8fbff);
            color: #111827;
        }

        /* ================= LAYOUT CONTAINER (MATCHING PATIENT_ADD) ================= */
        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* ================= CONTENT STYLING ================= */
        .content {
            flex: 1;
            padding: 40px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 38px;
            color: #111827;
            font-weight: 700;
        }

        .page-header p {
            color: #6b7280;
            font-size: 16px;
            margin-top: 4px;
        }

        /* APP CARDS */
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            border: 1px solid #eef2f6;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* TABLES */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .modern-table th {
            background: #f8fafc;
            padding: 16px 20px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modern-table td {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        .modern-table tr:last-child td {
            border-bottom: none;
        }

        .modern-table tr:hover td {
            background: #f8fafc;
        }

        /* DEPT BADGES */
        .dept-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .dept-cardio {
            background: #eff6ff;
            color: #1e40af;
        }

        .dept-haem {
            background: #faf5ff;
            color: #6b21a8;
        }

        .dept-general {
            background: #f1f5f9;
            color: #475569;
        }

        /* WORKLOAD BADGES */
        .workload-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-inline-block;
        }

        .status-badge{
            background:#dcfce7;
            color:#166534;
            padding:6px 14px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

        .status-badge i{
            margin-right:5px;
        }
    </style>
</head>
<body>

<div class="main-container">
    @include('layouts.nurse_sidebar')

    <div class="content">
        <div class="page-header">
            <h1>Available Specialists</h1>
            <p>Real-time active duty staff members and scheduling metrics</p>
        </div>

        <div class="card">
            <h2 class="section-title"><i class="fa-solid fa-user-doctor"></i> Active Duty Roster</h2>
            
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Staff ID</th>
                            <th style="width: 45%;">Name</th>
                            <th style="width: 20%;">Department</th>
                            <th style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($doctors) && count($doctors) > 0)
                            @foreach($doctors as $doctor)
                            @php
                                $deptClass = 'dept-general';
                                $deptLabel = 'General Medicine';

                                if(isset($doctor->role)) {
                                    if(str_contains(strtolower($doctor->role), 'cardio')) {
                                        $deptClass = 'dept-cardio';
                                        $deptLabel = 'Cardiology';
                                    } elseif(str_contains(strtolower($doctor->role), 'haem')) {
                                        $deptClass = 'dept-haem';
                                        $deptLabel = 'Haematology';
                                    }
                                }
                            @endphp
                            <tr>
                                <td style="font-weight: 600; color: #64748b;">#{{ $doctor->userID }}</td>
                                <td style="font-weight: 600; color: #1e293b;">{{ $doctor->name }}</td>
                                <td>
                                    <span class="dept-badge {{ $deptClass }}">{{ $deptLabel }}</span>
                                </td>
                                <td>
                                    <span class="status-badge">
                                        <i class="fa-solid fa-circle"></i>
                                        Available
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 20px; color: #6b7280;">No active specialists available on duty.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</body>
</html>