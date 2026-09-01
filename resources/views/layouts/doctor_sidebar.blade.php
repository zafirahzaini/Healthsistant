<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  .sidebar{
    width:260px;
    height:100vh;
    background:linear-gradient(
        180deg,
        #166534,
        #14532d
    );

    color:white;
    padding:24px 18px;

    display:flex;
    flex-direction:column;
    justify-content:space-between;

    position:STICKY;
    top:0;
    min-height:100vh;
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

.main-content{
    margin-left:260px;
    padding:30px;
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
    color:#166534;
    font-weight:600;
}

.logout-btn a{
    display:flex;
    align-items:center;
    gap:10px;
    background:white;
    color:#166534;
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
                    DOCTOR PANEL
                </div>

                <a href="/dashboard/doctor"
   class="{{ request()->is('dashboard/doctor') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>

                <a href="/patient/queue"
   class="{{ request()->is('patient/queue') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    Patient Queue
                </a>

                <a href="/doctor/patient-records"
                    class="{{ request()->is('doctor/patient-records') ? 'active' : '' }}">
                        <i class="fa-solid fa-notes-medical"></i>
                        Patient Records
                    </a>

                <a href="/doctor/profile"
   class="{{ request()->is('doctor/profile') ? 'active' : '' }}">
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