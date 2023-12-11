<?php
// app/Http/Controllers/PatientController.php

namespace App\Http\Controllers;

use App\Models\CustomerCredentials;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function showQueue()
    {
        // Fetch the list of users in the queue
        $queue = CustomerCredentials::where('pregnancyStatus', true)->get();

        return view('queue.show', compact('queue'));
    }

    public function joinQueue(Request $request, $patientId)
    {
        // Validate the request if needed
        $request->validate([
            'join_queue' => 'required|boolean',
        ]);

        // Find the user by ID
        $user = CustomerCredentials::find($patientId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user is already in the queue
        if ($user->pregnancyStatus) {
            return response()->json(['message' => 'User is already in the queue'], 400);
        }

        // Update the pregnancyStatus to true if the request is true
        if ($request->input('join_queue')) {
            $user->update(['pregnancyStatus' => true]);

            return response()->json(['message' => 'User joined the queue successfully']);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function setDuration(Request $request, $patientId)
    {
        // Validate the request if needed
        $request->validate([
            'duration' => 'required|integer|between:1,9',
        ]);

        // Find the user by ID
        $user = CustomerCredentials::find($patientId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Set the duration for the user
        $user->update(['duration' => $request->input('duration')]);

        return response()->json(['message' => 'Duration set successfully']);
    }
}
