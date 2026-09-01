<!DOCTYPE html>
<html>
<head>
    <title>Haematology Patient Records</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#fdf2f8;
            display:flex;
        }

        .main-content{
            flex:1;
            padding:40px;
        }

        .page-header{
            background:white;
            padding:30px;
            border-radius:20px;
            margin-bottom:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        .page-header h1{
            font-size:40px;
            color:#0f172a;
            margin-bottom:10px;
        }

        .page-header p{
            color:#64748b;
            font-size:18px;
        }

        .page-title{
            font-size:40px;
            font-weight:700;
            color:#0f172a;
            margin-bottom:10px;
        }

        .page-subtitle{
            font-size:20px;
            color:#64748b;
            margin-bottom:35px;
        }

        .record-card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        .record-title{
            font-size:32px;
            font-weight:600;
            margin-bottom:20px;
            color:#0f172a;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#db2777;
            color:white;
        }

        th{
            padding:16px;
            text-align:left;
        }

        td{
            padding:16px;
            border-bottom:1px solid #e5e7eb;
        }

        tr:hover{
            background:#fff9eb;
        }

        .badge{
            background:#dcfce7;
            color:#15803d;
            padding:6px 14px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

        .view-btn{
            text-decoration:none;
            background:#db2777;
            color:white;
            padding:8px 16px;
            border-radius:8px;
            font-size:14px;
            font-weight:600;
        }

        .view-btn:hover{
            background:#b77900;
        }

    </style>

</head>
<body>

@include('layouts.haematology_sidebar')

<div class="main-content">

    <h1 class="page-title">
    Patient Records
</h1>

<p class="page-subtitle">
    View all haematology patient records and specialist cases
</p>
    <div class="record-card">

        <div class="record-title">
            Haematology Patients
        </div>

        <table>

            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Symptoms</th>
                    <th>Diagnosis</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            @forelse($patients as $patient)

                <tr>

                    <td>{{ $patient->PatientID }}</td>

                    <td>{{ $patient->name }}</td>

                    <td>{{ $patient->symptoms }}</td>

                    <td>
                        {{ $patient->preliminary_diagnosis ?? '-' }}
                    </td>

                    <td>
                        <span class="badge">
                            {{ $patient->status }}
                        </span>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;">
                        No Haematology patient records found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>