<!DOCTYPE html>
<html>
<head>
    <title>My Profile - Healthsistant</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
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

        .profile-wrapper{
            max-width:1000px;
            margin: 0; /* Changed from 0 auto to align close to the sidebar */
        }

        /* Top Title banner */
        .profile-title{
            margin-bottom:35px;
        }
        
        .profile-title h1{
            font-size:42px;
            margin-bottom:4px;
        }

        .profile-title p{
            color:#6b7280;
            font-size:16px;
        }

        /* Card container holding information details beautifully */
        .profile-card{
            background:white;
            border-radius:30px;
            box-shadow:0 10px 30px rgba(0,0,0,0.04);
            overflow:hidden;
            position:relative;
            border-top:6px solid #22c55e;
            padding:45px;
        }

        /* Top Identity Badge Section layout style */
        .doctor-identity-section {
            display: flex;
            align-items: center;
            gap: 30px;
            padding-bottom: 35px;
            border-bottom: 2px dashed #e2e8f0;
            margin-bottom: 35px;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #dcfce7;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(22,101,52,0.1);
        }

        .avatar-circle i {
            font-size: 44px;
            color: #166534;
        }

        .identity-text h2 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 4px;
        }

        .role-pill {
            display: inline-block;
            background: #166534;
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Information Grid Section */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .info-box-item {
            background: #f8fafc;
            padding: 22px 26px;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .info-box-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.02);
            background: #ffffff;
            border-color: #cbd5e1;
        }

        .info-label {
            font-size: 13px;
            font-weight: 600;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-label i {
            font-size: 14px;
        }

        .info-value {
            font-size: 17px;
            font-weight: 500;
            color: #334155;
        }

        @media(max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .doctor-identity-section {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.doctor_sidebar')

    <div class="content">
        <div class="profile-wrapper">
            
            <div class="profile-title">
                <h1>My Profile</h1>
                <p>Doctor professional details and account configuration parameters</p>
            </div>

            <div class="profile-card">
                
                <!-- Beautiful Professional Identity section -->
                <div class="doctor-identity-section">
                    <div class="avatar-circle">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div class="identity-text">
                        <h2>{{ session('name') ?? $doctor->name }}</h2>
                        <span class="role-pill">Medical Staff</span>
                    </div>
                </div>

                <!-- Structured Clean Grid fields for Account data -->
                <div class="info-grid">
                    
                    <div class="info-box-item">
                        <div class="info-label">
                            <i class="fa-solid fa-id-card"></i> Staff ID Identifier
                        </div>
                        <div class="info-value">{{ $doctor->userID }}</div>
                    </div>

                    <div class="info-box-item">
                        <div class="info-label">
                            <i class="fa-solid fa-briefcase"></i> Assigned System Role
                        </div>
                        <div class="info-value" style="text-transform: capitalize;">{{ $doctor->role }}</div>
                    </div>

                    <div class="info-box-item">
                        <div class="info-label">
                            <i class="fa-solid fa-envelope"></i> Email Address
                        </div>
                        <div class="info-value">{{ $doctor->email ?? 'Not Configured' }}</div>
                    </div>

                    <div class="info-box-item">
                        <div class="info-label">
                            <i class="fa-solid fa-building-shield"></i> Department Branch
                        </div>
                        <div class="info-value">Healthsistant Clinical Center</div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>