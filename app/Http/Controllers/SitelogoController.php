<?php

namespace App\Http\Controllers;

use App\Models\Sitelogo;
use Illuminate\Http\Request;

class SitelogoController extends Controller
{
    public function UpdateLogo(Request $request, $id)
    {
        // Retrieve the specific logo by ID
        $data = Sitelogo::findOrFail($id);

        try {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Replace the previous logo image if it exists
            if ($data->logo) {
                @unlink(public_path('upload/logo/' . $data->logo));  // Ensure you're referencing the correct column ('logo' instead of 'photo')
            }

            // Save the new file with a unique name to avoid conflicts
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/logo'), $filename);

            // Update the 'logo' field with the new filename
            $data->logo = $filename;

        }

        // Save the updated data
        $data->save();

        // Redirect with success message
            return redirect()->route('admin.settings')->with([
                'message' => 'Logo updated successfully!',
                'alert-type' => 'success'
            ]);

            } catch (\Exception $e) {
            // Redirect with error message if something goes wrong
            return redirect()->route('admin.settings')->with([
                'message' => 'Unable to update logo. Please try again later.',
                'alert-type' => 'error'
            ]);
        }
        // return redirect()->back()->with('success', 'Logo updated successfully!');
    }
}
