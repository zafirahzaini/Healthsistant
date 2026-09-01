<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientJourneyController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('patients');

        // Optional status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $patients = $query->latest()->get();

        // Summary counts for dashboard metrics
        $counts = [
            'total'      => DB::table('patients')->count(),
            'admitted'   => DB::table('patients')->where('status', 'Admitted')->count(),
            'discharged' => DB::table('patients')->where('status', 'Discharged')->count(),
            'deceased'   => DB::table('patients')->where('status', 'Deceased')->count(),
        ];

        return view('patient_journey', compact('patients', 'counts'));
    }

    public function show($id)
{
    $patient = DB::table('patients')
        ->leftJoin('admissions', 'patients.PatientID', '=', 'admissions.patient_id')
        ->leftJoin('users', 'patients.assigned_doctor', '=', 'users.userID')
        ->where('patients.PatientID', $id)
        ->select(
            'patients.*',
            DB::raw("COALESCE(admissions.admission_ward, 'Not Admitted / Outpatient') as ward_name"),
            DB::raw("COALESCE(admissions.bed_number, 'N/A') as bed_number"),
            DB::raw("COALESCE(users.name, patients.assigned_doctor, 'Unassigned') as doctor_name")
        )
        ->first();

    if (!$patient) {
        return redirect('/admin/journey')->with('error', 'Patient not found');
    }

    $currentStep = 1;

    if ($patient->doctor_seen_at || $patient->doctor_notes) {
        $currentStep = 2;
    }

    if ($patient->specialist_department) {
        $currentStep = 3;
    }

    if ($patient->status == 'Referred' && $patient->doctor_seen_at) {
        $currentStep = 4;
    }

    if ($patient->status == 'Admitted' || $patient->admitted_at) {
        $currentStep = 5;
    }

    if (
        $patient->status == 'Discharged' || 
        $patient->discharged_at || 
        $patient->status == 'Deceased' || 
        !empty($patient->time_of_death)
    ) {
        $currentStep = 6;
    }

    return view(
        'patient_journey_details',
        compact('patient', 'currentStep')
    );
}
}