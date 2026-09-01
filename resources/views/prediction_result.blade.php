@php

$totalRecords = count($data);

$male = 0;
$female = 0;

$raceCounts = [];
$dispositionCounts = [];
$diseaseCounts = [];

$maleDisease = [];
$femaleDisease = [];

$uniqueDiseases = [];
$uniqueRaces = [];
$uniqueDispositions = [];

foreach($data as $row){

$gender = trim($row['gender'] ?? '');
$race = trim($row['race'] ?? '');
$disposition = trim($row['disposition'] ?? '');
$disease = trim($row['icd_title'] ?? 'Unknown');

if($disease != '')
{
    $uniqueDiseases[$disease] = true;
}

if($race != '')
{
    $uniqueRaces[$race] = true;
}

if($disposition != '')
{
    $uniqueDispositions[$disposition] = true;
}

// Gender Count
if(strtoupper($gender) == 'M'){
    $male++;
}

if(strtoupper($gender) == 'F'){
    $female++;
}

// Race Count
if($race != ''){
    $raceCounts[$race] =
        ($raceCounts[$race] ?? 0) + 1;
}

// Disposition Count
if($disposition != ''){
    $dispositionCounts[$disposition] =
        ($dispositionCounts[$disposition] ?? 0) + 1;
}

// Disease Count
$diseaseCounts[$disease] =
    ($diseaseCounts[$disease] ?? 0) + 1;

// Disease by Gender
if(strtoupper($gender) == 'M'){

    $maleDisease[$disease] =
        ($maleDisease[$disease] ?? 0) + 1;

}else{

    $femaleDisease[$disease] =
        ($femaleDisease[$disease] ?? 0) + 1;
}

}

$totalDiseases = count($uniqueDiseases);
$totalRaces = count($uniqueRaces);
$totalDispositions = count($uniqueDispositions);

arsort($diseaseCounts);

$topDisease =
array_key_first($diseaseCounts);

$topDiseases =
array_slice(
$diseaseCounts,
0,
10,
true
);

@endphp

<!DOCTYPE html>

<html>
<head>

<title>Disease Trend Prediction & Analytics</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:
        linear-gradient(
            135deg,
            #fff8f8,
            #fef2f2
        );
    min-height:100vh;
}

.main-container{
    display:flex;
}

.content{
    flex:1;
    padding:40px;
    width:calc(100% - 260px);

    background:
    radial-gradient(
        circle at top right,
        rgba(127,29,29,0.08),
        transparent 30%
    );
}

.topbar{
    margin-bottom:40px;
}

.topbar h1{
    font-size:40px;
    color:#111827;
    margin-bottom:10px;
}

.topbar p{
    color:#6b7280;
    font-size:16px;
}

.overview{
    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    margin-bottom:40px;
}

.overview-card{

    background:white;

    border-radius:28px;

    padding:30px;

    position:relative;

    overflow:hidden;

    border:1px solid rgba(127,29,29,.08);

    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

.overview-card::before{

    content:"";

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:5px;

    background:
    linear-gradient(
        90deg,
        #7f1d1d,
        #dc2626
    );
}

.overview-icon{

    width:60px;
    height:60px;

    border-radius:18px;

    display:flex;
    justify-content:center;
    align-items:center;

    margin-bottom:20px;

    background:
    linear-gradient(
        135deg,
        #fee2e2,
        #fecaca
    );
    color:#991b1b;
    font-size:22px;
}

.overview-card h2{

    font-size:34px;
    margin-bottom:10px;
    color:#111827;
}

.overview-card p{
    color:#6b7280;
}

.filters-card{

    background:white;
    border-radius:25px;
    padding:25px;
    margin-bottom:35px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

.filters{
    display:grid;
    grid-template-columns:
    repeat(3,1fr);
    gap:20px;
}

.filters select{

    width:100%;
    padding:14px;
    border-radius:12px;
    border:1px solid #ddd;
    font-family:'Poppins';
}

.chart-grid{

    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(450px,1fr));
    gap:25px;
    margin-bottom:30px;
}

.chart-card{

    background:white;
    border-radius:25px;
    padding:30px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

.chart-card h3{

    margin-bottom:25px;
    color:#111827;
}

canvas{
    max-height:350px;
}

.table-card{

    background:white;
    padding:30px;
    border-radius:25px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

.table-card h3{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{

    background:#7f1d1d;
    color:white;
    padding:20px;
}

table td{

    padding:20px;
    border-bottom:
    1px solid #eee;
}

</style>
</head>
<body>

<div class="main-container">

@include('layouts.admin_sidebar')

<div class="content">
<div class="topbar">

<h1>
    <i class="fa-solid fa-chart-line"></i>
    Disease Trend Prediction & Analytics
</h1>

<p>
    Upload dataset and generate disease trend analytics
</p>

</div>

{{-- OVERVIEW CARDS --}}

<div class="overview">

<div class="overview-card">
    <div class="overview-icon">
        <i class="fa-solid fa-database"></i>
    </div>
    <h2 id="totalRecordsCard">
    {{ number_format($totalRecords) }}
</h2>
    <p>Total Records</p>
</div>

<div class="overview-card">
    <div class="overview-icon">
        <i class="fa-solid fa-virus"></i>
    </div>
    <h2 id="totalDiseasesCard">
    {{ $totalDiseases }}
</h2>
    <p>Total Diseases</p>

</div>

<div class="overview-card">
    <div class="overview-icon">
        <i class="fa-solid fa-chart-line"></i>
    </div>
    <h2
    id="mostCommonDiseaseCard"
    style="font-size:20px;">
        {{ Str::limit($topDisease,25) }}
    </h2>
    <p>Most Common Disease</p>
</div>

<div class="overview-card">
    <div class="overview-icon">
        <i class="fa-solid fa-hospital-user"></i>
    </div>

    <h2 id="dispositionTypesCard">
        {{ $totalDispositions }}
    </h2>
    <p>Disposition Types</p>
</div>


</div>

{{-- FILTERS --}}

<div class="filters-card">
<div class="filters">

    <select id="genderFilter">
        <option value="all">
            All Gender
        </option>
        <option value="M">
            Male
        </option>
        <option value="F">
            Female
        </option>
    </select>

    <select id="raceFilter">
        <option value="all">
            All Race
        </option>
        @foreach(array_keys($raceCounts) as $race)
        <option value="{{ $race }}">
            {{ $race }}
        </option>
        @endforeach
    </select>

    <select id="dispositionFilter">
        <option value="all">
            All Disposition
        </option>
        @foreach(array_keys($dispositionCounts) as $disp)
        <option value="{{ $disp }}">
            {{ $disp }}
        </option>
        @endforeach
    </select>
</div>
</div>

{{-- CHARTS --}}

<div class="chart-grid">
<div class="chart-card">

    <h3>Top 10 Diseases</h3>

    <canvas id="topDiseaseChart"></canvas>

</div>

<div class="chart-card">

    <h3>Gender Distribution</h3>

    <canvas id="genderChart"></canvas>

</div>

</div>

<div class="chart-grid">

<div class="chart-card">

    <h3>Disposition Distribution</h3>

    <canvas id="dispositionChart"></canvas>

</div>

<div class="chart-card">

    <h3>Disease By Gender</h3>

    <canvas id="diseaseGenderChart"></canvas>

</div>
</div>
{{-- ANALYTICS TABLE --}}
<div class="table-card">
<h3>Top 10 Diseases Analytics</h3>

<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Disease Name</th>
        <th>Total Cases</th>
    </tr>
    </thead>
    <tbody>
    @php $i = 1; @endphp
    @foreach($topDiseases as $disease => $count)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $disease }}</td>
        <td>{{ $count }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
</div>
<script>
const rawData = @json($data);

console.log(rawData[0]);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const diseaseLabels = [

@foreach(array_keys($topDiseases) as $disease)

"{{ addslashes($disease) }}",

@endforeach

];

const diseaseValues = [

@foreach(array_values($topDiseases) as $count)

{{ $count }},

@endforeach

];

const topDiseaseChart = new Chart(
document.getElementById('topDiseaseChart'),
{
    type:'bar',

    data:{
        labels:diseaseLabels,

        datasets:[{
            label:'Cases',
            data:diseaseValues,
            backgroundColor:'#991b1b',
            borderRadius:8
        }]
    },

    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        }
    }
});

const genderChart = new Chart(
document.getElementById('genderChart'),
{
    type:'pie',

    data:{
        labels:[
            'Male',
            'Female'
        ],

        datasets:[{
            data:[
                {{ $male }},
                {{ $female }}
            ],

            backgroundColor:[
                '#991b1b',
                '#fca5a5'
            ]
        }]
    }
});

const dispositionLabels = [

@foreach(array_keys($dispositionCounts) as $disp)

"{{ $disp }}",

@endforeach

];

const dispositionValues = [
@foreach(array_values($dispositionCounts) as $count)
{{ $count }},
@endforeach

];

const dispositionChart = new Chart(
document.getElementById('dispositionChart'),
{
    type:'pie',

    data:{
        labels:dispositionLabels,
        datasets:[{
            data:dispositionValues,

            backgroundColor:[
                '#7f1d1d',
                '#991b1b',
                '#dc2626',
                '#ef4444',
                '#f87171',
                '#fca5a5'
            ]
        }]
    }
});

const diseaseGenderLabels = [
@foreach(array_keys($topDiseases) as $disease)
"{{ addslashes($disease) }}",

@endforeach

];

const maleDiseaseValues = [
@foreach(array_keys($topDiseases) as $disease)
{{ $maleDisease[$disease] ?? 0 }},
@endforeach

];

const femaleDiseaseValues = [
@foreach(array_keys($topDiseases) as $disease)
{{ $femaleDisease[$disease] ?? 0 }},

@endforeach

];

const diseaseGenderChart = new Chart(
document.getElementById('diseaseGenderChart'),
{
    type:'bar',

    data:{
        labels:diseaseGenderLabels,
        datasets:[

        {
            label:'Male',
            data:maleDiseaseValues,
            backgroundColor:'#991b1b'
        },

        {
            label:'Female',
            data:femaleDiseaseValues,
            backgroundColor:'#fca5a5'
        }

        ]
    },

    options:{
        responsive:true,
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});

function applyFilters()
{
    const gender =
    document.getElementById('genderFilter').value;

    const race =
    document.getElementById('raceFilter').value;

    const disposition =
    document.getElementById('dispositionFilter').value;

    let filtered = rawData.filter(row => {

        let genderMatch =
        gender == 'all' ||
        row.gender == gender;

        let raceMatch =
        race == 'all' ||
        row.race == race;

        let dispositionMatch =
        disposition == 'all' ||
        row.disposition == disposition;

        return (
            genderMatch &&
            raceMatch &&
            dispositionMatch
        );
    });

    // TOP DISEASE CHART

    let diseaseCounts = {};

    filtered.forEach(row => {

        let disease =
        row.icd_title || 'Unknown';

        diseaseCounts[disease] =
        (diseaseCounts[disease] || 0) + 1;

    });

    let sortedDiseases =
    Object.entries(diseaseCounts)
    .sort((a,b) => b[1]-a[1])
    .slice(0,10);

    topDiseaseChart.data.labels =
    sortedDiseases.map(item => item[0]);

    topDiseaseChart.data.datasets[0].data =
    sortedDiseases.map(item => item[1]);

    topDiseaseChart.update();

    // GENDER CHART

    let male = 0;
    let female = 0;

    filtered.forEach(row => {

        if(
            String(row.gender)
            .toUpperCase() == 'M'
        ){
            male++;
        }

        if(
            String(row.gender)
            .toUpperCase() == 'F'
        ){
            female++;
        }

    });

    genderChart.data.datasets[0].data = [
        male,
        female
    ];

    genderChart.update();

    // DISPOSITION CHART

    let dispositionCounts = {};

    filtered.forEach(row => {

        let disp =
        row.disposition || 'Unknown';

        dispositionCounts[disp] =
        (dispositionCounts[disp] || 0) + 1;

    });

    dispositionChart.data.labels =
    Object.keys(dispositionCounts);

    dispositionChart.data.datasets[0].data =
    Object.values(dispositionCounts);

    dispositionChart.update();
}

document
.getElementById('genderFilter')
.addEventListener(
'change',
applyFilters
);

document
.getElementById('raceFilter')
.addEventListener(
'change',
applyFilters
);

document
.getElementById('dispositionFilter')
.addEventListener(
'change',
applyFilters
);
</script>

</body>
</html>
