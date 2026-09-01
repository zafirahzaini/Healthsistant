<!DOCTYPE html>
<html>
<head>
    <title>Cardiology Admissions</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fdf8f2;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .page-title {
            font-size: 40px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .table-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #ca8a04;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="main-container">
    @include('layouts.cardiology_sidebar')
    <div class="content">
        <h1 class="page-title">Cardiology Admissions</h1>
        <p class="page-subtitle">Currently hospitalized cardiology department cases</p>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Diagnosis</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->preliminary_diagnosis ?? '-' }}</td>
                        <td>{{ $patient->doctor_notes ?? '-' }}</td>
                        <td>
                            <span class="badge">
                                {{ $patient->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ url('/patient/discharge/' . $patient->PatientID) }}" method="POST" onsubmit="return confirm('Are you sure you want to discharge this patient?');" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 14px; cursor: pointer; font-weight: 500;">
                                    Discharge
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color: #64748b; padding: 20px;">
                            No admitted cardiology patients found.
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