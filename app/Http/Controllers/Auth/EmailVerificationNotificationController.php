<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // Rate limiting
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if user is already verified
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home', absolute: false));
        }

        // Limit to 5 requests in 1 hour (or customize as needed)
        $cacheKey = 'verification-email-sent-' . $user->id;
        $emailCount = cache()->get($cacheKey, 0);

        if ($emailCount >= 5) {
            return redirect()->back()->with('status', 'You have reached the maximum number of email verification requests. Please try again later.');
        }

        // Send verification email
        $request->user()->sendEmailVerificationNotification();

        // Increment the counter
        cache()->put($cacheKey, $emailCount + 1, 3600); // Store count for 1 hour

        return redirect()->back()->with('status', 'A new verification link has been sent to your email address.');
    }
}

