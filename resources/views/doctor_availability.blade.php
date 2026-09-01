<!DOCTYPE html>
<html>
<head>
    <title>Available Doctors - Healthsistant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #eef5ff, #f8fbff);
            color: #111827;
        }

        /* ================= LAYOUT CONTAINER (MATCHING PATIENT_ADD) ================= */
        .main-container {
            display: flex;
            min-height: 100vh;
        }

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

        /* ================= CONTENT STYLING ================= */
        .page{
            position:relative;
            z-index:2;
            display:flex;
            justify-content:center;
            align-items:center;
            flex:1;
            padding:45px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 38px;
            color: #111827;
            font-weight: 700;
        }

        .page-header p {
            color: #6b7280;
            font-size: 16px;
            margin-top: 4px;
        }

        .header{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:40px;
}

.header-icon{
    width:78px;
    height:78px;
    border-radius:24px;
    background:linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:30px;
}

.header-text h1{
    font-size:40px;
    color:#111827;
    margin-bottom:10px;
    font-weight:700;
}

.header-text p{
    color:#6b7280;
    font-size:17px;
}

        /* NOTIFICATIONS */
        .success {
            background: #e0f2fe;
            border-left: 5px solid #0284c7;
            color: #0369a1;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card{
            width:98%;
            max-width:1700px;
            background:rgba(255,255,255,0.92);
            backdrop-filter:blur(12px);
            border-radius:34px;
            padding:48px;
            border:1px solid rgba(127,29,29,0.12);
            box-shadow:
                0 15px 40px rgba(0,0,0,0.06),
                0 5px 15px rgba(127,29,29,0.08);
            position:relative;
            overflow:hidden;
        }

        body::before{
            content:"";
            position:fixed;
            top:-200px;
            right:-150px;
            width:500px;
            height:500px;
            background:rgba(37,99,235,0.08);
            border-radius:50%;
            filter:blur(40px);
            z-index:0;
        }

        body::after{
            content:"";
            position:fixed;
            bottom:-180px;
            left:-120px;
            width:450px;
            height:450px;
            background:rgba(96,165,250,0.08);
            border-radius:50%;
            filter:blur(45px);
            z-index:0;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* FILTER CONTROLS GRID */
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 131, 246, 0.1);
        }

        /* ACTIONS BUTTONS */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            justify-content: flex-end;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #1e40af;
            color: white;
        }

        .btn-primary:hover {
            background: #1e3a8a;
        }

        .btn-outline {
            background: white;
            border: 1px solid #e5e7eb;
            color: #4b5563;
        }

        .btn-outline:hover {
            background: #f9fafb;
            color: #1f2937;
        }

        /* TABLES */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .modern-table th {
            background:#eff6ff;
            padding: 16px 20px;
             color:#1e40af;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modern-table td {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        .modern-table tr:last-child td {
            border-bottom: none;
        }

        .modern-table tr:hover td {
            background: #f8fafc;
        }

        /* DEPT BADGES */
        .dept-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .dept-cardio {
            background: #eff6ff;
            color: #1e40af;
        }

        .dept-haem {
            background: #faf5ff;
            color: #6b21a8;
        }

        .dept-general {
            background: #f1f5f9;
            color: #475569;
        }

        /* CUSTOM CHECKBOX */
        .checkbox-container {
            display: block;
            position: relative;
            cursor: pointer;
            font-size: 22px;
            user-select: none;
            width: 24px;
            height: 24px;
            margin: auto;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            background-color: #f3f4f6;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .section-box{
            margin-top:30px;
        }

        .checkbox-container:hover input ~ .checkmark {
            background-color: #e5e7eb;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: #1e40af;
            border-color: #1e40af;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 8px;
            top: 4px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>

<div class="main-container">
    @include('layouts.nurse_sidebar')

    <div class="page">
    <div class="card">
        <div class="header">
    <div class="header-icon">
        <i class="fa-solid fa-user-doctor"></i>
    </div>

    <div class="header-text">
        <h1>Doctor Availability</h1>
        <p>
            Manage active specialists available for patient referrals
        </p>
    </div>
</div>

        @if(session('success'))
            <div class="success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="section-box">
    <h2 class="section-title">
        <i class="fa-solid fa-sliders"></i>
        Filter Diagnostics
    </h2>
            <div class="filter-grid">
                <div class="form-group">
                    <label>Staff ID</label>
                    <input type="text" id="staffSearch" onkeyup="filterDoctors()" placeholder="e.g. ST587" class="form-control">
                </div>
                <div class="form-group">
                    <label>Doctor Name</label>
                    <input type="text" id="nameSearch" onkeyup="filterDoctors()" placeholder="Search names..." class="form-control">
                </div>
                <div class="form-group">
                    <label>Department Specialization</label>
                    <select id="departmentFilter" onchange="filterDoctors()" class="form-control">
                        <option value="all">All Departments</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="haematology">Haematology</option>
                    </select>
                </div>
            </div>
            
            <div class="btn-group">
                <button type="button" class="btn btn-outline" onclick="deselectAllDoctors()">
                    <i class="fa-solid fa-square"></i> Clear Selections
                </button>
                <button type="button" class="btn btn-outline" onclick="selectAllDoctors()">
                    <i class="fa-solid fa-square-check"></i> Select All
                </button>
            </div>
        </div>

        <div class="section-box">
    <h2 class="section-title">
        <i class="fa-solid fa-user-doctor"></i>
        Specialist Doctor
    </h2>
            
            <form action="{{ url('/doctor/availability/save') }}" method="POST">
                @csrf
                <input type="hidden" name="is_form_submitted" value="1">

                <div class="table-responsive">
                    <table class="modern-table" id="doctorTable">
                        <thead>
                            <tr>
                                <th style="width: 80px; text-align: center;">Active</th>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($doctors) && count($doctors) > 0)
                                @foreach($doctors as $doctor)
                                @php
                                    $deptClass = 'dept-general';
                                    $deptLabel = 'General Medicine';

                                    if(isset($doctor->role)) {
                                        if(str_contains(strtolower($doctor->role), 'cardio')) {
                                            $deptClass = 'dept-cardio';
                                            $deptLabel = 'Cardiology';
                                        } elseif(str_contains(strtolower($doctor->role), 'haem')) {
                                            $deptClass = 'dept-haem';
                                            $deptLabel = 'Haematology';
                                        }
                                    }

                                    $isChecked = false;
                                    if(isset($activeDoctorIDs) && is_array($activeDoctorIDs)) {
                                        $isChecked = in_array($doctor->userID, $activeDoctorIDs);
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center;">
                                        <label class="checkbox-container">
                                            <input type="checkbox" name="doctor[]" value="{{ $doctor->userID }}" 
                                                {{ $isChecked ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td style="font-weight: 600; color: #64748b;">#{{ $doctor->userID }}</td>
                                    <td style="font-weight: 600; color: #1e293b;">{{ $doctor->name }}</td>
                                    <td>
                                        <span class="dept-badge {{ $deptClass }}">{{ $deptLabel }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px; color: #6b7280;">No doctor records available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Update Doctor Availability
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>

<script>
function filterDoctors() {
    let idInput = document.getElementById('staffSearch').value.toLowerCase().trim();
    let nameInput = document.getElementById('nameSearch').value.toLowerCase().trim();
    let department = document.getElementById('departmentFilter').value.toLowerCase();
    let rows = document.querySelectorAll('#doctorTable tbody tr');

    rows.forEach(row => {
        if(row.children.length >= 4) {
            let staff = row.children[1].innerText.toLowerCase();
            let name = row.children[2].innerText.toLowerCase();
            let dept = row.children[3].innerText.toLowerCase();
            let show = true;

            if(idInput && !staff.includes(idInput)) show = false;
            if(nameInput && !name.includes(nameInput)) show = false;
            if(department !== 'all' && !dept.includes(department)) show = false;

            row.style.display = show ? '' : 'none';
        }
    });
}

function deselectAllDoctors() {
    document.querySelectorAll('input[name="doctor[]"]').forEach(box => {
        box.checked = false;
    });
}

function selectAllDoctors() {
    document.querySelectorAll('input[name="doctor[]"]').forEach(box => {
        box.checked = true;
    });
}
</script>

</body>
</html>