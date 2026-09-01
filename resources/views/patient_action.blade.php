<!DOCTYPE html>
<html>
<head>

    <title>Patient Action</title>

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
            background:#f5f7fa;
            margin:0;
        }

        .main-container{
            display:flex;
            min-height:100vh;
            background:#f5f7fa;
        }

        .content{
            flex:1;
            padding:35px;
            background:#f5f7fa;
        }

        .container{
            width:100%;
        }

        .card{
            background:white;
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
        }

        .main-container{
            display:flex;
            min-height:100vh;
        }

        .content{
            flex:1;
            padding:35px;
        }

        h1{
            margin-bottom:35px;
            color:#111827;
            font-size:48px;
            font-weight:700;
        }

        .section-title{
            font-size:26px;
            margin-bottom:25px;
            color:#166534;
            font-weight:700;
        }

        .summary-row{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:35px;
        }

        .summary-card{
            background:#f0fdf4;
            border-left:5px solid #16a34a;
            padding:20px;
            border-radius:15px;
        }

        .summary-card small{
            color:#6b7280;
        }

        .summary-card h3{
            margin-top:8px;
            color:#166534;
        }

        .grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:25px;
        }

        .field{
            background:#f9fafb;
            padding:22px;
            border-radius:18px;
        }

        .label{
            font-size:13px;
            color:#6b7280;
            margin-bottom:10px;
        }

        .value{
            font-size:20px;
            color:#111827;
            font-weight:600;
        }

        .doctor-section{
            margin-top:50px;
            background:#f0fdf4;
            padding:35px;
            border-radius:25px;
            border:1px solid #bbf7d0;
        }

        .form-group{
            margin-bottom:25px;
        }

        .form-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
            color:#166534;
            font-size:15px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea{
            width:100%;
            padding:16px;
            border-radius:16px;
            border:1px solid #e5e7eb;
            font-family:'Poppins',sans-serif;
            font-size:15px;
            outline:none;
            background:white;
        }
        .form-group textarea{
            resize:none;
        }
        .button-group{
            margin-top:35px;
        }
        .btn{
            border:none;
            padding:15px 30px;
            border-radius:14px;
            color:white;
            font-weight:600;
            cursor:pointer;
            font-size:15px;
            background:linear-gradient(135deg,#15803d,#16a34a);
        }

        .card{
            background:white;
            border-radius:25px;
            padding:35px;
            width:100%;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }

    </style>
</head>

<body>
<div class="main-container">
    @include('layouts.doctor_sidebar')
    <div class="content">
        <div class="container">
    <div class="card">
        <h1>Patient Assessment</h1>
        <div class="summary-row">

    <div class="summary-card">
        <small>Patient ID</small>
        <h3>{{ $patient->PatientID }}</h3>
    </div>

    <div class="summary-card">
        <small>Status</small>
        <h3>{{ $patient->status }}</h3>
    </div>

    <div class="summary-card">
        <small>Age</small>
        <h3>{{ $patient->age }}</h3>
    </div>

    <div class="summary-card">
        <small>Gender</small>
        <h3>{{ $patient->gender }}</h3>
    </div>

</div>
        <h2 class="section-title">
            Patient Information
        </h2>
        <div class="grid">

            <div class="field">
                <div class="label">Patient Name</div>
                <div class="value">{{ $patient->name }}</div>
            </div>
            <div class="field">
                <div class="label">IC Number</div>
                <div class="value">{{ $patient->ic_number }}</div>
            </div>
            <div class="field">
                <div class="label">Age</div>
                <div class="value">{{ $patient->age }}</div>
            </div>
            <div class="field">
                <div class="label">Gender</div>
                <div class="value">{{ $patient->gender }}</div>
            </div>
            <div class="field">
                <div class="label">Race</div>
                <div class="value">{{ $patient->race }}</div>
            </div>
            <div class="field">
                <div class="label">Pulse</div>
                <div class="value">{{ $patient->pulse }}</div>
            </div>
            <div class="field">
                <div class="label">Temperature</div>
                <div class="value">{{ $patient->temperature }} °C</div>
            </div>
            <div class="field">
                <div class="label">Heart Rate</div>
                <div class="value">{{ $patient->heart_rate }}</div>
            </div>
            <div class="field">
                <div class="label">Respiratory Rate</div>
                <div class="value">{{ $patient->respiratory_rate }}</div>
            </div>
            <div class="field">
                <div class="label">Blood Pressure</div>
                <div class="value">
                    {{ $patient->sbp }}/{{ $patient->dbp }}
                </div>
            </div>
            <div class="field" style="grid-column:1/3;">
                <div class="label">Symptoms</div>
                <div class="value">{{ $patient->symptoms }}</div>
            </div>
        </div>

        <form method="POST" action="/patient/update/{{ $patient->PatientID }}">

            @csrf

            <div class="doctor-section">
                <h2 class="section-title">
                    Doctor Assessment
                </h2>
                <div class="form-group">
                    <label>Preliminary Diagnosis</label>
                    <input
                        type="text"
                        name="preliminary_diagnosis"
                        placeholder="Enter preliminary diagnosis"
                    >
                </div>

                <div class="form-group">
                    <label>Doctor Notes</label>
                    <textarea
                        name="doctor_notes"
                        rows="5"
                        placeholder="Write doctor notes here"
                    ></textarea>
                </div>

                <div class="form-group">
                <label>Clinical Decision</label>
                <select
                    name="decision"
                    id="decision"
                    onchange="toggleSections()"
                    required
                >
                    <option value="">
                        Select 
                    </option>
                    <option value="Discharge">
                        Discharge Patient
                    </option>
                    <option value="Refer To Specialist">
                        Refer To Specialist
                    </option>
                </select>
            </div>

            <!-- Specialist Department -->
            <div id="departmentBox" style="display:none;">
                <div class="form-group">
                    <label>Specialist Department</label>
                    <select
                        name="specialist_department"
                        id="department"
                        onchange="loadDoctors()"
                    >
                        <option value="">
                            Select Department
                        </option>
                        <option value="Cardiology">
                            Cardiology
                        </option>
                        <option value="Haematology">
                            Haematology
                        </option>
                    </select>

    
                </div>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        class="btn"
                    >
                        Save Assessment
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
<script>

function toggleSections()
{
    let decision =
        document.getElementById('decision').value;
    let departmentBox =
        document.getElementById('departmentBox');
    departmentBox.style.display = 'none';
    if(decision === 'Refer To Specialist')
{
    departmentBox.style.display = 'block';
}
}

</script>

<script>

function loadDoctors()
{
    let department =
        document.getElementById('department').value;

    if(department == '')
    {
        return;
    }
    fetch('/available-specialists/' + department)
    .then(response => response.json())
    .then(data => {
        let doctorSelect =
            document.getElementById(
                'specialistDoctor'
            );
        doctorSelect.innerHTML =
            '<option value="">Select Doctor</option>';
        data.forEach(function(doctor){
            doctorSelect.innerHTML +=
                `<option value="${doctor.userID}">
                    ${doctor.name} (Queue: ${doctor.workload})
                </option>
        });

        document.getElementById(
            'doctorBox'
        ).style.display = 'block';
    });
}

        </script>
        </div>
    </div>
</div>
</body>
</html>