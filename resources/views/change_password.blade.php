<!DOCTYPE html>
<html>
<head>

    <title>Change Password - Healthsistant</title>

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

            background:#f5f6fa;

            min-height:100vh;

            display:flex;

            overflow:hidden;
        }

        /* ================= LEFT SIDE ================= */

        .left-section{

            width:55%;

            background:linear-gradient(135deg,#991b1b,#7f1d1d);

            color:white;

            display:flex;

            flex-direction:column;

            justify-content:center;

            padding:80px;

            position:relative;
        }

        .overlay{

            position:absolute;

            inset:0;

            background:
                linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);

            background-size:40px 40px;
        }

        .content{

            position:relative;

            z-index:2;
        }

        .logo{

            display:flex;

            align-items:center;

            gap:15px;

            margin-bottom:30px;
        }

        .logo-box{

            width:55px;

            height:55px;

            border-radius:16px;

            background:white;

            display:flex;

            justify-content:center;

            align-items:center;

            color:#991b1b;

            font-size:24px;
        }

        .logo h1{

            font-size:34px;

            font-weight:700;
        }

        .content h2{

            font-size:52px;

            line-height:1.2;

            margin-bottom:25px;

            max-width:600px;
        }

        .content p{

            font-size:17px;

            line-height:1.8;

            color:#f3f4f6;

            max-width:600px;
        }

        /* ================= RIGHT SIDE ================= */

        .right-section{

            width:45%;

            display:flex;

            justify-content:center;

            align-items:center;

            padding:40px;
        }

        .password-card{

            width:100%;

            max-width:450px;

            background:white;

            border-radius:28px;

            padding:45px;

            box-shadow:0 10px 40px rgba(0,0,0,0.08);
        }

        .password-card h2{

            font-size:34px;

            color:#111827;

            margin-bottom:12px;
        }

        .subtitle{

            color:#6b7280;

            margin-bottom:30px;

            line-height:1.7;
        }

        /* ================= RULES ================= */

        .rules-box{

            background:#fef2f2;

            border:1px solid #fecaca;

            color:#7f1d1d;

            padding:18px;

            border-radius:16px;

            margin-bottom:28px;

            line-height:1.9;

            font-size:14px;
        }

        .rules-box strong{

            display:block;

            margin-bottom:8px;

            font-size:15px;
        }

        /* ================= ERROR ================= */

        .error-box{

            background:#fee2e2;

            color:#991b1b;

            padding:14px;

            border-radius:12px;

            margin-bottom:20px;

            font-size:14px;
        }

        /* ================= INPUT ================= */

        .input-group{

            margin-bottom:24px;
        }

        .input-group label{

            display:block;

            margin-bottom:10px;

            font-weight:600;

            color:#374151;
        }

        .input-box{

            position:relative;
        }

        .input-box i{

            position:absolute;

            top:18px;

            left:18px;

            color:#9ca3af;
        }

        input{

            width:100%;

            padding:16px 18px 16px 50px;

            border:1px solid #d1d5db;

            border-radius:14px;

            font-size:15px;

            background:#f9fafb;

            transition:0.3s;

            font-family:'Poppins',sans-serif;
        }

        input:focus{

            outline:none;

            border-color:#991b1b;

            background:white;

            box-shadow:0 0 0 4px rgba(153,27,27,0.1);
        }

        /* ================= BUTTON ================= */

        .btn{

            width:100%;

            padding:16px;

            border:none;

            border-radius:14px;

            background:#991b1b;

            color:white;

            font-size:15px;

            font-weight:600;

            cursor:pointer;

            transition:0.3s;

            font-family:'Poppins',sans-serif;
        }

        .btn:hover{

            background:#7f1d1d;

            transform:translateY(-2px);
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:1000px){

            .left-section{

                display:none;
            }

            .right-section{

                width:100%;
            }

            body{

                background:#f5f6fa;
            }
        }

    </style>

</head>

<body>

<!-- ================= LEFT SECTION ================= -->

<div class="left-section">

    <div class="overlay"></div>

    <div class="content">

        <div class="logo">

            <div class="logo-box">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <h1>Healthsistant</h1>

        </div>

        <h2>

            Secure Your Account Access

        </h2>

        <p>

            For security purposes, first-time users are required
            to create a strong personal password before accessing
            the Healthsistant system.

        </p>

    </div>

</div>

<!-- ================= RIGHT SECTION ================= -->

<div class="right-section">

    <div class="password-card">

        <h2>Change Password</h2>

        <p class="subtitle">

            Create a strong password to continue using the system securely.

        </p>

        <!-- ERROR -->

        @if($errors->any())

            <div class="error-box">

                {{ $errors->first() }}

            </div>

        @endif

        <!-- RULES -->

        <div class="rules-box">

            <strong>Password Requirements</strong>

            • Minimum 8 characters<br>

            • At least 1 uppercase letter<br>

            • At least 1 lowercase letter<br>

            • At least 1 number<br>

            • At least 1 special character

        </div>

        <!-- FORM -->

        <form method="POST" action="/change-password">

            @csrf

            <div class="input-group">

                <label>New Password</label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your new password"
                        required
                    >

                </div>

            </div>

            <button type="submit" class="btn">

                Update Password

            </button>

        </form>

    </div>

</div>

</body>
</html>