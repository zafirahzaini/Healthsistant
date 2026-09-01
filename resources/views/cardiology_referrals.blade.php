<!DOCTYPE html>
<html>
<head>
    <title>Cardiology Referrals</title>
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
        }

        .page-subtitle {
            font-size: 20px;
            color: #64748b;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #ca8a04;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            background: #fef9c3;
            color: #a16207;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }

        .action-btn {
            background: #ca8a04;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: inline-block;
            transition: background 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #a16207;
        }
    </style>
</head>
<body>
<div class="main-container">
    @include('layouts.cardiology_sidebar')
    <div class="content">
        <h1 class="page-title">Cardiology Referrals</h1>
        <p class="page-subtitle">Patients referred to Cardiology Department</p>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Symptoms</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->symptoms }}</td>
                        <td>
                            <span class="badge">
                                {{ $patient->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('cardiology.history.details', $patient->PatientID) }}" class="action-btn">
                                Review
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #64748b; padding: 30px;">
                            No pending referrals found.
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