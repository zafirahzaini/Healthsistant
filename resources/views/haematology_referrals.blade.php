<!DOCTYPE html>
<html>
<head>

<title>Haematology Referrals</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
}

.content{
    flex:1;
    padding:40px;
}

.page-title{
    font-size:40px;
    font-weight:700;
    color:#0f172a;
}

.page-subtitle{
    font-size: 20px;
    color:#64748b;
    margin-top:20px;
}

.card{
    background:white;
    margin-top:30px;
    padding:25px;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
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

.action-btn{
    background:#db2777;
    color:white;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
}

.action-btn:hover{
    background:#15803d;
}

</style>
</head>

<body>
<div class="main-container">
@include('layouts.haematology_sidebar')
<div class="content">

<h1 class="page-title">
Haematology Referrals
</h1>

<p class="page-subtitle">
Patients referred to Haematology Department
</p>

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

@forelse($patients as $patient)
        <tr>
            <td>{{ $patient->PatientID }}</td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->symptoms }}</td>
            <td>{{ $patient->status }}</td>
        <td>
            <a href="/haematology/history/{{ $patient->PatientID }}"
            class="action-btn">
                Review
            </a>
            </td>
            </tr>
@empty
<tr>
<td colspan="5" style="text-align:center;padding:30px;">
No referred patients found
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