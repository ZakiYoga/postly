<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\auth\PasswordResetLinkRequest;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PasswordResetLinkRequest $request): RedirectResponse
    {
        Log::info('Attempting to send reset link to: ' . $request->email);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        Log::info('Password reset status: ' . $status);

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link has been sent to your email. Please check your inbox or spam folder.');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => $this->getResetLinkErrorMessage($status)]);


        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                 ->withErrors(['email' => __($status)]);
    }

    private function getResetLinkErrorMessage(string $status): string
    {
        return match ($status) {
            Password::RESET_THROTTLED => 'Too many attempts. Please try again in a few minutes.',
            Password::INVALID_USER => 'Email not found in the system.',
            default => 'An error occurred while sending the password reset link. Please try again.',
        };
    }
}
