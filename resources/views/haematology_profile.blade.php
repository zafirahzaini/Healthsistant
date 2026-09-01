<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>

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

.main-container{
    display:flex;
    min-height:100vh;
}

.content{
    flex:1;
    padding:40px;
}

.card{
    background:white;
    border-radius:20px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.profile-top{
    display:flex;
    align-items:center;
    gap:25px;
    margin-bottom:30px;
}

.avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#ec4899;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:36px;
    font-weight:700;
}

.profile-name{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
}

.profile-role{
    color:#be185d;
    font-weight:600;
    margin-top:5px;
}

.summary-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.summary-card{
    background:#fffbeb;
    border:1px solid #fde68a;
    border-radius:15px;
    padding:20px;
}

.summary-card strong{
    color:#be185d;
}

.status-box{
    margin-top:25px;
    background:#dcfce7;
    color:#15803d;
    border-radius:12px;
    padding:20px;
    font-weight:600;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:35px;
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

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.haematology_sidebar')

    <div class="content">

    <div class="topbar">

        <div>

            <h1 class="page-title">
                My Profile
            </h1>

            <p class="page-subtitle">
                View specialist account information
            </p>

        </div>

    </div>

        <div class="card">

            <div class="profile-top">

    <div class="avatar">
        {{ strtoupper(substr($doctor->name,0,1)) }}
    </div>

    <div>
        <div class="profile-name">
            {{ $doctor->name }}
        </div>

        <div class="profile-role">
            Haematology Specialist
        </div>
    </div>

</div>

            <div class="summary-grid">

                <div class="summary-card">
                    <span class="label">Staff ID</span>
                    <span class="value">
                        {{ $doctor->userID }}
                    </span>
                </div>

                <div class="summary-card">
                    <span class="label">Department</span>
                    <span class="value">
                        Haematology
                    </span>
                </div>

                <div class="summary-card">
                    <span class="label">Full Name</span>
                    <span class="value">
                        {{ $doctor->name }}
                    </span>
                </div>

                <div class="summary-card">
                    <span class="label">Role</span>
                    <span class="value">
                        {{ $doctor->role }}
                    </span>
                </div>

            </div>

            <div class="status-box">

                <div class="status-title">
                    Current Status
                </div>

                <div class="status-value">
                    Active Specialist
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>