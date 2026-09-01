<!DOCTYPE html>
<html>
<head>

<title>Patient Journey Tracker</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

* {
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body {
    margin:0;
    font-family:'Poppins',sans-serif;
    background:
        linear-gradient(
            135deg,
            #fff8f8,
            #fef2f2
        );
}

.layout {
    display:flex;
    min-height:100vh;
}

.main {
    flex:1;
    padding:40px;
    margin-left:0;
}

.header {
    margin-bottom:30px;
}

.header h1 {
    font-size:42px;
}

.stats {
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:20px;
    margin-bottom:40px;
}

.card {
    background:white;
    padding:30px;
    border-radius:24px;
    box-shadow:0 10px 40px rgba(0,0,0,0.05);
}

.card h2 {
    font-size:40px;
    color:#7f1d1d;
    margin-bottom:10px;
}

.card p {
    color:#6b7280;
    font-size:16px;
}

.patient-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
    gap:30px;
}

.patient-card {
    background:white;
    border-radius:24px;
    padding:30px;
    box-shadow:0 10px 40px rgba(0,0,0,0.05);
    position:relative;
    border:1px solid transparent;
    transition:0.3s;
}

.patient-card:hover {
    transform:translateY(-5px);
    border-color:#fca5a5;
}

.status-badge {
    position:absolute;
    top:30px;
    right:30px;
    padding:6px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}

.status-waiting { background:#fee2e2; color:#991b1b; }
.status-referred { background:#fef3c7; color:#92400e; }
.status-admitted { background:#dcfce7; color:#166534; }
.status-discharged { background:#f3f4f6; color:#374151; }
.status-deceased { background:#1f2937; color:#ffffff; }

.patient-card h3 {
    font-size:22px;
    color:#111827;
    margin-bottom:20px;
    margin-top:10px;
    max-width:65%;
}

.info-item {
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #f3f4f6;
    font-size:15px;
}

.info-item:last-of-type {
    border-bottom:none;
}

.info-label {
    color:#6b7280;
}

.info-value {
    color:#111827;
    font-weight:500;
}

.btn {
    display:inline-block;
    background:#7f1d1d;
    color:white;
    padding:12px 24px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    font-size:15px;
    transition:0.3s;
}

.btn:hover {
    background:#991b1b;
}

/* ================= FILTER & CONTROLS ALIGNMENT ================= */
.header-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
    gap: 20px;
    flex-wrap: wrap;
}

.controls-wrapper {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 5px;
}

.search-container {
    position: relative;
    width: 320px;
}

.search-container i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 16px;
}

.search-input {
    width: 100%;
    padding: 14px 16px 14px 48px;
    border-radius: 14px;
    border: 1px solid #fee2e2;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #111827;
    outline: none;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    transition: all 0.2s ease;
}

.search-input:focus {
    border-color: #7f1d1d;
    box-shadow: 0 4px 14px rgba(127, 29, 29, 0.1);
}

/* Dropdown Filter Element */
.filter-dropdown {
    padding: 14px 20px;
    border-radius: 14px;
    border: 1px solid #fee2e2;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #111827;
    background-color: white;
    outline: none;
    cursor: pointer;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    transition: all 0.2s ease;
}

.filter-dropdown:focus {
    border-color: #7f1d1d;
}

.no-data-card {
    grid-column: 1 / -1;
    background: white;
    border: 2px dashed #fca5a5;
    border-radius: 24px;
    padding: 60px 40px;
    text-align: center;
    color: #6b7280;
    display: none;
}

.no-data-card i {
    font-size: 48px;
    color: #ef4444;
    margin-bottom: 15px;
}

.no-data-card h3 {
    font-size: 20px;
    color: #111827;
    margin-bottom: 6px;
}

</style>
</head>
<body>

<div class="layout">
    @include('layouts.admin_sidebar')
    
    <div class="main">
        
        <div class="header-wrapper">
            <div class="header" style="margin-bottom: 0;">
                <h1>
                    <i class="fa-solid fa-route" style="color:#7f1d1d; margin-right:10px;"></i>
                    Patient Journey Tracker
                </h1>
                <p style="color:#6b7280; font-size:18px; margin-top:5px;">
                    Monitor patient movement throughout the hospital
                </p>
            </div>
            
            <div class="controls-wrapper">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="patientSearch" class="search-input" placeholder="Search Name, IC or Passport...">
                </div>

                <select id="statusFilter" class="filter-dropdown">
                    <option value="all">All Statuses</option>
                    <option value="waiting">Waiting</option>
                    <option value="referred">Referred</option>
                    <option value="admitted">Admitted</option>
                    <option value="discharged">Discharged</option>
                    <option value="deceased">Deceased</option>
                </select>
            </div>
        </div>

        <div class="stats">
            <div class="card">
                <h2>{{ $patients->count() }}</h2>
                <p>Total Patients</p>
            </div>
            <div class="card">
                <h2>{{ $patients->where('status','Waiting')->count() }}</h2>
                <p>Waiting</p>
            </div>
            <div class="card">
                <h2>{{ $patients->where('status','Admitted')->count() }}</h2>
                <p>Admitted</p>
            </div>
            <div class="card">
                <h2>{{ $patients->where('status','Discharged')->count() }}</h2>
                <p>Discharged</p>
            </div>
            <div class="card">
                <h2>{{ $patients->where('status','Deceased')->count() }}</h2>
                <p>Deceased</p>
            </div>
        </div>

        <div class="patient-grid" id="patientGrid">
            @foreach($patients as $patient)
                <div class="patient-card" 
                     data-search="{{ strtolower($patient->name) }} {{ strtolower($patient->ic_number ?? '') }} {{ strtolower($patient->passport_number ?? '') }}"
                     data-status="{{ strtolower($patient->status) }}">
                    
                    <span class="status-badge 
                        @if($patient->status == 'Waiting') status-waiting
                        @elseif($patient->status == 'Referred') status-referred
                        @elseif($patient->status == 'Admitted') status-admitted
                        @elseif($patient->status == 'Deceased') status-deceased
                        @else status-discharged
                        @endif">
                        {{ $patient->status }}
                    </span>

                    <h3>{{ $patient->name }}</h3>

                    <div class="info-item">
                        <div class="info-label">Patient ID:</div>
                        <div class="info-value">#{{ $patient->PatientID }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Registered:</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y h:i A') }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Last Update:</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($patient->updated_at)->diffForHumans() }}</div>
                    </div>

                    <div style="margin-top:20px; text-align:right;">
                        <a href="{{ url('/admin/journey/'.$patient->PatientID) }}" class="btn">
                            Track Journey <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="no-data-card" id="noDataMessage">
                <i class="fa-solid fa-circle-exclamation"></i>
                <h3>No Data Found</h3>
                <p>We couldn't find any records matching your search queries or category filters.</p>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('patientSearch');
    const statusFilter = document.getElementById('statusFilter');
    const patientCards = document.querySelectorAll('.patient-card');
    const noDataMessage = document.getElementById('noDataMessage');

    function filterRegistry() {
        const textQuery = searchInput.value.toLowerCase().trim();
        const statusQuery = statusFilter.value;
        let visibleCount = 0;

        patientCards.forEach(card => {
            const searchData = card.getAttribute('data-search');
            const cardStatus = card.getAttribute('data-status');

            // Evaluate text parameters
            const matchesText = searchData.includes(textQuery);
            // Evaluate dropdown parameter selection
            const matchesStatus = (statusQuery === 'all' || cardStatus === statusQuery);

            if (matchesText && matchesStatus) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Toggle error card if no data stays visible
        if (visibleCount === 0) {
            noDataMessage.style.display = 'block';
        } else {
            noDataMessage.style.display = 'none';
        }
    }

    // Attach uniform event listeners to manage real-time updates instantly
    searchInput.addEventListener('input', filterRegistry);
    statusFilter.addEventListener('change', filterRegistry);
});
</script>

</body>
</html>