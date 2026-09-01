<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\PatientJourneyController;
use App\Http\Controllers\PredictionController;


// ================= HOMEPAGE =================
Route::get('/', function () {
    return view('welcome');
});

// =====================================================
// USER MODULE
// =====================================================


// ================= REGISTER PAGE =================

Route::get('/register', function () {

    return view('register');

});


// ================= REGISTER PROCESS =================

Route::post('/register', [AuthController::class, 'register']);


// ================= LOGIN PAGE =================

Route::get('/login', function () {

    return view('login');

});


// ================= LOGIN PROCESS =================

Route::post('/login', [AuthController::class, 'login']);


// ================= FIRST TIME LOGIN =================

Route::post('/first-time-login', [AuthController::class, 'firstTimeLogin']);


// ================= CHANGE PASSWORD PAGE =================

Route::get('/change-password', function () {

    return view('change_password');

});


// ================= CHANGE PASSWORD PROCESS =================

Route::post('/change-password', [AuthController::class, 'changePassword']);


// =====================================================
// STAFF MODULE
// =====================================================


// ================= ADD STAFF PAGE =================

Route::get('/staff/add', function () {

    return view('staff_add');

});


// ================= STORE STAFF =================

Route::post('/staff/store', [AuthController::class, 'storeStaff']);


// =====================================================
// PREDICTION MODULE
// =====================================================
Route::get('/prediction',
    [PredictionController::class,'index']);

Route::post('/prediction/upload',
    [PredictionController::class,'upload']);


// =====================================================
// PATIENT MODULE
// =====================================================


// ================= ADD PATIENT PAGE =================

Route::get('/patient/add', [PatientController::class, 'create']);


// ================= STORE PATIENT =================

Route::post('/patient/add', [PatientController::class, 'store']);


// ================= LIST PATIENT =================

Route::get('/patient/list', [PatientController::class, 'index']);
Route::get('/patient/search/{ic}', [PatientController::class, 'searchPatient']);


// =====================================================
// PATIENT QUEUE MODULE
// =====================================================


// ================= PATIENT QUEUE =================

Route::get('/patient/queue', function () {
    // Fetch all patients added by the nurse that are Waiting or Under Review
    $patients = DB::table('patients')
        ->whereIn('status', ['Waiting', 'Under Review'])
        ->orderBy('created_at', 'asc')
        ->get();

    return view('patient_queue', compact('patients'));
});


// ================= ADMIT PATIENT =================

Route::post('/patient/admit/{id}', [PatientController::class, 'admitPatient']);


// =====================================================
// ADMISSION MODULE
// =====================================================


// ================= ADD ADMISSION PAGE =================
Route::get('/admission/add', [AdmissionController::class, 'create']);

// ================= STORE ADMISSION =================
Route::post('/admission/add', [AdmissionController::class, 'store']);

// ================= LIST ADMISSION =================
Route::get('/admission/list', [AdmissionController::class, 'index']);


// =====================================================
// DISEASE MODULE
// =====================================================


// ================= ADD DISEASE PAGE =================
Route::get('/disease/add', [DiseaseController::class, 'create']);

// ================= STORE DISEASE =================
Route::post('/disease/add', [DiseaseController::class, 'store']);

// ================= LIST DISEASE =================
Route::get('/disease/list', [DiseaseController::class, 'index']);


// =====================================================
// DIAGNOSIS MODULE
// =====================================================


// ================= ADD DIAGNOSIS PAGE =================
Route::get('/diagnosis/add', [DiagnosisController::class, 'create']);

// ================= STORE DIAGNOSIS =================
Route::post('/diagnosis/add', [DiagnosisController::class, 'store']);

// ================= LIST DIAGNOSIS =================
Route::get('/diagnosis/list', [DiagnosisController::class, 'index']);


// =====================================================
// DASHBOARD MODULE
// =====================================================

Route::get('/admin/journey', [PatientJourneyController::class, 'index']);
Route::get('/admin/journey/{id}', [PatientJourneyController::class, 'show']);
// ================= GENERAL DASHBOARD =================
Route::get('/dashboard', function () {
    $role = session('role');
    if ($role == 'operation manager') {
        return redirect('/dashboard/admin');
    } elseif ($role == 'doctor_cardiology') {
        return redirect('/dashboard/cardiology');
    }  elseif ($role == 'nurse_cardiology') {
        return redirect('/dashboard/nurse-cardiology');
    } elseif ($role == 'doctor_haematology') {
         return redirect('/dashboard/haematology');   
    } elseif ($role == 'nurse_haematology') {
        return redirect('/dashboard/nurse-haematology');
    }elseif ($role == 'doctor') {
        return redirect('/dashboard/doctor');
    } elseif ($role == 'nurse') {
        return redirect('/dashboard/nurse');
    } elseif ($role == 'medical officer') {
        return redirect('/dashboard/mo');
    }
    return redirect('/login');

});

//CARDIOLOGY
Route::get(
    '/cardiology/referrals',
    [PatientController::class, 'cardiologyReferrals']
);

Route::get(
    '/cardiology/history',
    [PatientController::class, 'cardiologyHistory']
);

Route::get(
    '/cardiology/history/{id}',
    [PatientController::class, 'cardiologyHistoryDetails']
)->name('cardiology.history.details');

Route::get(
    '/cardiology/profile',
    [PatientController::class, 'cardiologyProfile']
);

Route::get('/cardiology/patient-records',
    [PatientController::class, 'cardiologyPatientRecords'])
    ->name('cardiology.patient.records');

Route::get(
    '/cardiology/admissions',
    [PatientController::class, 'cardiologyAdmissions']
);

//NURSE CARDIOLOGY
Route::get(
    '/dashboard/nurse-cardiology',
    [PatientController::class, 'nurseCardiologyDashboard']
);

Route::get(
    '/nurse-cardiology/ward-patients',
    [PatientController::class,'nurseCardiologyWardPatients']
);

Route::get(
    '/nurse-cardiology/vitals',
    [PatientController::class,'nurseCardiologyVitalsList']
);

Route::get(
    '/nurse-cardiology/vitals/{id}',
    [PatientController::class,'nurseCardiologyVitals']
);

Route::post(
    '/nurse-cardiology/vitals/{id}',
    [PatientController::class,'saveNurseCardiologyVitals']
);

Route::get(
    '/nurse-cardiology/medications',
    [PatientController::class,'nurseMedicationRecords']
);

Route::post(
    '/nurse-cardiology/medications',
    [PatientController::class,'saveMedicationRecord']
);

Route::get(
    '/nurse-cardiology/profile',
    [PatientController::class,'nurseCardiologyProfile']
);

Route::get('/patient-journey',
    [PatientJourneyController::class,'index']);

Route::get('/patient-journey/{id}',
    [PatientJourneyController::class,'show']);

// ================= ADMIN DASHBOARD =================
Route::get('/dashboard/admin', [PatientController::class, 'adminDashboard']);
Route::get('/admin/patient/{id}',
[PatientController::class,'patientDetails']);

Route::get(
    '/admin/patients',
    [PatientController::class,'patientManagement']
);

// =====================================================
// ADMIN MODULE
// =====================================================
Route::get('/admin/dashboard', [PatientController::class, 'adminDashboard']);
Route::get('/admin/patients', [PatientController::class, 'patientManagement']);


// ================= DOCTOR DASHBOARD =================

Route::get('/dashboard/doctor', function () {

    $referrals = DB::table('patients')
    ->where('decision','Refer To Specialist')
    ->count();

    $availableDoctors = DB::table('available_doctors')
    ->join('users','available_doctors.userID','=','users.userID')
    ->select(
        'users.userID',
        'users.name',
        'users.role'
    )
    ->get();

    // TOTAL ADMISSIONS
    $totalAdmissions = DB::table('admissions')
        ->count();

    // DIAGNOSIS RECORDS
    $diagnosisRecords = DB::table('admissions')
        ->whereNotNull('DiseaseID')
        ->count();

    // ACTIVE CASES
    $activeCases = DB::table('admissions')
        ->where(function($query){

            $query->whereNull('DiseaseID')
                  ->orWhere('diagnosis_status', 'Pending');

        })
        ->count();

    // PATIENT QUEUE
    $patients = DB::table('patients')
        ->where('status', 'Waiting')
        ->orderBy('created_at', 'asc')
        ->get();
        return view('dashboard_doctor', compact(
            'activeCases',
            'patients',
            'referrals',
            'availableDoctors'
        ));
    });

Route::get(
    '/doctor/profile',
    [PatientController::class, 'doctorProfile']
);
    
Route::get('/doctor/patient-records', function () {

    $patients = DB::table('patients')
        ->get();

    return view(
        'doctor_patient_records',
        compact('patients')
    );

});

Route::get('/patient/view/{id}', [PatientController::class, 'viewPatient']);
Route::get('/patient/action/{id}', [PatientController::class, 'actionPage']);
Route::post('/patient/admit/{id}', [PatientController::class, 'admitPatient']);
Route::post('/patient/reject/{id}', [PatientController::class, 'rejectPatient']);
Route::post('/patient/update/{id}', [PatientController::class, 'updatePatient']);


// ================= NURSE DASHBOARD =================

Route::get('/dashboard/nurse', function () {

    // REGISTERED TODAY
    $registeredToday = DB::table('patients')
        ->whereDate('created_at', today())
        ->count();

    // TOTAL PATIENTS
    $totalPatients = DB::table('patients')
        ->count();

    // TODAY RECORDS
    $todayRecords = DB::table('patients')
        ->whereDate('created_at', today())
        ->count();

    return view('dashboard_nurse', compact(
        'registeredToday',
        'totalPatients',
        'todayRecords'
    ));

});


// ================= MEDICAL OFFICER DASHBOARD =================

Route::get('/dashboard/mo', function () {

    return view('dashboard_mo');

});

Route::get(
    '/available-specialists/{department}',
    [PatientController::class,'availableSpecialists']
);

Route::get(
    '/dashboard/cardiology',
    [PatientController::class, 'cardiologyDashboard']
);

Route::get(
    '/doctor/availability',
    [PatientController::class, 'doctorAvailability']
);

Route::get(
    '/doctor/available-specialists',
    [PatientController::class,'availableSpecialistsPage']
);

Route::post(
    '/doctor/availability/save',
    [PatientController::class,'saveAvailability']
);

Route::post(
    '/doctor/availability/remove',
    [PatientController::class,'removeAvailableDoctor']
);

// Put this near your other doctor or patient API routes
Route::get('/api/available-doctors/{department}', [PatientController::class, 'getAvailableDoctorsWithQueue']);

// NURSE HAEMATOLOGY

Route::get(
    '/dashboard/nurse-haematology',
    [PatientController::class,'nurseHaematologyDashboard']
);

Route::get(
    '/nurse-haematology/ward-patients',
    [PatientController::class,'nurseHaematologyWardPatients']
);

Route::get(
    '/nurse-haematology/vitals',
    [PatientController::class,'nurseHaematologyVitalsList']
);

Route::get(
    '/nurse-haematology/vitals/{id}',
    [PatientController::class,'nurseHaematologyVitals']
);

Route::post(
    '/nurse-haematology/vitals/{id}',
    [PatientController::class,'saveNurseHaematologyVitals']
);

Route::get(
    '/nurse-haematology/medications',
    [PatientController::class,'nurseHaematologyMedicationRecords']
);

Route::post(
    '/nurse-haematology/medications',
    [PatientController::class,'saveHaematologyMedicationRecord']
);

Route::get(
    '/nurse-haematology/profile',
    [PatientController::class,'nurseHaematologyProfile']
);

// =====================================================
// LOGOUT
// =====================================================

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');

});

Route::get(
    '/dashboard/haematology',
    [PatientController::class,'haematologyDashboard']
);

Route::get(
    '/haematology/referrals',
    [PatientController::class,'haematologyReferrals']
);

Route::get(
    '/haematology/history',
    [PatientController::class,'haematologyHistory']
);

Route::get(
    '/haematology/history/{id}',
    [PatientController::class,'haematologyHistoryDetails']
)->name('haematology.history.details');

Route::get(
    '/haematology/patient-records',
    [PatientController::class,'haematologyPatientRecords']
);

Route::get(
    '/haematology/admissions',
    [PatientController::class,'haematologyAdmissions']
);

Route::get(
    '/haematology/profile',
    [PatientController::class,'haematologyProfile']
);

Route::get(
    '/admin/patients',
    [PatientController::class,'patientManagement']
);

Route::get(
    '/haematology/referral/{id}',
    [PatientController::class,'haematologyReferralDetails']
);

// Put this near your other patient action routes (like patient/admit or patient/reject)
Route::post('/patient/discharge/{id}', [PatientController::class, 'dischargePatient']);

Route::post(
    '/haematology/patient/admit/{id}',
    [PatientController::class, 'admitHaematologyPatient']
);

Route::post(
    '/cardiology/patient/admit/{id}',
    [PatientController::class, 'admitCardiologyPatient']
);

// Add this line directly underneath your haematology discharge route
Route::post('/cardiology/patient/discharge/{id}', [PatientController::class, 'dischargeCardiologyPatient']);

Route::post('/patient/{id}/mark-deceased', [PatientController::class, 'markDeceased']);