<!DOCTYPE html>
<html>

<head>

<title>Nurse Haematology Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:40px;
}

.welcome-box{
    background:white;
    padding:20px 28px;
    border-radius:22px;
    box-shadow:0 8px 25px rgba(146,64,14,0.08);
    text-align:right;
    border:1px solid rgba(146,64,14,0.08);
}

.welcome-box h3{
    font-size:18px;
    font-weight:600;
    color:#86198f;
    margin-bottom:6px;
}

.welcome-box span{
    color:#78716c;
    font-size:18px;
}

.content{
    flex:1;
    padding:40px;
    overflow-x:hidden;
}

.page-title{
    font-size:40px;
    font-weight:700;
    color:#86198f;
}

.page-subtitle{
    color:#78716c;
    margin-top:10px;
}

.stat-card{
    background:white;
    margin-top:30px;
    padding:30px;
    border-radius:20px;
    width:300px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
    border-top:5px solid #c026d3;
}

.stat-number{
    font-size:48px;
    font-weight:700;
    color:#86198f;
}

/* Updated font-size to 20px for the subtitle */
.subtitle{
    color:#78716c;
    margin-bottom:35px;
    font-size:20px; 
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    margin-bottom:35px;
}

.stat-number{
    font-size:48px;
    font-weight:700;
    color:#86198f;
}

.stat-label{
    margin-top:10px;
    color:#6b7280;
}

.table-card{
    background:white;
    padding:25px;
    border-radius:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.06);
}

.card-title{
    font-size:24px;
    font-weight:700;
    color:#86198f;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#c026d3;
    color:white;
    padding:15px;
    text-align:left;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

.badge{
    background:#dcfce7;
    color:#166534;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.action-card,
.summary-card{
    margin-top:30px;
    background:white;
    padding:25px;
    border-radius:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.06);
}

.action-buttons{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.action-btn{
    background:#c026d3;
    color:white;
    text-decoration:none;
    padding:14px 24px;
    border-radius:12px;
    font-weight:600;
}

.action-btn:hover{
    background:#86198f;
}

.summary-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    margin-top:20px;
}

.summary-box{
    background:#f3e8ff;
    border-radius:15px;
    padding:25px;
    text-align:center;
    border:1px solid #d8b4fe;
}

.summary-box h3{
    font-size:36px;
    color:#86198f;
}

.summary-box p{
    color:#6b7280;
    margin-top:10px;
}

.main-container{
    display:flex;
    width:100%;
}

body{
    overflow-x:hidden;
    background:#faf5ff;
}

@media(max-width:1000px){

    .topbar{
        flex-direction:column;
        gap:20px;
    }

}

</style>

</head>

<body>

<div class="main-container">

    @include('layouts.nurse_haematology_sidebar')

    <div class="content">

   <div class="topbar">

    <div>
        <h1 class="page-title">
            Nurse Haematology Dashboard
        </h1>
        <p class="subtitle">
            Monitor admitted haematology patients
        </p>
    </div>

    <div class="welcome-box">
        <h3>
            Welcome, {{ session()->all()['name'] ?? 'NO NAME FOUND' }}
        </h3>

        <span>
            Haematology Nurse
        </span>
    </div>

</div>

    <div class="stats-grid">

    <div class="stat-card">
        <div class="stat-number">{{ $totalPatients }}</div>
        <div class="stat-label">Ward Patients</div>
    </div>

    <div class="stat-card">
        <div class="stat-number">{{ $vitalRecords }}</div>
        <div class="stat-label">Vital Records</div>
    </div>

    <div class="stat-card">
        <div class="stat-number">{{ $medicationRecords }}</div>
        <div class="stat-label">Medication Records</div>
    </div>

    <div class="stat-card">
        <div class="stat-number">{{ $totalPatients }}</div>
        <div class="stat-label">Under Observation</div>
    </div>

</div>

    <div class="table-card">

        <div class="card-title">
            Recent Ward Patients
        </div>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Diagnosis</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

            @forelse($recentPatients as $patient)

                <tr>

                    <td>{{ $patient->PatientID }}</td>

                    <td>{{ $patient->name }}</td>

                    <td>
                        {{ $patient->specialist_department }}
                    </td>

                    <td>

                        <span class="badge">

                            {{ $patient->status }}

                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" align="center">

                        No admitted patients

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

<div class="action-card">

    <div class="card-title">
        Quick Actions
    </div>

    <div class="action-buttons">

        <a href="/nurse-haematology/vitals"
           class="action-btn">
           Record Vital Signs
        </a>

        <a href="/nurse-haematology/medications"
           class="action-btn">
           Medication Records
        </a>

        <a href="/nurse-haematology/ward-patients"
           class="action-btn">
           Ward Patients
        </a>

    </div>

</div>

<div class="summary-card">

    <div class="card-title">
        Today's Monitoring Summary
    </div>

    <div class="summary-grid">

        <div class="summary-box">
            <h3>{{ $totalPatients }}</h3>
            <p>Admitted Patients</p>
        </div>

        <div class="summary-box">
            <h3>{{ $vitalRecords }}</h3>
            <p>Vitals Recorded</p>
        </div>

        <div class="summary-box">
            <h3>{{ $medicationRecords }}</h3>
            <p>Medication Updates</p>
        </div>

    </div>

</div>
</div>
</div>
</body>
</html>