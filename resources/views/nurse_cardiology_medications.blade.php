<!DOCTYPE html>
<html>
<head>

<title>Medication Records</title>

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
    background:#fefbf3;
}

.main-container{
    display:flex;
}

.content{
    flex:1;
    padding:40px;
}

.page-title{
    font-size:40px;
    font-weight:700;
    color:#92400e;
}

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-top:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

input,select,textarea{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
}

.btn{
    background:#f59e0b;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
}

.alert{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    margin-bottom:20px;
    border-radius:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f59e0b;
    color:white;
    padding:14px;
    text-align:left;
}

td{
    padding:14px;
    border-bottom:1px solid #eee;
}

</style>

</head>

<body>

<div class="main-container">

@include('layouts.nurse_cardiology_sidebar')

<div class="content">

<h1 class="page-title">
Medication Records
</h1>

<div class="card">

@if(session('success'))
<div class="alert">
{{ session('success') }}
</div>
@endif

<form method="POST">

@csrf

<div class="row">

<div class="form-group">
<label>Patient</label>

<select name="patient_id">

@foreach($patients as $patient)

<option value="{{ $patient->PatientID }}">
{{ $patient->name }}
</option>

@endforeach

</select>
</div>

<div class="form-group">
<label>Medication Name</label>

<input
type="text"
name="medication_name">
</div>

<div class="form-group">
<label>Dosage</label>

<input
type="text"
name="dosage">
</div>

<div class="form-group">
<label>Administration Time</label>

<input
type="datetime-local"
name="administration_time">
</div>

</div>

<div class="form-group">

<label>Remarks</label>

<textarea
rows="3"
name="remarks"></textarea>

</div>

<button class="btn">
Save Record
</button>

</form>

</div>

<div class="card">

<h2 style="margin-bottom:20px;">
Medication History
</h2>

<table>

<tr>
<th>Patient</th>
<th>Medication</th>
<th>Dosage</th>
<th>Time</th>
</tr>

@foreach($records as $record)

<tr>

<td>{{ $record->name }}</td>

<td>{{ $record->medication_name }}</td>

<td>{{ $record->dosage }}</td>

<td>{{ $record->administration_time }}</td>

</tr>

@endforeach

</table>

</div>

</div>

</div>

</body>
</html>