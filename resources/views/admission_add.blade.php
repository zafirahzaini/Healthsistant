<h2>Add Admission</h2>

<form method="POST" action="/admission/add">
    @csrf

    Chief Complaint:
    <input type="text" name="chief_complaint" required><br><br>

    Deposition:
    <input type="text" name="deposition"><br><br>

    Patient:
    <select name="PatientID" required>
        @foreach($patients as $p)
            <option value="{{ $p->PatientID }}">
                ID {{ $p->PatientID }} (Age: {{ $p->age }})
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Save Admission</button>
</form>