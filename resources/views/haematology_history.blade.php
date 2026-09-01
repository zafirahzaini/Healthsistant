<!DOCTYPE html>
<html>

<head>

    <title>Haematology Assessment History</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#fdf2f8;
        }

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

        .page-title{
            font-size:40px;
            font-weight:700;
            color:#0f172a;
        }

        .page-subtitle{
            color:#64748b;
            margin-top:10px;
            font-size:20px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:25px;
            margin-bottom:30px;
        }

        .stat-card{
            background:white;
            border-top:5px solid #be185d;
            border-radius:20px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        .stat-number{
            font-size:42px;
            font-weight:700;
            color:#9d174d;
        }

        .stat-label{
            margin-top:10px;
            color:#64748b;
            font-size:15px;
        }

        .history-card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        .section-title{
            font-size:26px;
            font-weight:600;
            margin-bottom:20px;
            color:#0f172a;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#be185d;
        }

        th{
            color:white;
            padding:16px;
            text-align:left;
            font-size:15px;
        }

        td{
            padding:16px;
            border-bottom:1px solid #e5e7eb;
            color:#334155;
        }

        .badge{
            background:#dcfce7;
            color:#15803d;
            padding:8px 14px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

        .empty-state{
            text-align:center;
            padding:40px;
            color:#94a3b8;
        }

        .view-btn{
            display:inline-flex;
            align-items:center;
            gap:8px;
            background:#ec4899;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:600;
            transition:.3s;
        }

        .view-btn:hover{
            background:#b45309;
            transform:translateY(-2px);
        }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.haematology_sidebar')

    <div class="content">

        <div class="page-header">

            <h1 class="page-title">
                Assessment History
            </h1>

            <p class="page-subtitle">
                View completed haematology assessments and specialist findings
            </p>

        </div>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-number">
                    {{ $patients->count() }}
                </div>

                <div class="stat-label">
                    Completed Assessments
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ $patients->count() }}
                </div>

                <div class="stat-label">
                    Total Cases Reviewed
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ date('Y') }}
                </div>

                <div class="stat-label">
                    Current Year
                </div>
            </div>

        </div>

        <div class="history-card">

            <h2 class="section-title">
                Completed Cases
            </h2>

            <table>

                <thead>

                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Assessment Date</th>
                    <th>Symptoms</th>
                    <th>Final Diagnosis</th>
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
                            {{ $patient->assessment_time ? date('d/m/Y H:i', strtotime($patient->assessment_time)) : 'Not Recorded' }}
                        </td>
                        <td>{{ $patient->symptoms }}</td>
                        <td>{{ $patient->preliminary_diagnosis }}</td>
                        <td>
                            <span class="badge">
                                Completed
                            </span>
                        </td>

<td>
    <a href="{{ route('haematology.history.details', $patient->PatientID) }}"
   class="view-btn">
    <i class="fas fa-eye"></i>
    View Details
</a>
</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                No completed haematology assessments available.
                            </div>
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