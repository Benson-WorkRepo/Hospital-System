<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue List</title>
</head>
<body>
    <h1>Queue List</h1>

    @if ($queue->isEmpty())
        <p>No users in the queue.</p>
    @else
        <ul>
            @foreach ($queue as $user)
                <li>
                    {{ $user->fName }} {{ $user->lName }} - ID: {{ $user->ID }}
                    
                    @if ($user->pregnancyStatus)
                        (Already in the queue)
                    @else
                        <form method="POST" action="{{ route('joinQueue', ['patientNumber' => $user->patientnumber]) }}">
                            @csrf
                            <button type="submit">Join Queue</button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('setDuration', ['patientNumber' => $user->patientnumber]) }}">
                        @csrf
                        <label for="duration">Set Duration (1-9): </label>
                        <input type="number" name="duration" id="duration" min="1" max="9" required>
                        <button type="submit">Set Duration</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
