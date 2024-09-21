<?php

namespace App\Http\Controllers;

use App\Models\Signatory;
use App\Models\Sitelogo;
use Illuminate\Http\Request;

class SignatoryController extends Controller
{

    public function ShowSettings(Signatory $signatory)
    {
        $signatories = Signatory::all(); // Retrieve all signatories
        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
        $updateLogos = Sitelogo::all();
        return view('admin.admin_settings', compact('updateLogos', 'signatories', 'logo'));  // Pass signatories & logo to the view
    }

    public function UpdateSignatory(Request $request, $id)
    {
        try {
            // Validate the input
            $validatedData = $request->validate([
                'profTitles' => 'nullable|string|regex:/^[A-Za-z.,\s-]+$/', // Allows letters, dots, spaces, and hyphens
                'firstName' => 'required|string|regex:/^[A-Za-z.\s-]+$/', // Allows letters, dots, spaces, and hyphens
                'middleName' => 'nullable|string|regex:/^[A-Za-z.\s-]+$/', // Allows letters, dots, spaces, and hyphens
                'lastName' => 'required|string|regex:/^[A-Za-z.\s-]+$/', // Allows letters, dots, spaces, and hyphens
                // 'position' => 'nullable|string|regex:/^[A-Za-z.,\s-]+$/' // Allows letters, dots, spaces, and hyphens
            ]);

            // Trim leading and trailing spaces from input fields
            $validatedData['profTitles'] = trim($validatedData['profTitles']);
            $validatedData['firstName'] = trim($validatedData['firstName']);
            $validatedData['middleName'] = trim($validatedData['middleName']);
            $validatedData['lastName'] = trim($validatedData['lastName']);
            // $validatedData['position'] = trim($validatedData['position']);

            // Find the signatory and update
            $signatory = Signatory::findOrFail($id);
            $signatory->update($validatedData);

            // Redirect with success message
            return redirect()->route('admin.settings')->with([
                'message' => 'Signatory updated successfully!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            // Redirect with error message if something goes wrong
            return redirect()->route('admin.settings')->with([
                'message' => 'Unable to update signatory. Please try again later.',
                'alert-type' => 'error'
            ]);
        }
    }
}
