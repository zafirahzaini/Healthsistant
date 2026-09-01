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
    color:#92400e;
    letter-spacing:1px;
    margin-bottom:18px;
    padding-left:12px;
}

.sidebar{
    width:290px;
    min-height:100vh;
    background:linear-gradient(
        180deg,
        #f59e0b,
        #d97706
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
    color:#92400e;
    font-weight:600;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.menu a i{
    width:24px;
    font-size:18px;
    text-align:center;
}

.logo{
    font-size:30px;
    font-weight:700;
    margin-bottom:10px;
 }

.subtitle{
    color:#92400e;
    opacity:.75;
    font-size:16px;
    margin-bottom:35px;
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
    color:#92400e;
    padding:15px;
    border-radius:16px;
    font-weight:600;
    transition:.3s;
}

.logout-btn:hover{
    background:white;
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
        CARDIOLOGY NURSE PANEL
    </div>

           <div class="menu" style="margin-top:30px;">

            <a href="/dashboard/nurse-cardiology"
                class="{{ request()->is('dashboard/nurse-cardiology') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>

            <a href="/nurse-cardiology/ward-patients"
                class="{{ request()->is('nurse-cardiology/ward-patients') ? 'active' : '' }}">
                <i class="fa-solid fa-bed"></i>
                <span>Ward Patients</span>
            </a>

            <a href="/nurse-cardiology/vitals"
                class="{{ request()->is('nurse-cardiology/vitals*') ? 'active' : '' }}">
                <i class="fa-solid fa-heart-pulse"></i>
                <span>Vital Signs</span>
            </a>

            <a href="/nurse-cardiology/medications"
                class="{{ request()->is('nurse-cardiology/medications*') ? 'active' : '' }}">
                <i class="fa-solid fa-pills"></i>
                <span>Medication Records</span>
            </a>

            <a href="/nurse-cardiology/profile"
                class="{{ request()->is('nurse-cardiology/profile') ? 'active' : '' }}">
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



