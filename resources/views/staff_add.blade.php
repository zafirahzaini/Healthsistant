<!DOCTYPE html>
<html>
<head>

    <title>Add Staff - Healthsistant</title>

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
                #fff8f8,
                #fef2f2
            );
        }

        /* ================= CONTAINER ================= */

        .container{
    width:100%;
}

        .main-container{
    display:flex;
    min-height:100vh;
}

.content{
    flex:1;
    padding:40px;

    background:
        radial-gradient(
            circle at top right,
            rgba(127,29,29,0.08),
            transparent 30%
        );
}

        /* ================= HEADER ================= */

        .header{
            display:flex;
            align-items:center;
            gap:18px;
            margin-bottom:35px;
        }

        .header-icon{
            width:68px;
            height:68px;
            border-radius:20px;
            background:linear-gradient(
                135deg,
                #7f1d1d,
                #991b1b
            );

            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:28px;
        }

        .header-text h1{

            font-size:36px;
            color:#111827;
            margin-bottom:5px;
        }

        .header-text p{
            color:#6b7280;
            font-size:15px;
        }

        /* ================= ALERT ================= */

        .success-message{
            background:#dcfce7;
            border:1px solid #86efac;
            color:#166534;
            padding:16px;
            border-radius:16px;
            margin-bottom:22px;
            line-height:1.7;
            font-size:14px;
        }

        .error-message{
            background:#fee2e2;
            border:1px solid #fca5a5;
            color:#991b1b;
            padding:16px;
            border-radius:16px;
            margin-bottom:22px;
            line-height:1.7;
            font-size:14px;
        }

        /* ================= FORM ================= */

        .form-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:22px;
        }

        .full-width{
            grid-column:1 / 3;
        }

        .input-group{

            display:flex;

            flex-direction:column;
        }

        label{

            margin-bottom:10px;

            font-size:14px;

            font-weight:600;

            color:#374151;
        }

        .input-box{
            position:relative;
        }

        .input-box i{

            position:absolute;
            left:18px;
            top:50%;
            transform:translateY(-50%);
            color:#9ca3af;
            font-size:15px;
        }

        input,
        select{

            width:100%;
            height:58px;
            padding:0 18px 0 52px;
            border-radius:16px;
            border:1px solid #d1d5db;
            background:#f9fafb;
            font-size:15px;
            color:#111827;
            outline:none;
            transition:0.3s;
            font-family:'Poppins',sans-serif;
        }

        input::placeholder{

            color:#9ca3af;
        }

        input:focus,
        select:focus{

            border-color:#991b1b;

            background:white;

            box-shadow:
                0 0 0 4px rgba(153,27,27,0.08);
        }

        select{

            cursor:pointer;
        }

        /* ================= PASSWORD BOX ================= */

        .password-info{

            margin-top:20px;

            background:#fef2f2;

            border:1px solid #fecaca;

            color:#7f1d1d;

            padding:16px;

            border-radius:16px;

            font-size:14px;

            line-height:1.7;
        }

        /* ================= BUTTON ================= */

        .btn{

            width:100%;
            height:60px;
            margin-top:30px;
            border:none;
            border-radius:18px;
            background:linear-gradient(
                135deg,
                #7f1d1d,
                #991b1b
            );

            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
            font-family:'Poppins',sans-serif;
            box-shadow:
                0 10px 25px rgba(127,29,29,0.15);
        }

        .btn:hover{

            transform:translateY(-3px);

            box-shadow:
                0 15px 30px rgba(127,29,29,0.25);
        }

        /* ================= BACK BUTTON ================= */

        .back-link{

            margin-top:25px;

            text-align:center;
        }

        .back-link a{

            text-decoration:none;

            color:#7f1d1d;

            font-weight:600;

            transition:0.3s;
        }

        .back-link a:hover{

            color:#991b1b;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px){

            .container{

                padding:35px 25px;
            }

            .form-grid{

                grid-template-columns:1fr;
            }

            .full-width{

                grid-column:auto;
            }

            .header{

                flex-direction:column;

                align-items:flex-start;
            }

            .header-text h1{

                font-size:30px;
            }
        }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.admin_sidebar')

    <div class="content">

        <div class="container">

    <!-- PAGE TITLE -->

    <div style="margin-bottom:30px;">

    <h1 style="
        font-size:40px;
        color:#111827;
        margin-bottom:10px;
    ">
        Add Staff
    </h1>

    <p style="
        color:#6b7280;
        font-size:20px;
    ">
        Register new hospital staff and generate secure account access
    </p>

</div>

        </div>

        <!-- ================= SUCCESS ================= -->

        @if(session('success'))

                <div class="success-message">

                    <h3 style="margin-bottom:10px;">
                        ✅ Staff Added Successfully
                    </h3>

                    <p style="margin-bottom:20px;">
                        {{ session('success') }}
                    </p>

                    <div style="
                        display:flex;
                        gap:15px;
                        margin-top:15px;
                    ">

                        <a href="/staff/add"
                        style="
                            text-decoration:none;
                            background:#2563eb;
                            color:white;
                            padding:12px 20px;
                            border-radius:10px;
                            font-weight:600;
                        ">
                            Add Another Staff
                        </a>

                        <a href="/dashboard/admin"
                        style="
                            text-decoration:none;
                            background:#64748b;
                            color:white;
                            padding:12px 20px;
                            border-radius:10px;
                            font-weight:600;
                        ">
                            Back To Dashboard
                        </a>
                    </div>
                </div>

                @endif

        <!-- ================= ERROR ================= -->

        @if(session('error'))

            <div class="error-message">

                {{ session('error') }}

            </div>

        @endif

        <!-- ================= FORM ================= -->
        @if(!session('success'))

        <div style="
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
">
        <form action="/staff/store" method="POST">
            @csrf

            <div class="form-grid">
                <!-- NAME -->
                <div class="input-group full-width">
                    <label>Full Name</label>
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input
                            type="text"
                            name="name"
                            placeholder="Enter staff full name"
                            required
                        >
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="input-group">
                    <label>Email Address</label>
                    <div class="input-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input
                            type="email"
                            name="email"
                            placeholder="Enter email address"
                            required
                        >
                    </div>
                </div>

                <!-- AGE -->
                <div class="input-group">
                    <label>Age</label>
                    <div class="input-box">
                        <i class="fa-solid fa-calendar"></i>
                        <input
                            type="number"
                            name="age"
                            placeholder="Enter age"
                            required
                        >
                    </div>
                </div>

                <!-- ROLE -->
                <div class="input-group full-width">
                    <label>Staff Role</label>
                    <div class="input-box">
                        <i class="fa-solid fa-user-doctor"></i>
                        <select name="role" required>

                        <option value="">
                            Select Staff Role
                        </option>

                        <!-- DOCTORS -->

                        <option value="doctor">
                            Doctor (General)
                        </option>

                        <option value="doctor_haematology">
                            Doctor - Haematology
                        </option>

                        <option value="doctor_cardiology">
                            Doctor - Cardiology
                        </option>

                        <!-- NURSES -->

                        <option value="nurse_frontdesk">
                            Nurse - Front Desk
                        </option>

                        <option value="nurse_haematology">
                            Nurse - Haematology
                        </option>

                        <option value="nurse_cardiology">
                            Nurse - Cardiology
                        </option>
                    </select>
                    </div>
                </div>
            </div>

            <!-- PASSWORD INFO -->
            <div class="password-info">
                <strong>Automatic Password Generation:</strong><br>
                The system will automatically generate a secure temporary password
                and send it to the staff email address.
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn">
                <i class="fa-solid fa-user-plus"></i>
                &nbsp;
                Create Staff Account
            </button>
        </form>

        <!-- BACK -->
        <div class="back-link">
            <a href="/dashboard/admin">
                ← Back to Dashboard
            </a>
        </div>
        @endif

    </div>

</div>

</div>

</body>
</html>