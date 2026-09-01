<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseaseController extends Controller
{
    // Show form
    public function create()
{
    return view('disease_add');
}

    // Save disease
    public function store(Request $request)
    {
        DB::table('diseases')->insert([
            'disease_name' => $request->disease_name,
            'ICD_version' => $request->ICD_version,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/disease/list')->with('success', 'Disease added!');
    }

    // Show list
    public function index()
    {
        $diseases = DB::table('diseases')->get();
        return view('disease_list', compact('diseases'));
    }
}