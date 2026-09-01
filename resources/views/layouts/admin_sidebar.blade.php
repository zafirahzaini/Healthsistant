<style>

.sidebar{
    width:280px;
    min-height:100vh;
    background:linear-gradient(180deg,#7f1d1d,#991b1b);
    color:white;
    padding:25px 20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:20px;
}

.logo-box{
    width:50px;
    height:50px;
    border-radius:14px;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.logo h2{
    color:white;
    margin:0;
}

.logo-sub{
    font-size:13px;
    opacity:.9;
    line-height:1.5;
    margin-bottom:25px;
}

.menu-title{
    font-size:12px;
    letter-spacing:2px;
    margin-bottom:15px;
    opacity:.8;
}

.menu a{
    display:flex;
    align-items:center;
    gap:10px;

    white-space:nowrap;

    text-decoration:none;
    color:white;
    padding:14px 16px;
    border-radius:14px;
    margin-bottom:10px;
    transition:.3s;
}

.menu a:hover{
    background:rgba(255,255,255,.15);
}

.menu a.active{
    background:white;
    color:#7f1d1d;
    font-weight:600;
    min-height:58px;
}

.logout-btn a{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    text-decoration:none;
    background:white;
    color:#7f1d1d;
    padding:14px;
    border-radius:14px;
    font-weight:600;
}

</style>

<!-- SIDEBAR -->

<div class="sidebar">

    <div>

        <!-- LOGO -->

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

        <!-- MENU -->

        <div class="menu">

            <div class="menu-title">
                MAIN MENU
            </div>

            <a href="/dashboard/admin"
               class="{{ request()->is('dashboard/admin') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
            </a>

            <a href="/staff/add"
               class="{{ request()->is('staff/add') ? 'active' : '' }}">
                <i class="fa-solid fa-user-plus"></i>
                Add Staff
            </a>

            <a href="/prediction"
               class="{{ request()->is('prediction') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                Run Prediction
            </a>

           <a href="/admin/patients"
                class="{{ request()->is('admin/patients*') || request()->is('admin/patient/*') ? 'active' : '' }}">
                <i class="fa-solid fa-hospital-user"></i>
                Patients Management
            </a>

            <a href="/patient-journey"
                class="{{ request()->is('patient-journey*') ? 'active' : '' }}">
                <i class="fa-solid fa-route"></i>
                 Patient Journey Tracker
            </a>


            <a href="/admission/list"
               class="{{ request()->is('admission/list') ? 'active' : '' }}">
                <i class="fa-solid fa-bed-pulse"></i>
                View Admissions
            </a>

        </div>

    </div>

    <!-- LOGOUT -->

    <div class="logout-btn">

        <a href="/logout">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</div>