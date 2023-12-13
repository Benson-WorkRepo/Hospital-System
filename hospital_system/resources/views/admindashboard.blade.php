<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 10px;
        }

        label {
            margin-right: 10px;
        }

        select {
            padding: 5px;
        }

        button {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Search Patients Form -->
    <form method="GET" action="{{ route('admindashboard') }}">
        @csrf
        <label for="status">Search Patients by Status:</label>
        <select name="status" id="status">
            <option value="true">True</option>
            <option value="false">False</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <!-- Toggle Pregnancy Status Button -->
    @foreach ($patients as $patient)
        <form method="POST" action="{{ route('admindashboard', ['patientId' => $patient->ID]) }}">
            @csrf
            <button type="submit">Toggle Pregnancy Status for {{ $patient->fName }} {{ $patient->lName }}</button>
        </form>
    @endforeach

    <!-- Assign Ward and Bed Button -->
    @foreach ($patients as $patient)
        <form method="POST" action="{{ route('admindashboard', ['patientId' => $patient->ID, 'ward' => 'ID', 'bedNo' => 1]) }}">
            @csrf
            <button type="submit">Assign Ward and Bed for {{ $patient->fName }} {{ $patient->lName }}</button>
        </form>
    @endforeach

    <!-- Remove User Button -->
    @foreach ($patients as $patient)
        <form method="POST" action="{{ route('admindashboard', ['patientId' => $patient->ID]) }}">
            @csrf
            <button type="submit">Remove {{ $patient->fName }} {{ $patient->lName }}</button>
        </form>
    @endforeach
</body>
</html>