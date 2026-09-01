<!DOCTYPE html>
<html>
<head>
    <title>Admission List - Healthsistant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background: linear-gradient(135deg, #fff8f8, #fef2f2);
            color:#1e293b;
        }

        .layout{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */
        .sidebar{
            width:280px;
            background:linear-gradient(180deg,#7f1d1d,#991b1b,#450a0a);
            padding:30px 25px;
            color:white;
        }

        .logo h2{
            font-size:20px;
            font-weight:700;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:14px;
            text-decoration:none;
            color:white;
            padding:15px 18px;
            border-radius:14px;
            margin-bottom:12px;
            transition:0.3s;
            font-weight:500;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.12);
        }

        .menu .active{
            background:white;
            color:#991b1b;
            font-weight:600;
        }

        /* MAIN BODY */
        .main{
            flex:1;
            padding:40px;
            background: radial-gradient(circle at top right, rgba(127,29,29,0.08), transparent 30%);
        }

        .topbar h1{
            font-size:42px;
            font-weight:700;
            color:#111827;
        }

        .topbar p{
            color:#6b7280;
            margin-top:10px;
            font-size:18px;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            padding:16px 20px;
            border-radius:14px;
            margin-bottom:25px;
            font-weight:500;
        }

        /* CARD TABLE CONTAINER */
        .table-card{
            width:100%;
            background:white;
            border-radius:28px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            border-top:5px solid #dc2626;
            margin-top:30px;
        }

        .table-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .table-header h2{
            font-size:30px;
            color:#0f172a;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#991b1b;
            color:white;
            padding:18px;
            text-align:left;
            font-size:14px;
        }

        td{
            padding:18px;
            border-bottom:1px solid #f1f5f9;
            font-size:14px;
            color:#334155;
        }

        tr:hover{
            background:#fff7f7;
        }

        .badge{
            padding:8px 14px;
            border-radius:30px;
            font-size:12px;
            font-weight:600;
            display:inline-block;
        }

        .badge-admitted{
            background:#fee2e2;
            color:#991b1b;
        }

        .dept-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        .dept-cardio {
            background: #eff6ff;
            color: #1e40af;
        }

        .dept-haem {
            background: #faf5ff;
            color: #6b21a8;
        }

        .empty{
            text-align:center;
            padding:40px;
            color:#94a3b8;
        }

        .controls-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-wrapper {
            position: relative;
            width: 300px;
        }

        .search-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .search-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 46px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-family: inherit;
            outline: none;
            font-size: 15px;
        }

        #deptFilter {
            padding: 12px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: white;
            cursor: pointer;
            font-family: inherit;
            outline: none;
            font-size: 15px;
        }
    </style>
</head>

<body>

<div class="layout">
    @include('layouts.admin_sidebar')
    
    <div class="main">
        <div class="topbar">
            <div>
               <h1>
                    <i class="fa-solid fa-bed-pulse"></i>
                    Admission Management
               </h1>
               <p>View and manage all hospital admission records</p>
            </div>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-header">
                <h2>Hospital Admissions</h2>
                
                <div class="controls-group">
                    <div class="search-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search Admission ID or Name...">
                    </div>

                    <select id="deptFilter" onchange="filterTable()">
                        <option value="all">All Departments</option>
                        <option value="cardio">Cardiology</option>
                        <option value="haem">Haematology</option>
                    </select>
                </div>
            </div>

            <table id="admissionTable">
                <thead>
                    <tr>
                        <th>Admission ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Department</th> 
                        <th>Early Symptoms</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($admissions as $a)
                    @php
                        // Check symptoms string to decide department allocation
                        $symptomsLower = strtolower($a->symptoms ?? '');
                        
                        if (str_contains($symptomsLower, 'heart') || str_contains($symptomsLower, 'cardio') || str_contains($symptomsLower, 'chest') || str_contains($symptomsLower, 'breath') || str_contains($symptomsLower, 'sweating')) {
                            $deptAttr = 'cardio';
                            $deptLabel = 'Cardiology';
                            $deptClass = 'dept-cardio';
                        } else {
                            // Default everything else to Haematology (anemia, infections, bleeding, cough, back pain, etc.)
                            $deptAttr = 'haem';
                            $deptLabel = 'Haematology';
                            $deptClass = 'dept-haem';
                        }
                    @endphp

                    <tr data-dept="{{ $deptAttr }}">
                        <td style="font-weight: 600;">#{{ $a->AdmissionID }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->age }}</td>
                        <td>{{ $a->gender }}</td>
                        <td>
                            <span class="dept-badge {{ $deptClass }}">{{ $deptLabel }}</span>
                        </td>
                        <td>{{ $a->symptoms ?? 'No symptoms reported' }}</td>
                        <td>
                            <span class="badge badge-admitted">
                                {{ $a->diagnosis_status ?? 'Admitted' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyRow">
                        <td colspan="7" class="empty">No admission records found.</td>
                    </tr>
                @endforelse
                
                <tr id="noMatchesRow" style="display: none;">
                    <td colspan="7" class="empty" style="color: #ef4444;">
                        <i class="fa-solid fa-circle-exclamation"></i> No matching admissions found.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterTable() {
    let textInput = document.getElementById("searchInput").value.toLowerCase().trim();
    let selectedDept = document.getElementById("deptFilter").value;
    let table = document.getElementById("admissionTable");
    let tr = table.getElementsByTagName("tr");
    let visibleRows = 0;
    
    for (let i = 1; i < tr.length; i++) {
        if (tr[i].id === "noMatchesRow" || tr[i].id === "emptyRow") continue;

        let idTd = tr[i].getElementsByTagName("td")[0];   
        let nameTd = tr[i].getElementsByTagName("td")[1]; 
        let rowDept = tr[i].getAttribute("data-dept") || "";

        let matchesText = false;
        let matchesDept = (selectedDept === "all" || rowDept === selectedDept);

        if (idTd && nameTd) {
            let idText = idTd.textContent || idTd.innerText;
            let nameText = nameTd.textContent || nameTd.innerText;
            
            if (idText.toLowerCase().includes(textInput) || nameText.toLowerCase().includes(textInput)) {
                matchesText = true;
            }
        }

        if (matchesText && matchesDept) {
            tr[i].style.display = "";
            visibleRows++;
        } else {
            tr[i].style.display = "none";
        }
    }

    let noMatchesRow = document.getElementById("noMatchesRow");
    if (noMatchesRow) {
        noMatchesRow.style.display = (visibleRows === 0) ? "" : "none";
    }
}
</script>

</body>
</html>