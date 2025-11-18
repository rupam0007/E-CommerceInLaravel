<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('customer.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,mp4,webm', 'max:10240'], // 10MB Max
        ]);

        // Get only valid fields
        $data = $request->only([
            'name', 'email', 'phone', 'address', 'city', 'state', 'postal_code', 'country', 'date_of_birth', 'gender'
        ]);

        // Handle File Upload
        if ($request->hasFile('avatar')) {
            try {
                $file = $request->file('avatar');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName()); // Sanitize filename
                $mimeType = $file->getMimeType();

                if (str_contains($mimeType, 'video')) {
                    $path = public_path('uploads/profile-videos');
                    
                    // Ensure directory exists
                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0755, true);
                    }

                    // Delete old video
                    if ($user->profile_video && File::exists(public_path($user->profile_video))) {
                        File::delete(public_path($user->profile_video));
                    }
                    
                    $file->move($path, $filename);
                    $data['profile_video'] = 'uploads/profile-videos/' . $filename;
                    $data['profile_image'] = null; // Remove image if video is set
                } else {
                    $path = public_path('uploads/profile-images');

                    // Ensure directory exists
                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0755, true);
                    }

                    // Delete old image
                    if ($user->profile_image && File::exists(public_path($user->profile_image))) {
                        File::delete(public_path($user->profile_image));
                    }

                    $file->move($path, $filename);
                    $data['profile_image'] = 'uploads/profile-images/' . $filename;
                    $data['profile_video'] = null; // Remove video if image is set
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        }

        try {
            $user->update($data);
            return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Return the specific error message to help debugging
            return redirect()->back()->withInput()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logoutOtherDevices($request->current_password);

            return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update password: ' . $e->getMessage());
        }
    }
}