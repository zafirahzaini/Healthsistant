<!DOCTYPE html>
<html>
<head>

    <title>Patient Management - Healthsistant</title>

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
}

/* ===== LAYOUT ===== */

.main-container{
    display:flex;
    min-height:100vh;
}

.content{
    flex:1;
    padding:40px;
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

/* ===== STATS ===== */

.stats-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:25px;
}

.stat-card{

    background:white;

    padding:25px;

    border-radius:20px;

    box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.stat-card h3{

    font-size:34px;
    color:#7f1d1d;
    margin-bottom:8px;
}

.stat-card p{

    color:#6b7280;

    font-weight:500;
}

/* ===== FILTER CARD ===== */

.filter-card{

    background:white;
    padding:25px;
    border-radius:24px;

    margin-bottom:30px;

    box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.filters{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:15px;
}

.filters input,
.filters select{

    padding:14px;

    border:1px solid #d1d5db;

    border-radius:12px;

    font-family:'Poppins',sans-serif;
}

.filter-btn{

    background:#7f1d1d;
    color:white;
    border:none;
    border-radius:12px;
    padding:14px;
    cursor:pointer;
    font-weight:600;
}

.reset-btn{
    background:#6b7280;
    color:white;
    text-decoration:none;
    border-radius:12px;
    padding:14px 25px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:600;
}

.reset-btn:hover{
    background:#4b5563;
}

/* ===== TABLE ===== */

.table-card{
    background:white;
    border-radius:24px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{

    background:#7f1d1d;
    color:white;
    padding:15px;
    text-align:left;
}

td{

    padding:15px;
    border-bottom:1px solid #e5e7eb;
}

tr:hover{
    background:#f9fafb;
}

.badge{

    padding:6px 12px;

    border-radius:20px;

    font-size:12px;

    font-weight:600;
}

.waiting{
    background:#fef3c7;
    color:#92400e;
}

.admitted{
    background:#dcfce7;
    color:#166534;
}

.discharged{
    background:#e5e7eb;
    color:#374151;
}

</style>

</head>

<body>

<div class="main-container">

    @include('layouts.admin_sidebar')

    <div class="content">

        <div class="page-header">

            <h1>
                <i class="fa-solid fa-hospital-user"></i>
                Patient Management
            </h1>

            <p>
                View and manage all registered patients
            </p>

        </div>

<!-- STATISTICS -->

<div class="stats-grid">

    <div class="stat-card">

        <h3>{{ $patients->count() }}</h3>

        <p>Total Patients</p>

    </div>

    <div class="stat-card">

        <h3>
            {{ $patients->where('status','Waiting')->count() }}
        </h3>

        <p>Waiting</p>

    </div>

    <div class="stat-card">

        <h3>
            {{ $patients->where('status','Admitted')->count() }}
        </h3>

        <p>Admitted</p>

    </div>

    <div class="stat-card">

        <h3>
            {{ $patients->where('status','Discharged')->count() }}
        </h3>

        <p>Discharged</p>

    </div>

</div>

<!-- FILTER -->

<div class="filter-card">

            <form method="GET">

                <div class="filters">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search Name / IC / Passport"
                        value="{{ request('search') }}"
                    >

                    <select name="department">

                        <option value="">
                            All Departments
                        </option>

                        <option value="Cardiology">
                            Cardiology
                        </option>

                        <option value="Haematology">
                            Haematology
                        </option>

                    </select>

                    <select name="status">

                        <option value="">
                            All Status
                        </option>

                        <option value="Waiting">
                            Waiting
                        </option>

                        <option value="Admitted">
                            Admitted
                        </option>

                        <option value="Discharged">
                            Discharged
                        </option>

                    </select>

                    <div style="display:flex; gap:10px;">

                    <button
                    type="submit"
                    class="filter-btn">

                    Filter

                    </button>

                    <a href="/admin/patients?all=1"
                    class="reset-btn">
                    All
                    </a>
                    </div>
                </div>

            </form>

        </div>

        <!-- TABLE -->

        <div class="table-card">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>IC Number</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Waiting Duration</th>
                        <th>Doctor Seen</th>
                        <th>Admitted</th>
                        <th>Discharged</th>
                        <th>Ward Discharged</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @if(request()->has('search') || request()->has('department') || request()->has('status') || request()->has('all'))

                @forelse($patients as $patient)

                    <tr>
                        <td>
                            {{ $patient->PatientID }}
                        </td>

                        <td>
                            {{ $patient->name }}
                        </td>

                        <td>
                            {{ $patient->ic_number }}
                        </td>

                        <td>
                            {{ $patient->gender }}
                        </td>

                        <td>
                            {{ $patient->specialist_department ?? 'General' }}
                        </td>

                        <td>

                            <span class="badge
                            {{ strtolower($patient->status) }}">

                                {{ $patient->status }}

                            </span>

                        </td>

                                <td>
                                {{ $patient->created_at
                                ? \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y h:i A')
                                : '-' }}
                                </td>

                               <td>

                                @if($patient->doctor_seen_at)

                                Seen

                                @else

                                {{ \Carbon\Carbon::parse($patient->created_at)->diffForHumans() }}

                                @endif

                                </td>

                                <td>
                                {{ $patient->doctor_seen_at
                                ? \Carbon\Carbon::parse($patient->doctor_seen_at)->format('d/m/Y h:i A')
                                : '-' }}
                                </td>

                                <td>
                                {{ $patient->admitted_at
                                ? \Carbon\Carbon::parse($patient->admitted_at)->format('d/m/Y h:i A')
                                : '-' }}
                                </td>

                                <td>
                                {{ $patient->discharged_at
                                ? \Carbon\Carbon::parse($patient->discharged_at)->format('d/m/Y h:i A')
                                : '-' }}
                                </td>

                                <td>
                                {{ $patient->ward_discharged_at
                                ? \Carbon\Carbon::parse($patient->ward_discharged_at)->format('d/m/Y h:i A')
                                : '-' }}
                                </td>

                                <td>

                                <a href="{{ url('/admin/patient/'.$patient->PatientID) }}"
                                style="
                                background:#7f1d1d;
                                color:white;
                                padding:8px 15px;
                                border-radius:8px;
                                text-decoration:none;
                                font-size:13px;
                                font-weight:600;
                                ">

                                View

                                </a>

                                </td>
                                </tr>

                @empty

                    <tr>

                        <td colspan="13">

                            No patient records found.

                        </td>

                    </tr>

                @endforelse

                @else
                <tr>
                    <td colspan="13" style="text-align:center; padding:30px;">
                        Search patient name / IC number or click All to view patients
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>