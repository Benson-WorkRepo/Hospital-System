<?php
// app/Http/Controllers/PatientController.php

namespace App\Http\Controllers;

use App\Models\CustomerCredentials;
use App\Models\ward_credentials;
use App\Models\pregnancyinfo;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // ... other methods ...

    public function searchPatients(Request $request)
    {
        $status = $request->input('status', 'false'); // default to false if not provided
        $patients = CustomerCredentials::where('pregnancyStatus', $status)->get();

        return view('admindashboard', compact('patients')); // Update the view name accordingly
    }

    public function togglePregnancyStatus($patientId)
    {
        $user = CustomerCredentials::find($patientId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Toggle pregnancyStatus
        $user->update(['pregnancyStatus' => !$user->pregnancyStatus]);

        if ($user->pregnancyStatus) {
            // If set to true, add to PregnancyInfo table
            pregnancyinfo::create([
                'ID' => $user->ID,
                'Duration' => $user->duration, // assuming duration is set for the user
                'ward' => null, // set to null initially, to be updated later
                'bedNo' => null, // set to null initially, to be updated later
            ]);

            // Add to WardCredentials table
            ward_credentials::create([
                'ID' => $user->ID,
                'ward' => null, // set to null initially, to be updated later
                'bedNo' => null, // set to null initially, to be updated later
                'vacancy' => true, // assuming it's vacant initially
            ]);
        }

        return response()->json(['message' => 'Pregnancy status toggled successfully']);
    }

    public function assignWardAndBed($patientId, $ward, $bedNo)
    {
        $user = CustomerCredentials::find($patientId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update PregnancyInfo table
        pregnancyinfo::where('ID', $user->ID)
            ->update(['ward' => $ward, 'bedNo' => $bedNo]);

        // Update WardCredentials table
        ward_credentials::where('ID', $user->ID)
            ->update(['ward' => $ward, 'bedNo' => $bedNo, 'vacancy' => false]);

        return response()->json(['message' => 'Ward and Bed assigned successfully']);
    }

    public function removeUser($patientId)
    {
        $user = CustomerCredentials::find($patientId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Remove from PregnancyInfo table
        pregnancyinfo::where('ID', $user->ID)->delete();

        // Remove from WardCredentials table
        ward_credentials::where('ID', $user->ID)->delete();

        // Remove from CustomerCredentials table
        $user->delete();

        return response()->json(['message' => 'User removed successfully']);
    }
}