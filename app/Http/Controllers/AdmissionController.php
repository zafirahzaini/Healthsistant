<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    // ✅ SHOW FORM
    public function create()
    {
        $patients = DB::table('patients')->get();
        return view('admission_add', compact('patients'));
    }

    // ✅ SAVE DATA (Ensuring it matches your database field layout)
    public function store(Request $request)
    {
        DB::table('admissions')->insert([
            'chief_complaint' => $request->chief_complaint,
            'deposition' => $request->deposition,
            'patient_id' => $request->PatientID, // Changed to standard lower_case relation format
            'in_time' => now(),
            'out_time' => null,
            'seq_num' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/admission/list')->with('success', 'Admission added!');
    }

    // ✅ SHOW LIST (FIXED JOIN: Changed to admissions.patient_id)
    public function index()
{
    // Match admissions.patient_id to patients.PatientID exactly as seen in your HeidiSQL tables
    $admissions = DB::table('admissions')
        ->join('patients', 'admissions.patient_id', '=', 'patients.PatientID')
        ->select(
            'admissions.*', 
            'patients.name', 
            'patients.age', 
            'patients.gender',
            'patients.symptoms' // Captures the nurse's front desk entries
        )
        ->latest('admissions.created_at')
        ->get();

    return view('admission_list', compact('admissions'));
}
}