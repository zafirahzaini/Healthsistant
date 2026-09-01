@php

$totalRecords = count($data);

$male = 0;
$female = 0;

$diseaseCounts = [];

foreach($data as $row){

    if(
        strtolower($row['Gender'] ?? '')
        == 'male'
    ){
        $male++;
    }

    if(
        strtolower($row['Gender'] ?? '')
        == 'female'
    ){
        $female++;
    }

    $disease =
        $row['ICD_Title'] ??
        'Unknown';

    $diseaseCounts[$disease] =
        ($diseaseCounts[$disease] ?? 0) + 1;
}

arsort($diseaseCounts);

$topDisease =
    array_key_first($diseaseCounts);

@endphp