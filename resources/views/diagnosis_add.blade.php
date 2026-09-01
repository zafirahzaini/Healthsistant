<h2>Add Diagnosis</h2>

<form method="POST" action="/diagnosis/add">
    @csrf

    Admission:
    <select name="AdmissionID">
        @foreach($admissions as $a)
            <option value="{{ $a->AdmissionID }}">
                Admission {{ $a->AdmissionID }} ({{ $a->chief_complaint }})
            </option>
        @endforeach
    </select><br><br>

    Disease:
    <select name="DiseaseID">
        @foreach($diseases as $d)
            <option value="{{ $d->DiseaseID }}">
                {{ $d->disease_name }}
            </option>
        @endforeach
    </select><br><br>

    Acuity Level:
    <select name="acuity_level">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br><br>

    <button type="submit">Save Diagnosis</button>
</form>