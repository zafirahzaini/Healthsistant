<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  .sidebar{
    width:260px;
    min-height:100vh;
    background:linear-gradient(
        180deg,
        #db2777,
        #9d174d
    );
    color:white;
    padding:24px 18px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:sticky;
    top:0;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo-box{
    width:50px;
    height:50px;
    border-radius:14px;
    background:rgba(255,255,255,0.15);
    display:flex;
    justify-content:center;
    align-items:center;
}

.logo-box i{
    font-size:20px;
}

.logo h2{
    font-size:22px;
    font-weight:700;
}

.logo-sub{
    margin-top:15px;
    font-size:14px;
    opacity:0.9;
    line-height:1.5;
}

.menu{
    margin-top:40px;
}

.menu-title{
    font-size:13px;
    letter-spacing:2px;
    opacity:0.7;
    margin-bottom:20px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    color:white;
    text-decoration:none;
    padding:14px 16px;
    border-radius:14px;
    margin-bottom:10px;
    transition:0.3s;
}

.menu a:hover{
    background:rgba(255,255,255,0.12);
}

.menu a.active{
    background:white;
    color:#9d174d;
    font-weight:600;
}

.logout-btn a{
    display:flex;
    align-items:center;
    gap:10px;
    background:white;
    color:#9d174d;
    text-decoration:none;
    padding:14px 16px;
    border-radius:14px;
    font-weight:600;
}

</style>

<div class="sidebar">

        <div>

            <div class="logo-section">

                <div class="logo">

                    <div class="logo-box">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>

                    <h2>Healthsistant</h2>

                </div>

                <div class="logo-sub">
                    Hospital Disease Analysis & Prediction System
                </div>

            </div>

            <div class="menu">

                <div class="menu-title">
                    HAEMATOLOGY PANEL
                </div>

                <a href="/dashboard/haematology"
                class="{{ request()->is('dashboard/haematology') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>

                <a href="/haematology/referrals"
                class="{{ request()->is('haematology/referrals') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-doctor"></i>
                    Referred Patients
                </a>

                <a href="/haematology/history"
                class="{{ request()->is('haematology/history*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-medical"></i>
                    Assessment History
                </a>

                <a href="/haematology/patient-records"
                class="{{ request()->is('haematology/patient-records') ? 'active' : '' }}">
                    <i class="fa-solid fa-notes-medical"></i>
                    Patient Records
                </a>

                <a href="/haematology/admissions"
                class="{{ request()->is('haematology/admissions') ? 'active' : '' }}">
                    <i class="fas fa-bed"></i>
                    Admissions
                </a>

                <a href="/haematology/profile"
                class="{{ request()->is('haematology/profile') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    My Profile
                </a>
            </div>

        </div>

        <div class="logout-btn">

            <a href="/logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>