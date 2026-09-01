<!DOCTYPE html>
<html>
<head>
    <title>Nurse Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #faf5ff;
            min-height: 100vh;
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
            color: #86198f;
            margin-bottom: 30px;
        }

        /* Upgraded main profile container wrapper */
        .profile-card {
            background: white;
            border-radius: 24px;
            padding: 45px;
            box-shadow: 0 10px 30px rgba(134, 25, 143, 0.04);
            border: 1px solid rgba(243, 232, 255, 0.7);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 45px;
            padding-bottom: 35px;
            border-bottom: 2px dashed #f3e8ff;
        }

        /* Added smooth gradient ring to the avatar placeholder */
        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c026d3, #86198f);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 44px;
            font-weight: 700;
            color: white;
            box-shadow: 0 8px 20px rgba(192, 38, 211, 0.2);
        }

        .name {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .role {
            color: #c026d3;
            font-weight: 600;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #fdf4ff;
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* Styled info boxes with clean left border stripes */
        .info-box {
            background: #fdfafe;
            padding: 22px 26px;
            border-radius: 16px;
            border: 1px solid #f3e8ff;
            border-left: 5px solid #c026d3;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(134, 25, 143, 0.03);
        }

        .label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .value {
            font-size: 17px;
            font-weight: 600;
            color: #1e293b;
            word-break: break-all;
        }
        
        .capitalize-text {
            text-transform: capitalize;
        }
    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.nurse_haematology_sidebar')

    <div class="content">

        <h1 class="page-title">My Profile</h1>

        <div class="profile-card">

            <div class="profile-header">
                <div class="avatar">
                    {{ strtoupper(substr($nurse->name ?? 'N', 0, 1)) }}
                </div>

                <div>
                    <div class="name">
                        {{ $nurse->name ?? 'Haematology Nurse' }}
                    </div>
                    <div class="role">
                        Haematology Department
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-box">
                    <div class="label">Full Name</div>
                    <div class="value">
                        {{ $nurse->name ?? '-' }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="label">Email Address</div>
                    <div class="value">
                        {{ $nurse->email ?? '-' }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="label">Department</div>
                    <div class="value capitalize-text">
                        {{ $nurse->department ?? 'haematology' }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="label">Position Title</div>
                    <div class="value">
                        {{ $nurse->position ?? 'Registered Nurse' }}
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>
</html>