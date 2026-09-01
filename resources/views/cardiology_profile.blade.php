<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fdf8f2;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .page-title {
            font-size: 40px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .page-subtitle {
            font-size: 20px;
            color: #64748b;
            margin-bottom: 35px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 30px;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #ca8a04;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 36px;
            font-weight: 700;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        .profile-role {
            font-size: 16px;
            color: #ca8a04;
            font-weight: 500;
            margin-top: 2px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: #fafafa;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .value {
            font-size: 18px;
            color: #1e293b;
            font-weight: 600;
        }

        .status-box {
            background: #fefce8;
            border: 1px solid #fef08a;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-title {
            font-weight: 600;
            color: #854d0e;
            font-size: 16px;
        }

        .status-value {
            background: #ca8a04;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="main-container">
    @include('layouts.cardiology_sidebar')
    <div class="content">
        <h1 class="page-title">My Profile</h1>
        <p class="page-subtitle">View specialist account information</p>

        <div class="card">
            <div class="profile-top">
                <div class="avatar">
                    {{ strtoupper(substr($doctor->name, 0, 1)) }}
                </div>
                <div>
                    <div class="profile-name">{{ $doctor->name }}</div>
                    <div class="profile-role">Cardiology Specialist</div>
                </div>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <span class="label">Staff ID</span>
                    <span class="value">{{ $doctor->userID }}</span>
                </div>
                <div class="summary-card">
                    <span class="label">Department</span>
                    <span class="value">Cardiology</span>
                </div>
                <div class="summary-card">
                    <span class="label">Full Name</span>
                    <span class="value">{{ $doctor->name }}</span>
                </div>
                <div class="summary-card">
                    <span class="label">Role</span>
                    <span class="value">{{ $doctor->role }}</span>
                </div>
            </div>

            <div class="status-box">
                <div class="status-title">Current Status</div>
                <div class="status-value">Active Specialist</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>