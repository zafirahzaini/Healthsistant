<!DOCTYPE html>
<html>
<head>
    <title>Vital Signs Monitoring</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fefbf3;
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
            color: #92400e;
        }

        .page-subtitle {
            color: #92400e;
            margin-top: 5px;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #f59e0b;
            margin-top: 25px;
        }

        .mortality-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.05);
            border: 1px solid #fee2e2;
            border-top: 5px solid #ef4444;
            margin-top: 35px;
        }

        .patient-box {
            background: #fffbe2;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .patient-box h4 {
            color: #92400e;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .patient-box p {
            color: #b45309;
            font-size: 15px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 15px;
            color: #92400e;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #fde68a;
            border-radius: 10px;
            font-size: 16px;
            color: #1e293b;
            background: #fdfdfe;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #f59e0b;
            outline: none;
            background: white;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }

        .mortality-card .form-group label {
            color: #991b1b;
        }

        .mortality-card .form-group input {
            border-color: #fecdd3;
        }

        .mortality-card .form-group input:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        .scenario-selector {
            display: flex;
            gap: 20px;
            margin-top: 8px;
            background: #fff5f5;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px dashed #fca5a5;
        }

        .scenario-selector label {
            font-weight: 500 !important;
            color: #7f1d1d !important;
            cursor: pointer;
            margin-bottom: 0 !important;
        }

        .btn-container {
            display: flex;
            gap: 15px;
        }

        .btn {
            background: #f59e0b;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #d97706;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="main-container">
    @include('layouts.nurse_cardiology_sidebar')

    <div class="content">
        <h1 class="page-title">Vital Signs & Ward Assignment</h1>
        <p class="page-subtitle">Record active clinical baseline vitals and ward placement</p>

        <div class="card">
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="patient-box">
                <h4>Patient: {{ $patient->name }}</h4>
                <p>Patient ID: #{{ $patient->PatientID }} | Current Ward: {{ $patient->admission_ward ?? 'Unassigned' }} | Bed: {{ $patient->bed_number ?? 'Unassigned' }}</p>
            </div>

            <form action="" method="POST">
                @csrf
                
                <div class="form-grid">
                    <!-- Ward & Bed Details -->
                    <div class="form-group">
                        <label>Admission Ward</label>
                        <input type="text" name="admission_ward" value="{{ $patient->admission_ward ?? '' }}" placeholder="e.g. Ward 4B">
                    </div>

                    <div class="form-group">
                        <label>Bed Number</label>
                        <input type="text" name="bed_number" value="{{ $patient->bed_number ?? '' }}" placeholder="e.g. Bed 12">
                    </div>

                    <!-- Vital Signs -->
                    <div class="form-group">
                        <label>Temperature (°C)</label>
                        <input type="text" name="temperature" value="{{ $patient->temperature }}">
                    </div>

                    <div class="form-group">
                        <label>Heart Rate (BPM)</label>
                        <input type="text" name="heart_rate" value="{{ $patient->heart_rate }}">
                    </div>

                    <div class="form-group">
                        <label>Respiratory Rate (RPM)</label>
                        <input type="text" name="respiratory_rate" value="{{ $patient->respiratory_rate }}">
                    </div>

                    <div class="form-group">
                        <label>Pulse Tracker</label>
                        <input type="text" name="pulse" value="{{ $patient->pulse }}">
                    </div>

                    <div class="form-group">
                        <label>Systolic Blood Pressure (mmHg)</label>
                        <input type="text" name="sbp" value="{{ $patient->sbp }}">
                    </div>

                    <div class="form-group">
                        <label>Diastolic Blood Pressure (mmHg)</label>
                        <input type="text" name="dbp" value="{{ $patient->dbp }}">
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn">
                        Save Vitals & Ward Details
                    </button>
                    <a href="/nurse-cardiology/ward-patients" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- In-Hospital Mortality Section -->
        <div class="mortality-card">
            <h3 style="color: #991b1b; font-size: 22px; margin-bottom: 8px;">Log Patient Mortality</h3>
            <p style="color: #b91c1c; font-size: 14px; margin-bottom: 25px;">Use this section only to record an in-hospital death event. Confirming will clear the bed and archive the record.</p>
            
            <form action="/patient/{{ $patient->PatientID }}/mark-deceased" method="POST">
                @csrf
                
                <div class="form-group" style="margin-bottom: 25px;">
                    <label>Mortality Scenario Type</label>
                    <div class="scenario-selector">
                        <label>
                            <input type="radio" name="death_type" value="Sudden" required onclick="toggleCardiologyScenario('Sudden')"> 
                            <strong>Sudden / Unexpected</strong> (Code Blue / Sudden Arrest)
                        </label>
                        <label>
                            <input type="radio" name="death_type" value="Expected" required onclick="toggleCardiologyScenario('Expected')"> 
                            <strong>Terminal / Expected</strong> (Palliative / Vital Decline)
                        </label>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Date & Time of Death</label>
                        <input type="datetime-local" name="time_of_death" required>
                    </div>

                    <div class="form-group">
                        <label>Declaring Medical Officer</label>
                        <input type="text" name="declared_by" placeholder="e.g. Dr. Sarah" required>
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Primary Cause of Death</label>
                        <input type="text" name="cause_of_death" id="cardio_cause_input" placeholder="Select scenario type above..." required>
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Mortality Notes (Optional)</label>
                        <input type="text" name="mortality_notes" placeholder="Enter clinical details or final observations...">
                    </div>
                </div>

                <p id="cardio_expected_note" style="display:none; color: #0284c7; font-size: 13px; margin-bottom: 15px;">
                    ℹ️ Last recorded baseline vitals will be archived into the final patient mortality summary.
                </p>

                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to log mortality for {{ $patient->name }}? This will set status to Deceased and release Ward {{ $patient->admission_ward }} / Bed {{ $patient->bed_number }}.')">
                    Confirm Death Record
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleCardiologyScenario(type) {
    const causeInput = document.getElementById('cardio_cause_input');
    const note = document.getElementById('cardio_expected_note');
    
    if (type === 'Sudden') {
        causeInput.placeholder = 'e.g., Acute Cardiac Arrest / Unresponsive to Resuscitation';
        note.style.display = 'none';
    } else {
        causeInput.placeholder = 'e.g., End-Stage Respiratory Failure / Multi-Organ Failure';
        note.style.display = 'block';
    }
}
</script>

</body>
</html>