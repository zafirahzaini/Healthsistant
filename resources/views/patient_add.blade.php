<!DOCTYPE html>
<html>
<head>

    <title>Add Patient - Healthsistant</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            min-height:100vh;
            background:
                linear-gradient(
                    135deg,
                    #eef5ff,
                    #f8fbff
                );
        }

        /* ================= LAYOUT ================= */

        .main-container{
            display:flex;
            min-height:100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            width:290px;
            background:linear-gradient(
                180deg,
                #1e40af,
                #1e3a8a
            );
            padding:30px 22px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            box-shadow:5px 0 25px rgba(0,0,0,0.08);
        }

        /* ================= LOGO ================= */

        .logo-section{
            margin-bottom:45px;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .logo-box{
            width:58px;
            height:58px;
            border-radius:18px;
            background:rgba(255,255,255,0.15);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:24px;
            backdrop-filter:blur(8px);
        }

        .logo h2{
            font-size:30px;
            color:white;
            font-weight:700;
        }

        .logo-sub{
            margin-top:10px;
            color:rgba(255,255,255,0.75);
            font-size:15px;
            line-height:1.7;
        }

        /* ================= MENU ================= */

        .menu{
            margin-top:40px;
        }

        .menu-title{
            font-size:13px;
            color:rgba(255,255,255,0.5);
            margin-bottom:18px;
            padding-left:12px;
            letter-spacing:1px;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:14px;
            text-decoration:none;
            color:white;
            padding:15px 18px;
            border-radius:16px;
            margin-bottom:14px;
            transition:0.3s;
            font-size:15px;
            font-weight:500;
        }

        .menu a i{
            width:20px;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.12);
            transform:translateX(4px);
        }

        .menu .active{
            background:white;
            color:#2563eb;
            font-weight:600;
        }

        /* ================= LOGOUT ================= */

        .logout-btn a{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            text-decoration:none;
            background:white;
            color:#2563eb;
            padding:15px;
            border-radius:16px;
            font-weight:600;
            transition:0.3s;
        }

        .logout-btn a:hover{
            background:#f3f4f6;
        }

        /* ================= BACKGROUND EFFECT ================= */

        body::before{
            content:"";
            position:fixed;
            top:-200px;
            right:-150px;
            width:500px;
            height:500px;
            background:rgba(37,99,235,0.08);
            border-radius:50%;
            filter:blur(40px);
            z-index:0;
        }

        body::after{
            content:"";
            position:fixed;
            bottom:-180px;
            left:-120px;
            width:450px;
            height:450px;
            background:rgba(96,165,250,0.08);
            border-radius:50%;
            filter:blur(45px);
            z-index:0;
        }

        /* ================= PAGE ================= */

        .page{
            position:relative;
            z-index:2;
            display:flex;
            justify-content:center;
            align-items:center;
            flex:1;
            padding:45px;
        }

        /* ================= CARD ================= */

        .card{
            width:98%;
            max-width:1700px;
            background:rgba(255,255,255,0.92);
            backdrop-filter:blur(12px);
            border-radius:34px;
            padding:48px;
            border:1px solid rgba(127,29,29,0.12);
            box-shadow:
                0 15px 40px rgba(0,0,0,0.06),
                0 5px 15px rgba(127,29,29,0.08);
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:"";
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:7px;
            background:linear-gradient(
                90deg,
                #2563eb,
                #60a5fa,
                #1d4ed8
            );
        }

        /* ================= HEADER ================= */

        .header{
            display:flex;
            align-items:center;
            gap:20px;
            margin-bottom:40px;
        }

        .header-icon{
            width:78px;
            height:78px;
            border-radius:24px;
            background:linear-gradient(
                135deg,
                #2563eb,
                #3b82f6
            );
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:30px;
            box-shadow:0 12px 25px rgba(127,29,29,0.22);
        }

        .header-text h1{
            font-size:48px;
            color:#111827;
            margin-bottom:10px;
            font-weight:700;
        }

        .header-text p{
            color:#6b7280;
            font-size:17px;
            line-height:1.7;
        }

        /* ================= SUCCESS / ERROR PANELS ================= */

        .success{
            background:#dcfce7;
            border:1px solid #86efac;
            color:#166534;
            padding:16px;
            border-radius:16px;
            margin-bottom:30px;
            font-size:14px;
        }

        .error-box{
            background:#fee2e2;
            color:#1d4ed8;
            padding:15px;
            border-radius:12px;
            margin-bottom:20px;
        }

        /* ================= FORM ================= */

        .form-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:24px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
        }

        .full-width{
            grid-column:span 2;
        }

        label{
            margin-bottom:10px;
            font-weight:600;
            color:#1f2937;
            font-size:15px;
        }

        /* ================= INPUT ================= */

        .input-box{
            position:relative;
        }

        .input-box i{
            position:absolute;
            top:19px;
            left:18px;
            color:#9ca3af;
            font-size:15px;
        }

        input, select, textarea{
            width:100%;
            padding:17px 18px 17px 52px;
            border:1px solid #d6d6d6;
            border-radius:18px;
            background:linear-gradient(180deg, #ffffff, #fafafa);
            font-size:15px;
            transition:0.3s;
            font-family:'Poppins',sans-serif;
            color:#111827;
        }

        textarea{
            resize:none;
            min-height:180px;
        }

        input:hover, select:hover, textarea:hover{
            border-color:#2563eb;
        }

        input:focus, select:focus, textarea:focus{
            outline:none;
            border-color:#1d4ed8;
            background:white;
            box-shadow:
                0 0 0 4px rgba(37,99,235,0.08),
                0 8px 20px rgba(37,99,235,0.05);
        }

        /* ================= BUTTON ================= */

        .btn{
            width:100%;
            padding:18px;
            border:none;
            border-radius:18px;
            background:linear-gradient(135deg, #2563eb, #3b82f6);
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
            margin-top:10px;
            font-family:'Poppins',sans-serif;
            box-shadow:0 14px 30px rgba(37,99,235,0.2);
        }

        .btn:hover{
            transform:translateY(-3px);
            box-shadow:0 20px 35px rgba(37,99,235,0.25);
        }

        /* ================= BACK ================= */

        .back{
            margin-top:28px;
            text-align:center;
        }

        .back a{
            text-decoration:none;
            color:#2563eb;
            font-weight:600;
            transition:0.3s;
        }

        .back a:hover{
            color:#3b82f6;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:900px){
            .card{ padding:32px; }
            .form-grid{ grid-template-columns:1fr; }
            .full-width{ grid-column:span 1; }
            .header{ flex-direction:column; align-items:flex-start; }
            .header-text h1{ font-size:36px; }
            .page{ padding:20px; }
        }

    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.nurse_sidebar')

    <div class="page">

        <div class="card">

            <!-- ================= HEADER ================= -->
            <div class="header">
                <div class="header-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="header-text">
                    <h1>Add Patient</h1>
                    <p>Register and manage patient healthcare information securely</p>
                </div>
            </div>

            <!-- ERRORS BOX -->
            @if ($errors->any())
                <div class="error-box">
                    <ul style="margin-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- SUCCESS PANEL -->
            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ================= FORM START ================= -->
            <form method="POST" action="/patient/add" autocomplete="off">
                @csrf

                <div class="form-grid">

                    <!-- TOP SEARCH WORKSPACE WITH LIVE DROPDOWN -->
                    <div class="form-group full-width">
                        <label>Search Existing Patient By IC / Passport Number</label>
                        <div style="position:relative; width:100%;">
                            <div style="display:flex; gap:15px; width:100%;">
                                <input
                                    type="text"
                                    id="searchIc"
                                    placeholder="Enter IC number"
                                    style="padding:17px;"
                                    autocomplete="off"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); liveSearchPatient(this.value);"
                                >
                                <button
                                    type="button"
                                    onclick="searchPatientByButton()"
                                    style="width:180px; border:none; border-radius:18px; background:#2563eb; color:white; font-weight:600; cursor:pointer;"
                                >
                                    Search Patient
                                </button>
                            </div>
                            <!-- LIVE MATCHES DROPDOWN LIST -->
                            <div id="searchResults" style="display:none; position:absolute; top:100%; left:0; right:195px; background:white; border:1px solid #d6d6d6; border-radius:14px; max-height:220px; overflow-y:auto; z-index:999; box-shadow:0 10px 25px rgba(0,0,0,0.15); margin-top:5px;"></div>
                        </div>
                        <small id="patientStatus" style="display:block; margin-top:10px; font-weight:600; color:#1d4ed8;"></small>
                    </div>

                    <!-- PATIENT NAME -->
                    <div class="form-group">
                        <label>Patient Name</label>
                        <div class="input-box">
                            <i class="fa-solid fa-user"></i>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Enter patient full name"
                                required
                                autocomplete="off"
                                style="text-transform: uppercase;"
                                oninput="this.value = this.value.toUpperCase()"
                            >
                        </div>
                    </div>

                    <!-- IC / PASSPORT NUMBER (HYPHEN BLOCKED) -->
                    <div class="form-group">
                        <label>IC / Passport Number</label>
                        <div class="input-box">
                            <i class="fa-solid fa-id-card"></i>
                            <input
                                type="text"
                                id="ic_number"
                                name="ic_number"
                                placeholder="Enter IC Or Passport Number (No hyphens/spaces)"
                                required
                                autocomplete="off"
                                onblur="searchPatient()"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')"
                            >
                        </div>
                    </div>

                    <!-- DATE OF BIRTH -->
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <div class="input-box">
                            <i class="fa-solid fa-calendar-days"></i>
                            <input
                                type="date"
                                id="date_of_birth"
                                name="date_of_birth"
                                onchange="calculateAge()"
                                required
                            >
                        </div>
                    </div>

                    <!-- AGE (READONLY AUTO-CALCULATED) -->
                    <div class="form-group">
                        <label>Age</label>
                        <div class="input-box">
                            <i class="fa-solid fa-calendar"></i>
                            <input
                                type="number"
                                id="age"
                                name="age"
                                placeholder="age"
                                readonly
                            >
                        </div>
                    </div>

                    <!-- GENDER -->
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="input-box">
                            <i class="fa-solid fa-venus-mars"></i>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- RACE -->
                    <div class="form-group">
                        <label>Race</label>
                        <div class="input-box">
                            <i class="fa-solid fa-users"></i>
                            <select id="raceSelect" name="race" onchange="switchRaceInput()" required>
                                <option value="">Select Race</option>
                                <option value="Malay">Malay</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Iban">Iban</option>
                                <option value="Kadazan">Kadazan</option>
                                <option value="Bidayuh">Bidayuh</option>
                                <option value="Orang Asli">Orang Asli</option>
                                <option value="Foreigner">Foreigner</option>
                                <option value="Other">Other</option>
                            </select>
                            <input
                                type="text"
                                id="raceInput"
                                placeholder="Enter race"
                                style="display:none; margin-top:12px;"
                            >
                        </div>
                    </div>

                    <!-- TEMPERATURE FIELD (FIXED DECIMAL STRUCTURE) -->
                    <div class="form-group">
                        <label>Temperature (°C)</label>
                        <div class="input-box">
                            <i class="fa-solid fa-temperature-half"></i>
                            <input
                                type="text"
                                inputmode="decimal"
                                name="temperature"
                                placeholder="e.g., 36.7"
                                autocomplete="off"
                                oninput="
                                    // Remove everything except numbers and a single period
                                    let val = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
                                    
                                    // Split value at decimal point to restrict length
                                    if (val.includes('.')) {
                                        let parts = val.split('.');
                                        // Max 2 digits before decimal, max 1 digit after decimal
                                        val = parts[0].slice(0, 2) + '.' + parts[1].slice(0, 1);
                                    } else {
                                        // Max 2 digits if there is no decimal point yet
                                        val = val.slice(0, 2);
                                    }
                                    this.value = val;
                                "
                            >
                        </div>
                    </div>

                    <!-- HEART RATE -->
                    <div class="form-group">
                        <label>Heart Rate (bpm)</label>
                        <div class="input-box">
                            <i class="fa-solid fa-heart-pulse"></i>
                            <input
                                type="number"
                                name="heart_rate"
                                placeholder="Enter heart rate"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- RESPIRATORY RATE -->
                    <div class="form-group">
                        <label>Respiratory Rate</label>
                        <div class="input-box">
                            <i class="fa-solid fa-lungs"></i>
                            <input
                                type="number"
                                name="respiratory_rate"
                                placeholder="Enter respiratory rate"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- SYSTOLIC BP -->
                    <div class="form-group">
                        <label>Systolic BP (SBP)</label>
                        <div class="input-box">
                            <i class="fa-solid fa-stethoscope"></i>
                            <input
                                type="number"
                                name="sbp"
                                placeholder="Enter SBP"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- DIASTOLIC BP -->
                    <div class="form-group">
                        <label>Diastolic BP (DBP)</label>
                        <div class="input-box">
                            <i class="fa-solid fa-stethoscope"></i>
                            <input
                                type="number"
                                name="dbp"
                                placeholder="Enter DBP"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- PULSE -->
                    <div class="form-group">
                        <label>Pulse</label>
                        <div class="input-box">
                            <i class="fa-solid fa-wave-square"></i>
                            <input
                                type="number"
                                name="pulse"
                                placeholder="Enter pulse"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- SYMPTOMS TEXTAREA -->
                    <div class="form-group full-width">
                        <label>Symptoms / Early Symptoms</label>
                        <div class="input-box">
                            <i class="fa-solid fa-notes-medical"></i>
                            <textarea
                                name="symptoms"
                                placeholder="Enter patient symptoms..."
                            ></textarea>
                        </div>
                    </div>

                    <!-- SUBMIT ACTIONS -->
                    <div class="full-width">
                        <button type="submit" class="btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Patient
                        </button>
                    </div>

                </div>
            </form>

            <div class="back">
                <a href="/dashboard/nurse">
                    ← Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</div>

<!-- ================= ENGINE JAVASCRIPT WORKSPACE ================= -->
<script>
let searchTimeout = null;

// ✅ LIVE FUZZY / PARTIAL SEARCH FUNCTION (DEDUPLICATED)
function liveSearchPatient(val) {
    clearTimeout(searchTimeout);
    let dropdown = document.getElementById('searchResults');
    
    if(!val || val.trim() === '') {
        dropdown.style.display = 'none';
        dropdown.innerHTML = '';
        return;
    }

    searchTimeout = setTimeout(() => {
        fetch('/patient/search/' + val)
        .then(response => response.json())
        .then(data => {
            dropdown.innerHTML = '';
            let results = [];
            
            if (Array.isArray(data)) {
                results = data;
            } else if (data && data.PatientID) {
                results = [data];
            }

            if (results.length > 0) {
                dropdown.style.display = 'block';

                // FILTER DUPLICATES: Ensure each IC/Passport appears ONLY ONCE
                let seenIc = new Set();
                let uniqueResults = results.filter(patient => {
                    let identifier = (patient.ic_number || patient.passport_number || '').replace(/[^a-zA-Z0-9]/g, '');
                    if (seenIc.has(identifier)) return false;
                    seenIc.add(identifier);
                    return true;
                });

                uniqueResults.forEach(patient => {
                    let icVal = patient.ic_number || patient.passport_number || '';
                    let item = document.createElement('div');
                    item.style.padding = '12px 18px';
                    item.style.cursor = 'pointer';
                    item.style.borderBottom = '1px solid #f0f0f0';
                    item.style.fontSize = '14px';
                    item.style.color = '#111827';

                    // Clean layout without the "Latest Record" badge
                    item.innerHTML = `<strong>${icVal}</strong> - ${patient.name}`;
                    
                    item.onmouseover = () => item.style.background = '#eef5ff';
                    item.onmouseout = () => item.style.background = 'white';
                    
                    item.onclick = () => {
                        selectPatient(patient);
                        dropdown.style.display = 'none';
                    };
                    dropdown.appendChild(item);
                });
            } else {
                dropdown.style.display = 'block';
                dropdown.innerHTML = '<div style="padding:12px 18px; color:#6b7280; font-size:14px;">No matching patient found</div>';
            }
        })
        .catch(err => console.log(err));
    }, 250);
}

// ✅ SELECT PATIENT FROM DROPDOWN AND AUTO-FILL FIELDS
function selectPatient(data) {
    if(!data) return;
    
    let icVal = data.ic_number || data.passport_number || '';
    document.getElementById('searchIc').value = icVal;
    document.getElementById('ic_number').value = icVal;
    
    document.getElementById('patientStatus').innerHTML = 'Existing patient record found and loaded successfully.';
    document.getElementById('patientStatus').style.color = '#16a34a';
    document.getElementById('name').value = data.name ?? '';
    document.getElementById('age').value = data.age ?? '';
    document.getElementById('gender').value = data.gender ?? '';
    document.getElementById('date_of_birth').value = data.date_of_birth ?? '';
    
    calculateAge();
    
    document.getElementById('name').readOnly = false;
    document.getElementById('gender').disabled = false;

    if(data.race) {
        const raceSelect = document.getElementById('raceSelect');
        raceSelect.value = data.race;
        switchRaceInput();
    }
}

function searchPatientByButton()
{
    let ic = document.getElementById('searchIc').value;
    if(ic === '') {
        alert('Please enter IC or Passport number');
        return;
    }
    document.getElementById('ic_number').value = ic;
    liveSearchPatient(ic);
}

function searchPatient()
{
    let ic = document.getElementById('ic_number').value;
    if(ic === '') {
        return;
    }

    fetch('/patient/search/' + ic)
    .then(response => response.json())
    .then(data => {
        let patient = Array.isArray(data) ? data[0] : data;
        if(patient && patient.PatientID) {
            selectPatient(patient);
        }
        else {
            document.getElementById('patientStatus').innerHTML = 'No existing record found. Please register patient information.';
            document.getElementById('patientStatus').style.color = '#2563eb';
            document.getElementById('name').value = '';
            document.getElementById('age').value = '';
            document.getElementById('date_of_birth').value = '';
            document.getElementById('name').readOnly = false;
        }
    })
    .catch(error => {
        console.log(error);
    });
}

function calculateAge()
{
    let dob = document.getElementById('date_of_birth').value;
    if(!dob) return;

    let birthDate = new Date(dob);
    let today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    let month = today.getMonth() - birthDate.getMonth();

    if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    document.getElementById('age').value = age;
}

function switchRaceInput()
{
    let raceSelect = document.getElementById('raceSelect');
    let raceInput = document.getElementById('raceInput');

    if(raceSelect.value === 'Other') {
        raceInput.style.display = 'block';
        raceInput.name = 'race';
        raceInput.required = true;
    } else {
        raceInput.style.display = 'none';
        raceInput.name = '';
        raceInput.required = false;
    }
}

// CLOSE DROPDOWN WHEN CLICKED OUTSIDE
document.addEventListener('click', function(e) {
    let dropdown = document.getElementById('searchResults');
    let searchInput = document.getElementById('searchIc');
    if (e.target !== dropdown && e.target !== searchInput) {
        if(dropdown) dropdown.style.display = 'none';
    }
});
</script>

</body>
</html>