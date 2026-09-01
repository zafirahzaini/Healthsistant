<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientController extends Controller
{
    // SHOW ADD PATIENT FORM
    public function create()
    {
        return view('patient_add');
    }

    // STORE PATIENT
    public function store(Request $request)
    {
        try {

            DB::table('patients')->insert([

                'name' => $request->name,
                'ic_number' => $request->ic_number,
                'passport_number' => $request->passport_number,
                'date_of_birth' => $request->date_of_birth,
                'age' => Carbon::parse( $request->date_of_birth )->age,
                'gender' => $request->gender,
                'race' => $request->race,
                'temperature' => $request->temperature,
                'heart_rate' => $request->heart_rate,
                'respiratory_rate' => $request->respiratory_rate,
                'sbp' => $request->sbp,
                'dbp' => $request->dbp,
                'pulse' => $request->pulse,
                'symptoms' => $request->symptoms,
                'status' => 'Waiting',
                'created_at' => now(),
                'updated_at' => now()

            ]);

            return redirect('/patient/list')
                ->with('success', 'Patient added successfully');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'database' => $e->getMessage()
                ]);
        }
    }

    // SHOW PATIENT LIST
    public function index()
    {
        $patients = DB::table('patients')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient_list', compact('patients'));
    }

    // ================= PATIENT QUEUE =================
    public function queue()
    {
        // Show all waiting patients
        // Every patient goes to Doctor General first

        $patients = DB::table('patients')
            ->where('status', 'Referred')
            ->orderBy('created_at', 'asc')
            ->get();
        return view(
            'patient_queue',
            compact('patients')
        );
    }

    public function doctorProfile()
    {
        $doctor = DB::table('users')
            ->where('userID', session('userID'))
            ->first();

        return view(
            'doctor_profile',
            compact('doctor')
        );
    }

    // SHOW PATIENT ACTION PAGE
    public function actionPage($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {

            return redirect('/dashboard/doctor')
                ->with('error', 'Patient not found');
        }

        return view('patient_action', compact('patient'));
    }

    // ADMIT PATIENT
    public function admitPatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {

            return redirect('/dashboard/doctor')
                ->with('error', 'Patient not found');
        }

        $existingAdmission = DB::table('admissions')
            ->where('name', $patient->name)
            ->where('diagnosis_status', 'Pending')
            ->first();

        if ($existingAdmission) {

            return redirect('/dashboard/doctor')
                ->with('error', 'Patient already admitted');
        }

        DB::table('admissions')->insert([

            'patient_id' => $patient->PatientID,

            'name' => $patient->name,

            'age' => $patient->age,

            'gender' => $patient->gender,

            'chief_complaint' => $patient->symptoms,

            'diagnosis_status' => 'Pending',

            'created_at' => now(),

            'updated_at' => now()

        ]);

        return redirect('/admission/list')
            ->with('success', 'Patient admitted successfully');
    }

    public function admitHaematologyPatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found');
        }

        // 1. Update patient status to Admitted
        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'status' => 'Admitted',
                'decision' => 'Admit',
                'admitted_at' => now(),
                'updated_at' => now()
            ]);

        // 2. Insert into admissions table if it doesn't already exist
        $exists = DB::table('admissions')
            ->where('patient_id', $id)
            ->where('diagnosis_status', 'Pending')
            ->exists();

        if (!$exists) {
            DB::table('admissions')->insert([
                'patient_id' => $id,
                'name' => $patient->name,
                'age' => $patient->age,
                'gender' => $patient->gender,
                'chief_complaint' => $patient->symptoms,
                'diagnosis_status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 3. REDIRECT DIRECTLY TO HAEMATOLOGY ADMISSIONS
        return redirect('/haematology/admissions')->with('success', 'Patient admitted to Haematology successfully');
    }

    // ================= CARDIOLOGY ADMISSION HANDLING =================
    public function admitCardiologyPatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found');
        }

        // 1. Update patient status and decision flags to Admitted
        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'status' => 'Admitted',
                'decision' => 'Admit',
                'admitted_at' => now(),
                'updated_at' => now()
            ]);

        // 2. Insert into the active admissions tracking grid if a record doesn't exist
        $exists = DB::table('admissions')
            ->where('patient_id', $id)
            ->where('diagnosis_status', 'Pending')
            ->exists();

        if (!$exists) {
            DB::table('admissions')->insert([
                'patient_id' => $id,
                'name' => $patient->name,
                'age' => $patient->age,
                'gender' => $patient->gender,
                'chief_complaint' => $patient->symptoms,
                'diagnosis_status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 3. Clean routing target back straight into Cardiology Admissions
        return redirect('/cardiology/admissions')->with('success', 'Patient admitted to Cardiology successfully');
    }

    // SEND HOME / REJECT PATIENT
    public function rejectPatient($id)
    {
        DB::table('patients')
            ->where('PatientID', $id)
            ->delete();

        return redirect('/dashboard/doctor')
            ->with('success', 'Patient sent home successfully');
    }

    // VIEW PATIENT
    public function viewPatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {

            return redirect('/patient/queue')
                ->with('error', 'Patient not found');
        }

        return view('patient_view', compact('patient'));
    }

    public function availableSpecialists($department)
    {
        $role = (strtolower($department) === 'cardiology') ? 'doctor_cardiology' : 'doctor_haematology';

        $doctors = DB::table('available_doctors')
            ->join('users', 'available_doctors.userID', '=', 'users.userID')
            ->leftJoin('patients', function ($join) {
                $join->on('users.userID', '=', 'patients.assigned_doctor')
                     ->whereIn('patients.status', ['Referred', 'Admitted']);
            })
            ->where('users.role', $role)
            ->select(
                'users.userID',
                'users.name',
                DB::raw('COUNT(patients.PatientID) as workload')
            )
            ->groupBy(
                'users.userID',
                'users.name'
            )
            ->get();

        return response()->json($doctors);
    }

    public function getAvailableDoctorsWithQueue($department)
    {
        // Map the dropdown department text to your database role syntax
        $roleMap = [
            'cardiology' => 'doctor_cardiology',
            'haematology' => 'doctor_haematology',
            'general' => 'doctor'
        ];

        $targetRole = $roleMap[strtolower($department)] ?? 'doctor_' . strtolower($department);

        // Get doctors marked active by the nurse, filtering by department role
        $doctors = DB::table('users')
            ->join('available_doctors', 'users.userID', '=', 'available_doctors.userID')
            ->where('users.role', $targetRole)
            ->select('users.userID', 'users.name')
            ->get();

        // Map through each doctor and append their live active 'Waiting' patient queue count
        $doctorsWithQueue = $doctors->map(function($doctor) {
            // Count how many patients are assigned to this doctor ID and are currently waiting
            $queueCount = DB::table('patients')
                ->where('assigned_doctor', $doctor->userID)
                ->where('status', 'Waiting')
                ->count();

            return [
                'userID' => $doctor->userID,
                'name' => $doctor->name,
                'queue_count' => $queueCount
            ];
        });

        return response()->json($doctorsWithQueue);
    }

    public function availableSpecialistsPage()
    {
        $doctors = DB::table('available_doctors')
            ->join(
                'users',
                'available_doctors.userID',
                '=',
                'users.userID'
            )
            ->leftJoin('patients', function($join){

                $join->on(
                    'users.userID',
                    '=',
                    'patients.assigned_doctor'
                )
                ->where(
                    'patients.status',
                    '=',
                    'Referred'
                );

            })
            ->select(
                'users.userID',
                'users.name',
                'users.role',
                DB::raw('COUNT(patients.PatientID) as workload')
            )
            ->groupBy(
                'users.userID',
                'users.name',
                'users.role'
            )
            ->get();

        return view(
            'doctor_available_specialists',
            compact('doctors')
        );
    }

    public function removeAvailableDoctor(Request $request)
    {
        DB::table('available_doctors')
            ->where('userID', $request->userID)
            ->whereDate(
                'available_date',
                today()
            )
            ->delete();

        return back()->with(
            'success',
            'Doctor removed successfully.'
        );
    }

    public function updatePatient(Request $request, $PatientID)
    {
        DB::table('patients')
            ->where('PatientID', $PatientID)
            ->update([
                'doctor_seen_at' => now(),
                'doctor_notes' => $request->doctor_notes,
                'preliminary_diagnosis' => $request->preliminary_diagnosis,
                'updated_at' => now()
            ]);

        if($request->decision == 'Admit')
        {
            DB::table('admissions')->insert([
                'patient_id' => $PatientID,

                'name' => DB::table('patients')
                            ->where('PatientID', $PatientID)
                            ->value('name'),

                'age' => DB::table('patients')
                            ->where('PatientID', $PatientID)
                            ->value('age'),

                'gender' => DB::table('patients')
                            ->where('PatientID', $PatientID)
                            ->value('gender'),

                'chief_complaint' => DB::table('patients')
                            ->where('PatientID', $PatientID)
                            ->value('symptoms'),

                'diagnosis_status' => 'Pending',

                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('patients')
                ->where('PatientID', $PatientID)
                ->update([
                    'status' => 'Admitted',
                    'decision' => 'Admit',
                    'admitted_at' => now()
                ]);
        }
        elseif($request->decision == 'Refer To Specialist')
        {
            $targetRole = 'doctor_' . strtolower($request->specialist_department);
            
            $assignedDoctorId = null;

            // 1. Check if doctor was specifically chosen in the dropdown form
            if ($request->filled('assigned_doctor')) {
                $assignedDoctorId = $request->assigned_doctor;
            } else {
                // 2. Otherwise auto-assign ONLY among currently ACTIVE/AVAILABLE doctors
                $availableDoctors = DB::table('available_doctors')
                    ->join('users', 'available_doctors.userID', '=', 'users.userID')
                    ->where('users.role', '=', $targetRole)
                    ->get();

                if ($availableDoctors->isNotEmpty()) {
                    $doctorWorkloads = [];
                    
                    foreach ($availableDoctors as $doc) {
                        $activeCount = DB::table('patients')
                            ->where('assigned_doctor', $doc->userID)
                            ->where('status', '=', 'Referred')
                            ->count();
                        
                        $doctorWorkloads[$doc->userID] = $activeCount;
                    }

                    asort($doctorWorkloads);
                    $assignedDoctorId = key($doctorWorkloads);
                }
            }

            if ($assignedDoctorId) {
                DB::table('patients')
                    ->where('PatientID', $PatientID)
                    ->update([
                        'status' => 'Referred',
                        'decision' => 'Refer To Specialist',
                        'assigned_doctor' => $assignedDoctorId,
                        'specialist_department' => $request->specialist_department,
                        'doctor_seen_at' => now(), 
                        'updated_at' => now()
                    ]);
            } else {
                return redirect()->back()->with('error', 'No active specialists are currently available for this department.');
            }
        }
        else
        {
            DB::table('patients')
                ->where('PatientID', $PatientID)
                ->update([
                    'status' => 'Discharged',
                    'decision' => 'Discharge'
                ]);
        }

        return redirect('/patient/queue')
            ->with('success', 'Patient assessment completed successfully');
    }

    // Partial IC search + Deduplicates to return ONLY the latest record per patient
    public function searchPatient($keyword)
    {
        $cleanKeyword = str_replace('-', '', $keyword);

        // 1. Query records matching the IC / Passport keyword
        $patients = DB::table('patients')
            ->where('ic_number', 'like', '%' . $keyword . '%')
            ->orWhere('passport_number', 'like', '%' . $keyword . '%')
            ->orWhere(DB::raw("REPLACE(ic_number, '-', '')"), 'like', '%' . $cleanKeyword . '%')
            ->orderBy('PatientID', 'desc')
            ->get();

        // 2. Filter out duplicates so only the NEWEST visit record per IC is returned
        $uniquePatients = $patients->unique(function ($patient) {
            return str_replace('-', '', $patient->ic_number) ?: str_replace('-', '', $patient->passport_number);
        })->values();

        return response()->json($uniquePatients);
    }

    public function cardiologyDashboard()
    {
        $referrals = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->where('status', 'Referred')
            ->count();

        $completed = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->whereNotNull('doctor_notes')
            ->count();

        $admitted = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->where('status', 'Admitted')
            ->count();

        $discharged = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->where('status', 'Discharged')
            ->count();

        $recentPatients = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'dashboard_cardiology',
            compact(
                'referrals',
                'completed',
                'admitted',
                'discharged',
                'recentPatients'
            )
        );
    }

    public function cardiologyAdmissions()
    {
        $patients = DB::table('admissions')
            ->join('patients', 'admissions.patient_id', '=', 'patients.PatientID')
            ->where('patients.specialist_department', 'Cardiology')
            ->where('patients.decision', 'Admit')
            ->where('patients.assigned_doctor', session('userID'))
            ->select(
                'patients.*', 
                'admissions.diagnosis_status'
            )
            ->get();

        return view('cardiology_admissions', compact('patients'));
    }

    public function cardiologyReferrals()
    {
        $patients = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->where('status', 'Referred')
            ->where(
                'assigned_doctor',
                session('userID')
            )
            ->get();

        return view(
            'cardiology_referrals',
            compact('patients')
        );
    }

    public function cardiologyHistory()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Cardiology')
            ->whereNotNull('doctor_notes')
            ->get();

        return view(
            'cardiology_history',
            compact('patients')
        );
    }

    public function cardiologyHistoryDetails($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        return view(
            'cardiology_history_details',
            compact('patient')
        );
    }

    public function cardiologyProfile()
    {
        $doctor = DB::table('users')
            ->where('userID', session('userID'))
            ->first();

        return view(
            'cardiology_profile',
            compact('doctor')
        );
    }

    public function cardiologyPatientRecords()
    {
        $patients = DB::table('patients')
            ->where('specialist_department', 'Cardiology')
            ->get();

        return view(
            'cardiology_patient_records',
            compact('patients')
        );
    }

    public function nurseCardiologyDashboard()
    {
        $totalPatients = DB::table('patients')
            ->where('status','Admitted')
            ->where('specialist_department','Cardiology')
            ->count();

        $vitalRecords = DB::table('patients')
            ->whereNotNull('heart_rate')
            ->count();

        $medicationRecords = DB::table('patients')
            ->whereNotNull('doctor_notes')
            ->count();

        $recentPatients = DB::table('patients')
            ->where('status','Admitted')
            ->where('specialist_department','Cardiology')
            ->latest('PatientID')
            ->take(5)
            ->get();

        return view(
            'dashboard_nurse_cardiology',
            compact(
                'totalPatients',
                'vitalRecords',
                'medicationRecords',
                'recentPatients'
            )
        );
    }

    public function nurseCardiologyVitalsList()
    {
        $patients = DB::table('patients')
            ->where('status','Admitted')
            ->where('specialist_department','Cardiology')
            ->get();

        return view(
            'nurse_cardiology_vitals_list',
            compact('patients')
        );
    }

    public function nurseCardiologyWardPatients()
    {
        $patients = DB::table('patients')
            ->leftJoin('admissions', 'patients.PatientID', '=', 'admissions.patient_id')
            ->where('patients.specialist_department', 'Cardiology')
            ->where('patients.status', 'Admitted')
            ->select(
                'patients.*',
                'admissions.admission_ward',
                'admissions.bed_number'
            )
            ->get();

        return view('nurse_cardiology_ward_patients', compact('patients'));
    }

    public function nurseCardiologyVitals($id)
    {
        $patient = DB::table('patients')
            ->leftJoin('admissions', 'patients.PatientID', '=', 'admissions.patient_id')
            ->where('patients.PatientID', $id)
            ->select(
                'patients.*',
                'admissions.admission_ward',
                'admissions.bed_number'
            )
            ->first();

        return view('nurse_cardiology_vitals', compact('patient'));
    }

    public function saveNurseCardiologyVitals(Request $request, $id)
    {
        // Update vital signs in patients table
        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'temperature'      => $request->temperature,
                'heart_rate'       => $request->heart_rate,
                'respiratory_rate' => $request->respiratory_rate,
                'pulse'            => $request->pulse,
                'sbp'              => $request->sbp,
                'dbp'              => $request->dbp,
                'updated_at'       => now(),
            ]);

        // Update ward & bed in admissions table
        DB::table('admissions')
            ->where('patient_id', $id)
            ->update([
                'admission_ward' => $request->admission_ward,
                'bed_number'     => $request->bed_number,
                'updated_at'     => now(),
            ]);

        return redirect()
            ->back()
            ->with('success', 'Vital signs and ward details updated successfully.');
    }

    public function nurseMedicationRecords()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Cardiology')
            ->get();

        $records = DB::table('medication_records')
            ->join(
                'patients',
                'medication_records.patient_id',
                '=',
                'patients.PatientID'
            )
            ->select(
                'medication_records.*',
                'patients.name'
            )
            ->latest()
            ->get();

        return view(
            'nurse_cardiology_medications',
            compact('patients','records')
        );
    }

    public function saveMedicationRecord(Request $request)
    {
        DB::table('medication_records')
            ->insert([

                'patient_id' => $request->patient_id,
                'medication_name' => $request->medication_name,
                'dosage' => $request->dosage,
                'administration_time' => $request->administration_time,
                'remarks' => $request->remarks,

                'created_at' => now(),
                'updated_at' => now()

            ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Medication record saved successfully.'
            );
    }

    public function nurseCardiologyProfile()
    {
        $nurse = DB::table('users')
            ->where('role','nurse_cardiology')
            ->first();

        return view(
            'nurse_cardiology_profile',
            compact('nurse')
        );
    }

    public function haematologyDashboard()
    {
        $doctorId = session('userID');
        $referrals = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->where('status', 'Referred')
            ->count();

        $completed = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->whereNotNull('doctor_notes')
            ->count();

        $admitted = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->where('status', 'Admitted')
            ->count();

        $discharged = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->where('status', 'Discharged')
            ->count();

        $recentPatients = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'dashboard_haematology',
            compact(
                'referrals',
                'completed',
                'admitted',
                'discharged',
                'recentPatients'
            )
        );
    }

    public function haematologyReferrals()
    {
        $patients = DB::table('patients')
            ->where('specialist_department', 'Haematology')
            ->where('status', 'Referred')
            ->where('assigned_doctor', session('userID'))
            ->get();

        return view('haematology_referrals', compact('patients'));
    }

    public function haematologyHistory()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Haematology')
            ->whereNotNull('doctor_notes')
            ->where('assigned_doctor', session('userID'))
            ->get();

        return view(
            'haematology_history',
            compact('patients')
        );
    }

    public function haematologyHistoryDetails($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID',$id)
            ->first();

        return view(
            'haematology_history_details',
            compact('patient')
        );
    }

    public function haematologyPatientRecords()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Haematology')
            ->where('assigned_doctor', session('userID'))
            ->get();

        return view(
            'haematology_patient_records',
            compact('patients')
        );
    }

    public function haematologyAdmissions()
    {
        $patients = DB::table('admissions')
            ->join('patients', 'admissions.patient_id', '=', 'patients.PatientID')
            ->where('patients.specialist_department', 'Haematology')
            ->where('patients.decision', 'Admit')
            ->where('patients.assigned_doctor', session('userID'))
            ->select(
                'patients.*', 
                'admissions.diagnosis_status'
            )
            ->get();

        return view('haematology_admissions', compact('patients'));
    }

    public function haematologyProfile()
    {
        $doctor = DB::table('users')
            ->where('userID', session('userID'))
            ->first();

        return view(
            'haematology_profile',
            compact('doctor')
        );
    }

    // ================= NURSE HAEMATOLOGY =================

    public function nurseHaematologyDashboard()
    {
        $totalPatients = DB::table('patients')
            ->where('status','Admitted')
            ->where('specialist_department','Haematology')
            ->count();

        $vitalRecords = DB::table('patients')
            ->whereNotNull('heart_rate')
            ->where('specialist_department','Haematology')
            ->count();

        $medicationRecords = DB::table('patients')
            ->where('specialist_department','Haematology')
            ->whereNotNull('doctor_notes')
            ->count();

        $recentPatients = DB::table('patients')
            ->where('status','Admitted')
            ->where('specialist_department','Haematology')
            ->latest('PatientID')
            ->take(5)
            ->get();

        return view(
            'dashboard_nurse_haematology',
            compact(
                'totalPatients',
                'vitalRecords',
                'medicationRecords',
                'recentPatients'
            )
        );
    }

    public function nurseHaematologyWardPatients()
    {
        $patients = DB::table('patients')
            ->leftJoin('admissions', 'patients.PatientID', '=', 'admissions.patient_id')
            ->where('patients.specialist_department', 'Haematology')
            ->where('patients.status', 'Admitted')
            ->select(
                'patients.*',
                'admissions.admission_ward',
                'admissions.bed_number'
            )
            ->get();

        return view(
            'nurse_haematology_ward_patients',
            compact('patients')
        );
    }

    public function nurseHaematologyVitalsList()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Haematology')
            ->where('status','Admitted')
            ->get();

        return view(
            'nurse_haematology_vitals_list',
            compact('patients')
        );
    }

    public function nurseHaematologyVitals($id)
    {
        $patient = DB::table('patients')
            ->leftJoin('admissions', 'patients.PatientID', '=', 'admissions.patient_id')
            ->where('patients.PatientID', $id)
            ->select(
                'patients.*',
                'admissions.admission_ward',
                'admissions.bed_number'
            )
            ->first();

        return view(
            'nurse_haematology_vitals',
            compact('patient')
        );
    }

    public function saveNurseHaematologyVitals(Request $request, $id)
    {
        // 1. Update vital signs in patients table
        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'temperature'      => $request->temperature,
                'heart_rate'       => $request->heart_rate,
                'respiratory_rate' => $request->respiratory_rate,
                'pulse'            => $request->pulse,
                'sbp'              => $request->sbp,
                'dbp'              => $request->dbp,
                'updated_at'       => now(),
            ]);

        // 2. Update ward & bed in admissions table
        DB::table('admissions')
            ->where('patient_id', $id)
            ->update([
                'admission_ward' => $request->admission_ward,
                'bed_number'     => $request->bed_number,
                'updated_at'     => now(),
            ]);

        return back()->with(
            'success',
            'Vital signs and ward details updated successfully.'
        );
    }

    public function nurseHaematologyMedicationRecords()
    {
        $patients = DB::table('patients')
            ->where('specialist_department','Haematology')
            ->get();

        $records = DB::table('medication_records')
            ->join(
                'patients',
                'medication_records.patient_id',
                '=',
                'patients.PatientID'
            )
            ->select(
                'medication_records.*',
                'patients.name'
            )
            ->latest()
            ->get();

        return view(
            'nurse_haematology_medications',
            compact('patients','records')
        );
    }

    public function saveHaematologyMedicationRecord(Request $request)
    {
        DB::table('medication_records')
            ->insert([
                'patient_id' => $request->patient_id,
                'medication_name' => $request->medication_name,
                'dosage' => $request->dosage,
                'administration_time' => $request->administration_time,
                'remarks' => $request->remarks,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        return back()->with(
            'success',
            'Medication record saved successfully.'
        );
    }

    public function nurseHaematologyProfile()
    {
        $nurse = DB::table('users')
            ->where('role','nurse_haematology')
            ->first();

        return view(
            'nurse_haematology_profile',
            compact('nurse')
        );
    }

    public function patientDetails($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if(!$patient)
        {
            return redirect('/admin/patients')
                ->with('error', 'Patient not found');
        }

        return view(
            'admin_patient_details',
            compact('patient')
        );
    }

    public function patientManagement(Request $request)
    {
        $query = DB::table('patients');

        if($request->department)
        {
            $query->where('specialist_department', $request->department);
        }

        if($request->status)
        {
            $query->where('status', $request->status);
        }

        if($request->gender)
        {
            $query->where('gender', $request->gender);
        }

        if($request->search)
        {
            if($request->search_type == 'name')
            {
                $query->where('name', 'like', '%'.$request->search.'%');
            }
            elseif($request->search_type == 'ic')
            {
                $query->where('ic_number', 'like', '%'.$request->search.'%');
            }
            elseif($request->search_type == 'passport')
            {
                $query->where('passport_number', 'like', '%'.$request->search.'%');
            }
            else
            {
                $query->where(function($q) use ($request){
                    $q->where('name','like','%'.$request->search.'%')
                      ->orWhere('ic_number','like','%'.$request->search.'%')
                      ->orWhere('passport_number','like','%'.$request->search.'%');
                });
            }
        }

        $patients = $query->orderBy('created_at','desc')->get();

        $doctors = DB::table('users')
            ->where('role', 'like', 'doctor_%')
            ->get();

        return view('admin_patient_management', compact('patients', 'doctors'));
    }

    public function haematologyReferralDetails($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        return view(
            'haematology_history_details',
            compact('patient')
        );
    }

    public function dischargePatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found');
        }

        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'status' => 'Discharged',
                'decision' => 'Discharge',
                'discharged_at' => now(),
                'updated_at' => now()
            ]);

        DB::table('admissions')
            ->where('patient_id', $id)
            ->where('diagnosis_status', 'Pending')
            ->update([
                'diagnosis_status' => 'Discharged',
                'updated_at' => now()
            ]);

        return redirect('/haematology/patient-records')
            ->with('success', 'Patient has been discharged successfully.');
    }

    public function dischargeCardiologyPatient($id)
    {
        $patient = DB::table('patients')
            ->where('PatientID', $id)
            ->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found');
        }

        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'status' => 'Discharged',
                'decision' => 'Discharge',
                'discharged_at' => now(),
                'updated_at' => now()
            ]);

        DB::table('admissions')
            ->where('patient_id', $id)
            ->where('diagnosis_status', 'Pending')
            ->update([
                'diagnosis_status' => 'Discharged',
                'updated_at' => now()
            ]);

        return redirect('/cardiology/patient-records')
            ->with('success', 'Patient has been discharged successfully.');
    }

    public function adminDashboard()
    {
        $totalStaff = DB::table('users')
            ->where('role', '!=', 'admin')
            ->count();

        $totalPatients = DB::table('patients')->count();
        
        $waitingCount = DB::table('patients')
            ->where('status', 'Waiting')
            ->count();
            
        $admittedCount = DB::table('patients')
            ->where('status', 'Admitted')
            ->count();

        return view('dashboard_admin', compact(
            'totalStaff', 
            'totalPatients', 
            'waitingCount', 
            'admittedCount'
        ));
    }

    public function doctorAvailability()
    {
        $doctors = DB::table('users')
            ->whereIn('role', ['doctor_haematology', 'doctor_cardiology'])
            ->get();

        $activeDoctorIDs = DB::table('available_doctors')
            ->pluck('userID')
            ->toArray();

        return view('doctor_availability', compact('doctors', 'activeDoctorIDs'));
    }

    public function saveAvailability(Request $request)
    {
        if ($request->has('is_form_submitted')) {
            
            $selectedDoctors = $request->input('doctor', []);

            DB::table('available_doctors')->truncate();

            if (!empty($selectedDoctors)) {
                foreach ($selectedDoctors as $id) {
                    DB::table('available_doctors')->insert([
                        'userID' => $id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Doctor roster availability updated successfully!');
        }

        return redirect()->back();
    }

    public function markDeceased(Request $request, $id)
    {
        $request->validate([
            'death_type'     => 'required|in:Sudden,Expected',
            'time_of_death'  => 'required|date',
            'cause_of_death' => 'required|string',
            'declared_by'    => 'required|string',
        ]);

        DB::table('patients')
            ->where('PatientID', $id)
            ->update([
                'status'          => 'Deceased',
                'death_type'      => $request->death_type,
                'time_of_death'   => $request->time_of_death,
                'cause_of_death'  => $request->cause_of_death,
                'declared_by'     => $request->declared_by,
                'mortality_notes' => $request->mortality_notes,
                'updated_at'      => now(),
            ]);

        DB::table('admissions')
            ->where('patient_id', $id)
            ->update([
                'admission_ward' => null,
                'bed_number'     => null,
                'updated_at'     => now(),
            ]);

        return redirect()->back()->with('success', 'Patient status updated to Deceased. Ward and bed cleared successfully.');
    }
}