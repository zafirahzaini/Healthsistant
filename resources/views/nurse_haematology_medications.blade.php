<!DOCTYPE html>
<html>
<head>
    <title>Medication Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #faf5ff;
            min-height: 100vh;
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
            color: #86198f;
        }

        /* Matches the dashboard subtitle color and size perfectly */
        .page-subtitle {
            color: #78716c; 
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 30px;
            font-weight: 400;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(134, 25, 143, 0.03);
            border: 1px solid rgba(243, 232, 255, 0.7);
            border-top: 4px solid #c026d3;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #86198f;
            margin-bottom: 8px;
        }

        select, input, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            color: #1e293b;
            background-color: #fff;
            outline: none;
            transition: border-color 0.2s;
        }

        select:focus, input:focus, textarea:focus {
            border-color: #c026d3;
            box-shadow: 0 0 0 3px rgba(192, 38, 211, 0.05);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Theme matching button styling */
        .btn-submit {
            background: #c026d3;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(192, 38, 211, 0.1);
        }

        .btn-submit:hover {
            background: #86198f;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(134, 25, 143, 0.2);
        }
    </style>
</head>
<body>

<div class="main-container">

    @include('layouts.nurse_haematology_sidebar')

    <div class="content">

        <h1 class="page-title">Medication Records</h1>
        <p class="page-subtitle">Log and manage patient medical administrations</p>

        <div class="card">
            <form action="/nurse-haematology/medications/save" method="POST">
                @csrf

                <div class="form-group">
                    <label for="patient_id">Patient Selection</label>
                    <select name="patient_id" id="patient_id">
                        <option value="">-- Choose Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->PatientID }}" {{ request('patient_id') == $patient->PatientID ? 'selected' : '' }}>
                                #{{ $patient->PatientID }} - {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="medication_name">Medication Name</label>
                        <input type="text" id="medication_name" name="medication_name" placeholder="e.g., Hydroxyurea">
                    </div>

                    <div class="form-group">
                        <label for="dosage">Dosage</label>
                        <input type="text" id="dosage" name="dosage" placeholder="e.g., 500mg">
                    </div>
                </div>

                <div class="form-group">
                    <label for="administration_time">Administration Time</label>
                    <input type="datetime-local" id="administration_time" name="administration_time">
                </div>

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks" placeholder="Enter clinical observation notes..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Save Record</button>
            </form>
        </div>

    </div>

</div>

</body>
</html>