<!DOCTYPE html>
<html>

<head>

<title>Ward Patients</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#fefbf3;
}

.main-container{
    display:flex;
}

.content{
    flex:1;
    padding:40px;
}

.page-title{
    font-size:40px;
    font-weight:700;
    color:#92400e;
}

.page-subtitle{
    color:#92400e;
    margin-top:10px;
    margin-bottom:30px;
}

.card{
    background:white;
    border-radius:20px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f59e0b;
    color:white;
    padding:15px;
    text-align:left;
}

td{
    padding:15px;
    border-bottom:1px solid #e5e7eb;
}

.badge{
    background:#dcfce7;
    color:#15803d;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-bed{
    background:#fef3c7;
    color:#92400e;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.btn{
    background:#f59e0b;
    color:white;
    text-decoration:none;
    padding:8px 14px;
    border-radius:8px;
    font-size:13px;
}

</style>

</head>

<body>

<div class="main-container">

    @include('layouts.nurse_cardiology_sidebar')

    <div class="content">

        <div class="page-title">
            Ward Patients
        </div>

        <div class="page-subtitle">
            Admitted patients under Cardiology Department
        </div>

        <div class="card">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Ward / Bed</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($patients as $patient)

                    <tr>

                        <td>{{ $patient->PatientID }}</td>

                        <td>{{ $patient->name }}</td>

                        <td>
                            @if($patient->admission_ward || $patient->bed_number)
                                <span class="badge-bed">
                                    {{ $patient->admission_ward ?? 'Ward N/A' }} - {{ $patient->bed_number ?? 'Bed N/A' }}
                                </span>
                            @else
                                <span style="color:#9ca3af; font-size:13px;">Unassigned</span>
                            @endif
                        </td>

                        <td>
                            {{ $patient->preliminary_diagnosis ?? '-' }}
                        </td>

                        <td>
                            <span class="badge">
                                Admitted
                            </span>
                        </td>

                        <td>

                            <a href="/nurse-cardiology/vitals/{{ $patient->PatientID }}" class="btn">
                                Monitor
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" style="text-align:center;padding:30px;">
                            No admitted patients found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>