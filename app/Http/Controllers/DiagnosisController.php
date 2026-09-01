<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosisController extends Controller
{
    // Show form
    public function create()
    {
        // 🔒 ROLE CHECK (Doctor only)
        if (session('role') != 'doctor') {

            return redirect('/dashboard')
                ->with('error', 'Access denied');
        }

        // ONLY SHOW PENDING ADMISSIONS
        $admissions = DB::table('admissions')
            ->where('diagnosis_status', 'Pending')
            ->get();

        $diseases = DB::table('diseases')->get();

        return view('diagnosis_add', compact('admissions', 'diseases'));
    }


    // Save diagnosis
    public function store(Request $request)
    {
        // 🔒 ROLE CHECK (Doctor only)
        if (session('role') != 'doctor') {

            return redirect('/dashboard')
                ->with('error', 'Access denied');
        }

        // UPDATE ADMISSION WITH DIAGNOSIS
        DB::table('admissions')
            ->where('AdmissionID', $request->AdmissionID)
            ->update([

                'DiseaseID' => $request->DiseaseID,

                'acuity_level' => $request->acuity_level,

                'diagnosis_status' => 'Diagnosed',

                'updated_at' => now()

            ]);

        return redirect('/diagnosis/list')
            ->with('success', 'Diagnosis added!');
    }


    // Show diagnosis list
    public function index()
    {
        // 🔒 ROLE CHECK
        if (!in_array(session('role'), ['doctor', 'operation manager'])) {

            return redirect('/dashboard')
                ->with('error', 'Access denied');
        }

        // GET DIAGNOSED ADMISSIONS
        $diagnosis = DB::table('admissions')

            ->join('diseases', 'admissions.DiseaseID', '=', 'diseases.DiseaseID')

            ->select(
                'admissions.*',
                'diseases.disease_name'
            )

            ->whereNotNull('admissions.DiseaseID')

            ->get();

        return view('diagnosis_list', compact('diagnosis'));
    }
}