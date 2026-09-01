<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

.brand{
    display:flex;
    align-items:flex-start;
    gap:14px;
    margin-bottom:40px;
}

.brand-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    background:rgba(255,255,255,.15);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:22px;
    color:white;
}

.logo{
    font-size:30px;
    font-weight:700;
    line-height:1.2;
}

.system-text{
    margin-top:10px;
    font-size:14px;
    line-height:1.8;
    opacity:.9;
}

.panel-title{
    font-size:13px;
    font-weight:600;
    color:#fbcfe8;
    letter-spacing:1px;
    margin-bottom:18px;
    padding-left:12px;
}

.sidebar{
    width:290px;
    min-height:100vh;
    background:linear-gradient(
        180deg,
        #c026d3,
        #9333ea
    );
    padding:30px 22px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:5px 0 25px rgba(0,0,0,0.08);
    color:white;
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
    transition:.3s;
    font-size:15px;
    font-weight:500;
}

.menu a:hover{
    background:rgba(255,255,255,.12);
}

.menu a.active{
    background:white;
    color:#a21caf;
    font-weight:600;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.menu a i{
    width:24px;
    font-size:18px;
    text-align:center;
}

.logout-container{
    margin-top:auto;
    padding-top:40px;
}

.logout-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    text-decoration:none;
    background:white;
    color:#a21caf;
    padding:15px;
    border-radius:16px;
    font-weight:600;
    transition:.3s;
}

.logout-btn:hover{
    transform:translateY(-2px);
}

</style>

<div class="sidebar">

    <div>

        <div class="brand">

            <div class="brand-icon">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>

            <div>

                <div class="logo">
                    Healthsistant
                </div>

                <div class="system-text">
                    Hospital Disease Analysis &
                    Prediction System
                </div>

            </div>

        </div>

        <div class="panel-title">
            HAEMATOLOGY NURSE PANEL
        </div>

        <div class="menu" style="margin-top:30px;">

            <a href="/dashboard/nurse-haematology"
               class="{{ request()->is('dashboard/nurse-haematology') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>

            <a href="/nurse-haematology/ward-patients"
               class="{{ request()->is('nurse-haematology/ward-patients') ? 'active' : '' }}">
                <i class="fa-solid fa-bed"></i>
                <span>Ward Patients</span>
            </a>

            <a href="/nurse-haematology/vitals"
               class="{{ request()->is('nurse-haematology/vitals*') ? 'active' : '' }}">
                <i class="fa-solid fa-heart-pulse"></i>
                <span>Vital Signs</span>
            </a>

            <a href="/nurse-haematology/medications"
               class="{{ request()->is('nurse-haematology/medications*') ? 'active' : '' }}">
                <i class="fa-solid fa-pills"></i>
                <span>Medication Records</span>
            </a>

            <a href="/nurse-haematology/profile"
               class="{{ request()->is('nurse-haematology/profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>My Profile</span>
            </a>

        </div>

    </div>

    <div class="logout-container">

        <a href="/logout" class="logout-btn">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</div>