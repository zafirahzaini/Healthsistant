<!DOCTYPE html>
<html>
<head>

<title>Run Prediction</title>
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
    background:
        linear-gradient(
            135deg,
            #fff8f8,
            #fef2f2
        );
    min-height:100vh;
    color:#111827;
}

.main-container{
    display:flex;
    min-height:100vh;
}

.content{
    flex:1;
    padding:40px;
    background:
        radial-gradient(circle at top right,
        rgba(127,29,29,0.08),
        transparent 30%);
}

.upload-card{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-top:20px;
}

input[type="file"]{
    width:100%;
    padding:15px;
    border:1px solid #d1d5db;
    border-radius:14px;
    background:white;
    font-family:'Poppins',sans-serif;
}

.upload-btn{
    background:linear-gradient(
        135deg,
        #7f1d1d,
        #991b1b
    );
    color:white;
    border:none;
    padding:15px 30px;
    border-radius:14px;
    cursor:pointer;
    font-size:15px;
    font-weight:600;
    transition:.3s;
}

.upload-btn:hover{
    transform:translateY(-2px);
}

h1{
    color:#111827;
    font-size:40px;
    font-weight:700;
    margin-bottom:10px;
}

.subtitle{
    color:#6b7280;
    font-size:20px;
    margin-bottom:35px;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    background:white;
    border-radius:20px;
    padding:25px;
}

.stat-card h2{
    color:#991b1b;
    font-size:42px;
    margin-bottom:10px;
}

.stat-card p{
    color:#6b7280;
    font-size:15px;
}

.stat-icon{
    font-size:40px;
    color:#991b1b;
    margin-bottom:15px;
}

.stat-card h3{
    font-size:20px;
    margin-bottom:10px;
    color:#111827;
}

.stat-card p{
    color:#6b7280;
    font-size:15px;
    line-height:1.6;
}

.process-card{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-top:20px;
}

.process-title{
    font-size:24px;
    font-weight:600;
    margin-bottom:20px;
}

.steps{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

.step{
    background:#fef2f2;
    color:#991b1b;
    padding:15px 25px;
    border-radius:12px;
    font-weight:600;
}

.arrow{
    font-size:28px;
    color:#991b1b;
}

.dataset-note{
    background:#fef2f2;
    border-left:5px solid #991b1b;
    padding:20px;
    border-radius:12px;
    margin-bottom:25px;
}

.dataset-note h4{
    color:#991b1b;
    margin-bottom:10px;
}

.dataset-note p{
    color:#6b7280;
    margin-bottom:10px;
}

.dataset-note ul{
    margin-left:20px;
    margin-bottom:15px;
    color:#374151;
}

.error-box{
    background:#fee2e2;
    color:#991b1b;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
    font-weight:600;
}

.custom-upload{
    margin-bottom:20px;
}

.upload-label{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    gap:15px;
    min-height:180px;
    border:3px dashed #dc2626;
    border-radius:20px;
    background:
    linear-gradient(
        135deg,
        #fff5f5,
        #fef2f2
    );
    cursor:pointer;
    transition:.3s;
}

.upload-label:hover{
    background:#fee2e2;
    transform:translateY(-2px);
}

.upload-label i{
    font-size:50px;
}

#dataset{
    display:none;
}

</style>

</head>

<body>

<div class="main-container">

@include('layouts.admin_sidebar')

<div class="content">

<div class="container">

    <h1>
        Disease Trend Prediction & Analytics
    </h1>

    <div class="subtitle">
        Upload CSV dataset to generate analytics
    </div>

   <div class="stats-grid">

    <div class="stat-card">
        <i class="fa-solid fa-file-csv stat-icon"></i>
        <h3>Accepted Format</h3>
        <p>
            CSV Dataset (.csv)
        </p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-table-columns stat-icon"></i>
        <h3>Required Columns</h3>
        <p>
            13 Required Fields
        </p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-chart-column stat-icon"></i>
        <h3>Analytics</h3>
        <p>
            Disease Trends & Distribution
        </p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-file-waveform stat-icon"></i>
        <h3>Generated Reports</h3>

        <p>
            Charts, Statistics & Insights
        </p>
    </div>

</div>

<div class="upload-card">

<h3 style="
margin-bottom:20px;
font-size:24px;
font-weight:600;
">
Upload Dataset
</h3>

<div class="dataset-note">

    <h4>Dataset Requirements</h4>

    <p>
        Upload CSV file containing hospital patient records.
    </p>

    <ul>
        <li>temperature</li>
        <li>heartrate</li>
        <li>resprate</li>
        <li>o2sat</li>
        <li>sbp</li>
        <li>dbp</li>
        <li>pain</li>
        <li>acuity</li>
        <li>chiefcomplaint</li>
        <li>gender</li>
        <li>race</li>
        <li>disposition</li>
        <li>icd_title</li>
    </ul>

    <p>
        Accepted format:
        <strong>.csv</strong>
    </p>

</div>

@if(session('error'))

<div class="error-box">
    {{ session('error') }}
</div>

@endif

<form
method="POST"
action="{{ url('/prediction/upload') }}"
enctype="multipart/form-data">

@csrf

<div class="custom-upload">

    <label for="dataset" class="upload-label">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <span id="file-name">
            Click or Drag CSV Dataset Here
        </span>

<small style="
color:#6b7280;
font-size:14px;
">

Maximum file size: 20MB

</small>

    </label>

    <input
        type="file"
        id="dataset"
        name="dataset"
        accept=".csv"
        required>

</div>

<br><br>

<button
type="submit"
class="upload-btn">

Generate Analytics

</button>

</form>

</div>

<div class="process-card">

    <div class="process-title">
        Prediction Workflow
    </div>

    <div class="steps">

        <div class="step">
            Upload Dataset
        </div>

        <div class="arrow">→</div>

        <div class="step">
            Process Data
        </div>

        <div class="arrow">→</div>

        <div class="step">
            Generate Analytics
        </div>

        <div class="arrow">→</div>

        <div class="step">
            Prediction Results
        </div>

    </div>

</div>

</div>

</div>

<script>
document.getElementById('dataset')
.addEventListener('change', function(){

    let fileName =
    this.files.length
    ? this.files[0].name
    : 'Choose CSV Dataset';

    document.getElementById('file-name')
    .innerText = fileName;

});
</script>

</body>
</html>