<!DOCTYPE html>
<html>
<head>

<title>Patient Details</title>

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
    background:linear-gradient(135deg,#f8f5f5,#f2f2f2);
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

.page-header{
    margin-bottom:30px;
}

.page-header h1{
    font-size:38px;
    color:#111827;
}

.page-header p{
    color:#6b7280;
    margin-top:8px;
}

.table-card{

    background:white;
    border-radius:30px;
    padding:38px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    border:1px solid rgba(127,29,29,0.08);
    position:relative;
    overflow:hidden;
}

.table-card::before{

    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(
        90deg,
        #7f1d1d,
        #dc2626
    );
}

.timeline{
    list-style:none;
    padding:0;
    margin-top:20px;
}

.timeline li{
    background:#f9fafb;
    border-left:5px solid #7f1d1d;
    border-radius:12px;
    padding:18px;
    margin-bottom:15px;
}

.timeline strong{
    color:#111827;
}

.back-btn{
    display:inline-block;
    margin-top:20px;
    background:#7f1d1d;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
    font-weight:600;
}

.back-btn:hover{
    opacity:.9;
}

.section-title{

    font-size:32px;
    margin-bottom:25px;
    color:#111827;
}

</style>

</head>

<body>

<div class="main-container">

    @include('layouts.admin_sidebar')

    <div class="content">

        <div class="page-header">

            <h1>Patient Details</h1>

            <p>
                Full patient journey and timestamps
            </p>

        </div>

        <div class="table-card">

            <h2 class="section-title">
                {{ $patient->name }}
            </h2>

            <ul class="timeline">

                <li>
                    <strong>Registered</strong><br>
                    {{ $patient->created_at ?? '-' }}
                </li>

                <li>
                    <strong>Doctor Seen</strong><br>
                    {{ $patient->doctor_seen_at ?? '-' }}
                </li>

                <li>
                    <strong>Admitted</strong><br>
                    {{ $patient->admitted_at ?? '-' }}
                </li>

                <li>
                    <strong>Discharged</strong><br>
                    {{ $patient->discharged_at ?? '-' }}
                </li>

                <li>
                    <strong>Ward Discharged</strong><br>
                    {{ $patient->ward_discharged_at ?? '-' }}
                </li>

            </ul>

            <a href="/admin/patients" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Patient Management
            </a>

        </div>

    </div>

</div>

</body>
</html>