<!DOCTYPE html>
<html>
<head>

    <title>Add Disease - Healthsistant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    min-height:100vh;
    color:#111827;
}


/* ===== SAME LAYOUT WITH ADMIN DASHBOARD ===== */

.main-container{

    display:flex;
    min-height:100vh;
}


.content{

    flex:1;
    padding:40px;

    background:
        radial-gradient(circle at top right,
        rgba(127,29,29,0.08),
        transparent 30%);
}


.container{

    width:100%;
}

        .card{
            background:white;
            border-radius:20px;
            padding:25px;
            margin-top:20px;
        }

        h1{
            color:#111827;
            font-size:40px;
            margin-bottom:10px;
        }

        .subtitle{
            color:#6b7280;
            font-size:20px;
            margin-bottom:35px;
        }

        .form-group{
            margin-bottom:25px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            color:#991b1b;
            font-weight:600;
        }

        .form-group input,
        .form-group textarea{

            width:100%;
            padding:15px;
            border:1px solid #d1d5db;
            border-radius:14px;
            font-family:'Poppins',sans-serif;
            font-size:15px;
            outline:none;
        }

        .form-group input:focus,
        .form-group textarea:focus{

            border-color:#991b1b;
        }

        .form-group textarea{
            resize:none;
        }

        .btn{
            background:linear-gradient(
                135deg,
                #7f1d1d,
                #991b1b
            );

            color:white;
            border:none;
            padding:15px 30px;
            border-radius:14px;
            cursor:pointer;
            font-size:15px;
            font-weight:600;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-2px);
        }

        .back{
            margin-top:20px;
        }

        .back a{
            color:#991b1b;
            text-decoration:none;
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="main-container">
@include('layouts.admin_sidebar')
<div class="content">

<div class="container">

    <h1>
        Add Disease
    </h1>

    <div class="subtitle">
        Register disease information into the Healthsistant system.
    </div>

    <div class="card">

        @if(session('success'))

            <div style="
                background:#dcfce7;
                color:#166534;
                padding:15px;
                border-radius:12px;
                margin-bottom:25px;
            ">
                {{ session('success') }}
            </div>

        @endif

        <form method="POST" action="/disease/add">

            @csrf
            <div class="form-group">
                <label>Disease Name</label>

                <input
                type="text"
                name="disease_name"
                required>

            </div>

            <div class="form-group">

                <label>ICD Code</label>

                <input
                type="text"
                name="icd_code"
                required>

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea
                name="description"
                rows="5"></textarea>

            </div>

            <button type="submit" class="btn">

                Save Disease

            </button>

        </form>

        <div class="back">

            <a href="/dashboard/admin">

                ← Back to Dashboard

            </a>

        </div>

    </div>
</div>
</div>

</body>
</html>