<!DOCTYPE html>
<html>
<head>

    <title>Patient List - Healthsistant</title>

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
            background:linear-gradient(135deg,#f8f5f5,#f2f2f2);
            min-height:100vh;
            color:#111827;
            position:relative;
            overflow-x:hidden;
        }

        .main-container{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            padding:40px;
        }

        .container{
            width:100%;
        }

        /* ================= HEADER ================= */
        .header-card{
            background:white;
            border-radius:30px;
            padding:35px 40px;
            margin-bottom:40px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            position:relative;
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .title-section{
            display:flex;
            align-items:center;
            gap:18px;
        }

        .icon-box{
            width:70px;
            height:70px;
            border-radius:22px;
            background:#dcfce7;
            display:flex;
            justify-content:center;
            align-items:center;
            color:#166534;
            font-size:28px;
        }

        .title-text h1{
            font-size:42px;
            color:#111827;
            margin-bottom:4px;
        }

        .title-text p{
            color:#6b7280;
            font-size:16px;
        }

        /* ================= SEARCH ================= */
        .search-box{
            position:relative;
            width:350px;
        }

        .search-box i{
            position:absolute;
            top:20px;
            left:22px;
            color:#9ca3af;
            font-size:16px;
        }

        .search-box input{
            width:100%;
            padding:16px 20px 16px 54px;
            border-radius:20px;
            border:1px solid #e5e7eb;
            background:#ffffff;
            font-size:15px;
            font-family:'Poppins',sans-serif;
            transition:0.3s;
            box-shadow:0 4px 10px rgba(0,0,0,0.02);
        }

        .search-box input:focus{
            outline:none;
            border-color:#22c55e;
            box-shadow:0 0 0 4px rgba(34,197,94,0.1);
        }

        /* ================= SUCCESS MESSAGE ================= */
        .success{
            background:#dcfce7;
            border:1px solid #86efac;
            color:#166534;
            padding:16px;
            border-radius:16px;
            margin-bottom:25px;
            font-size:14px;
        }

        /* ================= TABLE CONTAINER ================= */
        .table-wrapper{
            background:white;
            border-radius:28px;
            border-top:5px solid #22c55e;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            overflow:hidden;
            overflow-x:auto;
        }

        /* ================= TABLE ================= */
        table{
            width:100%;
            border-collapse:collapse;
            min-width:1200px;
        }

        thead{
            background:#166534;
        }

        th{
            padding:18px 20px;
            color:white;
            font-size:15px;
            font-weight:600;
            text-align:left;
        }

        td{
            padding:18px 20px;
            text-align:left;
            font-size:14px;
            color:#374151;
            border-bottom:1px solid #f1f5f9;
        }

        tbody tr{
            transition:0.2s;
        }

        tbody tr:hover{
            background:#f8fafc;
        }

        /* ================= BADGE STYLE ================= */
        .badge{
            display:inline-block;
            padding:4px 10px;
            border-radius:8px;
            background:#f1f5f9;
            color:#475569;
            font-size:13px;
            font-weight:600;
        }

        .status{
            padding:6px 14px;
            border-radius:20px;
            font-size:12px;
            font-weight:600;
            display:inline-block;
            text-align:center;
        }

        .waiting{
            background:#e0f2fe;
            color:#0369a1;
        }

        .assigned{
            background:#dcfce7;
            color:#166534;
        }

        .discharged{
            background:#fee2e2;
            color:#991b1b;
        }

        @media(max-width:900px){
            .header{
                flex-direction:column;
                align-items:flex-start;
            }
            .search-box{
                width:100%;
            }
        }
    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.doctor_sidebar')

    <div class="content">
        <div class="container">

            <!-- ================= HEADER ================= -->
            <div class="header-card">
                <div class="header">
                    <div class="title-section">
                        <div class="icon-box">
                            <i class="fa-solid fa-hospital-user"></i>
                        </div>
                        <div class="title-text">
                            <h1>Patient List</h1>
                            <p>View and manage registered patient healthcare information</p>
                        </div>
                    </div>

                    <!-- SEARCH -->
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search by IC Number..."
                            onkeyup="searchIC()"
                        >
                    </div>
                </div>
            </div>

            <!-- SUCCESS -->
            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ================= TABLE ================= -->
            <div class="table-wrapper">
                <table id="patientTable">
                    <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>IC / Passport</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Symptoms</th>
                        <th>Registration Time</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $p)
                    <tr>
                        <td>
                            <span class="badge">
                                {{ $p->PatientID }}
                            </span>
                        </td>
                        <td style="font-weight: 500; color: #111827;">{{ $p->name }}</td>
                        <td>{{ $p->ic_number ?? $p->passport_number }}</td>
                        <td>{{ $p->age }}</td>
                        <td>{{ $p->gender }}</td>
                        <td style="color:#6b7280;">{{ $p->symptoms }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($p->status == 'Waiting')
                                <span class="status waiting">Waiting</span>
                            @elseif($p->status == 'Discharged')
                                <span class="status discharged">Discharged</span>
                            @elseif($p->status == 'Admitted')
                                <span class="status assigned">Admitted</span>
                            @else
                                <span class="status">{{ $p->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- ================= SEARCH SCRIPT ================= -->
<script>
function searchIC() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let table = document.getElementById("patientTable");
    let tr = table.getElementsByTagName("tr");
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            let text = td.textContent || td.innerText;
            tr[i].style.display = text.toLowerCase().includes(input) ? "" : "none";
        }
    }
}
</script>

</body>
</html>