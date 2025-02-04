<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BugReportMail;

class BugReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'description' => $validated['description'],
            'images' => $request->file('images'),
        ];

        try {
            $recipientEmail = env('SUPPORT_EMAIL');
            Mail::to($recipientEmail)->send(new BugReportMail($data));

            Log::info("success");
            // Success message
            return back()->with('status', 'bug-report-success');
        } catch (\Exception $e) {
            // Error message
            Log::info("fail");
            return back()->with('status', 'bug-report-failure');
        }
    }

}

