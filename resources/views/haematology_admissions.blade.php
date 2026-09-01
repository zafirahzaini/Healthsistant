<!DOCTYPE html>
<html>

<head>

    <title>Haematology Admissions</title>

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

        .page-title{
            font-size:40px;
            font-weight:700;
            color:#0f172a;
            margin-bottom:10px;
        }

        .page-subtitle{
            color:#64748b;
            font-size:20px;
            margin-bottom:30px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:30px;
        }

        .stat-card{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
            border-top:5px solid #db2777;
        }

        .stat-number{
            font-size:40px;
            font-weight:700;
            color:#9d174d;
        }

        .stat-label{
            margin-top:8px;
            color:#64748b;
        }

        .table-card{
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
            background:#db2777;
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
            padding:6px 14px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.haematology_sidebar')

    <div class="content">

        <h1 class="page-title">
            Admissions
        </h1>

        <p class="page-subtitle">
            Patients admitted under Haematology Department
        </p>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-number">
                    {{ $patients->count() }}
                </div>

                <div class="stat-label">
                    Total Admissions
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

            <div class="stat-card">
                <div class="stat-number">
                    CCU
                </div>

                <div class="stat-label">
                    Haematology Ward
                </div>
            </div>

        </div>

        <div class="table-card">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Diagnosis</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Action</th> </tr>
                </thead>

                <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->preliminary_diagnosis ?? '-' }}</td>
                        <td>{{ $patient->doctor_notes ?? '-' }}</td>
                        <td>
                            <span class="badge" style="background: #e0f2fe; color: #0369a1;">
                                {{ $patient->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ url('/patient/discharge/' . $patient->PatientID) }}" method="POST" onsubmit="return confirm('Are you sure you want to discharge this patient?');" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-primary" style="background: #dc2626; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 14px; cursor: pointer; font-weight: 500;">
                                    Discharge
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">
                            No admitted haematology patients found.
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