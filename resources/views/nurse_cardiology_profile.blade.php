<!DOCTYPE html>
<html>
<head>

<title>Nurse Profile</title>

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
margin-bottom:30px;
}

.profile-card{
background:white;
border-radius:25px;
padding:40px;
box-shadow:0 5px 20px rgba(0,0,0,.06);
}

.profile-header{
display:flex;
align-items:center;
gap:25px;
margin-bottom:40px;
}

.avatar{
width:100px;
height:100px;
border-radius:50%;
background:#f59e0b;
display:flex;
align-items:center;
justify-content:center;
font-size:40px;
font-weight:700;
color:white;
}

.name{
font-size:30px;
font-weight:700;
color:#1e293b;
}

.role{
color:#92400e;
font-weight:600;
}

.info-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
}

.info-box{
background:#fafafa;
padding:20px;
border-radius:15px;
}

.label{
font-size:13px;
color:#64748b;
margin-bottom:5px;
}

.value{
font-size:18px;
font-weight:600;
}

</style>

</head>

<body>

<div class="main-container">

@include('layouts.nurse_cardiology_sidebar')

<div class="content">

<h1 class="page-title">
My Profile
</h1>

<div class="profile-card">

<div class="profile-header">

<div class="avatar">
{{ strtoupper(substr($nurse->name ?? 'N',0,1)) }}
</div>

<div>
<div class="name">
{{ $nurse->name ?? 'Cardiology Nurse' }}
</div>

<div class="role">
Cardiology Nurse
</div>
</div>

</div>

<div class="info-grid">

<div class="info-box">
<div class="label">Full Name</div>
<div class="value">
{{ $nurse->name ?? '-' }}
</div>
</div>

<div class="info-box">
<div class="label">Email</div>
<div class="value">
{{ $nurse->email ?? '-' }}
</div>
</div>

<div class="info-box">
<div class="label">Department</div>
<div class="value">
Cardiology
</div>
</div>

<div class="info-box">
<div class="label">Position</div>
<div class="value">
Registered Nurse
</div>
</div>

</div>

</div>

</div>

</div>

</body>
</html>