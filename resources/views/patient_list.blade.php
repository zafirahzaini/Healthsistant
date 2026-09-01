<!DOCTYPE html>
<html>
<head>

    <title>Patient List - Healthsistant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            font-family:'Poppins',sans-serif;
            min-height:100vh;
            background:
            linear-gradient(
                    135deg,
                    #f8fbff,
                    #eef6ff
                );

            color:#111827;
            position:relative;
            overflow-x:hidden;
        }

        /* ================= LAYOUT ================= */

        .main-container{

            display:flex;

            min-height:100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{

            width:290px;

            background:linear-gradient(
            180deg,
            #1e40af,
            #1e3a8a
        );

            padding:30px 22px;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

            box-shadow:5px 0 25px rgba(0,0,0,0.08);
        }

        /* ================= LOGO ================= */

        .logo-section{

            margin-bottom:45px;
        }

        .logo{

            display:flex;

            align-items:center;

            gap:14px;
        }

        .logo-box{

            width:58px;

            height:58px;

            border-radius:18px;

            background:rgba(255,255,255,0.15);

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:24px;

            backdrop-filter:blur(8px);
        }

        .logo h2{

            font-size:30px;

            color:white;

            font-weight:700;
        }

        .logo-sub{

            margin-top:10px;

            color:rgba(255,255,255,0.75);

            font-size:15px;

            line-height:1.7;
        }

        /* ================= MENU ================= */

        .menu{

            margin-top:40px;
        }

        .menu-title{
            font-size:13px;
            color:rgba(255,255,255,0.5);
            margin-bottom:18px;
            padding-left:12px;
            letter-spacing:1px;
        }

        .menu a{

            display:flex;

            align-items:center;

            gap:14px;

            text-decoration:none;

            color:white;

            padding:15px 18px;

            border-radius:16px;

            margin-bottom:14px;

            transition:0.3s;

            font-size:15px;

            font-weight:500;
        }

        .menu a i{

            width:20px;
        }

        .menu a:hover{

            background:rgba(255,255,255,0.12);

            transform:translateX(4px);
        }

        .menu .active{

            background:white;

            color:#2563eb;

            font-weight:600;
        }

        /* ================= LOGOUT ================= */

        .logout-btn a{

            display:flex;

            align-items:center;

            justify-content:center;

            gap:10px;

            text-decoration:none;

            background:white;

            color:#2563eb;

            padding:15px;

            border-radius:16px;

            font-weight:600;

            transition:0.3s;
        }

        .logout-btn a:hover{

            background:#f3f4f6;
        }

        /* ================= BACKGROUND EFFECT ================= */

        body::before{
            content:"";
            position:fixed;
            top:-180px;
            right:-150px;
            width:500px;
            height:500px;
            background:rgba(37,99,235,0.06);
            border-radius:50%;
            filter:blur(45px);
            z-index:0;
        }

        body::after{
            content:"";
            position:fixed;
            bottom:-150px;
            left:-100px;
            width:400px;
            height:400px;
            background:rgba(239,68,68,0.05);
            border-radius:50%;
            filter:blur(40px);
            z-index:0;
        }

        /* ================= CONTAINER ================= */

        .container{
            position:relative;
            z-index:2;
            flex:1;
            padding:45px;
            max-width:1600px;
        }

        /* ================= HEADER ================= */

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:45px;
        }

        .header-left{
            display:flex;
            align-items:center;
            gap:22px;
        }

        .icon-box{
            width:75px;
            height:75px;
            border-radius:22px;
            background:linear-gradient(
                135deg,
                #2563eb,
                #3b82f6
            );

            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:28px;
            box-shadow:0 10px 25px rgba(37,99,235,0.2);
        }

        .header-text h1{
            font-size:38px;
            font-weight:700;
            color:#111827;
            margin-bottom:6px;
        }

        .header-text p{
            color:#6b7280;
            font-size:16px;
        }

        /* ================= SEARCH ================= */

        .search-container{
            background:white;
            padding:12px 24px;
            border-radius:20px;
            display:flex;
            align-items:center;
            gap:15px;
            width:400px;
            border:1px solid rgba(0,0,0,0.08);
            box-shadow:0 8px 20px rgba(0,0,0,0.02);
        }

        .search-container i{
            color:#9ca3af;
            font-size:18px;
        }

        .search-container input{
            border:none;
            outline:none;
            width:100%;
            font-size:15px;
            color:#111827;
            font-family:'Poppins',sans-serif;
        }

        /* ================= TABLE CARD ================= */

        .table-card{
            background:white;
            border-radius:30px;
            padding:10px;
            box-shadow:0 15px 35px rgba(0,0,0,0.04);
            border:1px solid rgba(0,0,0,0.06);
            overflow:hidden;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#fafafa;
            padding:20px 24px;
            text-align:left;
            font-size:14px;
            font-weight:600;
            color:#4b5563;
            border-bottom:1px solid #f3f4f6;
            text-transform:uppercase;
            letter-spacing:0.5px;
        }

        td{
            padding:22px 24px;
            font-size:15px;
            color:#1f2937;
            border-bottom:1px solid #f3f4f6;
        }

        tr:last-child td{
            border-bottom:none;
        }

        tr:hover td{
            background:#fbfdff;
        }

        /* ================= BADGE STATUS ================= */

        .status{
            display:inline-flex;
            align-items:center;
            padding:8px 16px;
            border-radius:12px;
            font-size:13px;
            font-weight:600;
        }

        .status.waiting{
            background:#fef3c7;
            color:#d97706;
        }

        .status.discharged{
            background:#dcfce7;
            color:#166534;
        }

        .status.assigned{
            background:#dbeafe;
            color:#1e40af;
        }

        /* ================= BACK ================= */

        .back{
            margin-top:35px;
            text-align:center;
        }

        .back a{
            text-decoration:none;
            color:#2563eb;
            font-weight:600;
            transition:0.3s;
            font-size:15px;
        }

        .back a:hover{
            color:#1d4ed8;
        }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.nurse_sidebar')

    <div class="container">

        <div class="header">

            <div class="header-left">

                <div class="icon-box">

                    <i class="fa-solid fa-hospital-user"></i>

                </div>

                <div class="header-text">

                    <h1>Patient List</h1>

                    <p>

                        View and track patient logs along with current workflow status

                    </p>

                </div>

            </div>

            <div class="search-container">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="searchInput"
                    onkeyup="searchIC()"
                    placeholder="Search by IC / Passport number..."
                >

            </div>

        </div>

        <div class="table-card">

            <table id="patientTable">

                <thead>

                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">Patient Name</th>
                        <th style="width: 20%;">IC / Passport Number</th>
                        <th style="width: 10%;">Age</th>
                        <th style="width: 15%;">Gender</th>
                        <th style="width: 20%;">Current Status</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($patients as $p)

                <tr>

                    <td style="font-weight: 600; color: #6b7280;">

                        #{{ $p->PatientID }}

                    </td>

                    <td style="font-weight: 600; color: #111827;">

                        {{ $p->name }}

                    </td>

                    <td>{{ $p->ic_number }}</td>

                    <td>{{ $p->age }} Y/O</td>

                    <td>{{ $p->gender }}</td>

                    <td>

                    @if($p->status == 'Waiting')

                        <span class="status waiting">
                            Waiting
                        </span>

                    @elseif($p->status == 'Discharged')

                        <span class="status discharged">
                            Discharged
                        </span>

                    @elseif($p->status == 'Admitted')

                        <span class="status assigned">
                            Admitted
                        </span>

                    @else

                        <span class="status">
                            {{ $p->status }}
                        </span>

                    @endif

                </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>

        <div class="back">

            <a href="/dashboard/nurse">

                ← Back to Dashboard

            </a>

        </div>

    </div>

</div>

<script>
function searchIC() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let table = document.getElementById("patientTable");
    let tr = table.getElementsByTagName("tr");
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            let text = td.textContent || td.innerText;
            tr[i].style.display =
                text.toLowerCase().includes(input)
                ? ""
                : "none";
        }
    }
}
</script>
</body>
</html>