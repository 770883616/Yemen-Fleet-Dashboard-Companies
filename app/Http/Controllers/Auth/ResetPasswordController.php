<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email_company' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        $status = Password::broker('companies')->reset(
            $request->only('email_company', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('company.login')->with('status', __($status))
            : back()->withErrors(['email_company' => [__($status)]]);
    }
}
