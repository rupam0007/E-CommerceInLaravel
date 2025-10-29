<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('customer.profile.show', compact('user'));
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
        ]);

        try {
            $user->update($request->only([
                'name', 'email', 'phone', 'address', 'city', 'state', 'postal_code', 'country', 'date_of_birth', 'gender'
            ]));

            return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update profile. Please try again.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Log the user out from other sessions for security
            Auth::logoutOtherDevices($request->current_password);

            return redirect()->route('profile.show')->with('success', 'Password updated successfully! You have been logged out from other devices for security.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update password. Please try again.');
        }
    }
}
