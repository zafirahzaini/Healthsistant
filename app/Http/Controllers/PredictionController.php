<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PredictionController extends Controller
{
    public function index()
    {
        return view('prediction');
    }

    public function upload(Request $request)
    {
    $request->validate([
        'dataset' => 'required|mimes:csv,txt'
    ]);
    $file = $request->file('dataset');
    // Check file extension
    $extension = $file->getClientOriginalExtension();
    if(strtolower($extension) != 'csv')
    {
        return back()->with(
            'error',
            'Invalid file format. Please upload CSV files only.'
        );
    }

    $handle = fopen($file->getRealPath(),'r');
    $header = fgetcsv($handle);
    $requiredColumns = [
    'temperature',
    'heartrate',
    'resprate',
    'o2sat',
    'sbp',
    'dbp',
    'pain',
    'acuity',
    'chiefcomplaint',
    'gender',
    'race',
    'disposition',
    'icd_title'
];

    foreach($requiredColumns as $column)
    {
        if(!in_array($column, $header))
        {
            fclose($handle);

            return back()->with(
                'error',
                'Wrong dataset format. Missing column: '.$column
            );
        }
    }
    $data = [];
    while(($row = fgetcsv($handle)) !== false)
    {
        $tempRow = array_combine(
            $header,
            $row
        );

        $gender =
        $request->gender ?? '';
        $race =
        $request->race ?? '';
        $disposition =
        $request->disposition ?? '';

        if(
            $gender != '' &&
            $gender != 'All Gender'
        )
        {
            if(
                strtoupper($tempRow['gender'])
                != strtoupper(substr($gender,0,1))
            ){
                continue;
            }
        }

        if(
            $race != '' &&
            $race != 'All Race'
        )
        {
            if($tempRow['race'] != $race){
                continue;
            }
        }

        if(
            $disposition != '' &&
            $disposition != 'All Disposition'
        )
        {
            if(
                $tempRow['disposition']
                != $disposition
            ){
                continue;
            }
        }
        $data[] = $tempRow;

    }

    fclose($handle);
    return view(
        'prediction_result',
        compact('data')
    );
}
}