<!-- ================= SIDEBAR ================= -->

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

                NURSE PANEL

            </div>

            <a href="/dashboard/nurse" class="{{ Request::is('dashboard/nurse') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
            </a>

            <a href="/patient/add" class="{{ Request::is('patient/add') ? 'active' : '' }}">
                <i class="fa-solid fa-user-plus"></i>
                Add Patient
            </a>

            <a href="/patient/list" class="{{ Request::is('patient/list') ? 'active' : '' }}">
                <i class="fa-solid fa-hospital-user"></i>
                View Patients
            </a>

            <a href="/doctor/availability" class="{{ Request::is('doctor/availability') ? 'active' : '' }}">
                <i class="fa-solid fa-user-doctor"></i>
                Available Doctors
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