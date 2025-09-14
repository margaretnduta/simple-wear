<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email','max:255'],
        ]);

        // Avoid duplicates (idempotent)
        Subscription::firstOrCreate(['email' => $data['email']]);

        return back()->with('newsletter_status', 'Thanks! You are now subscribed.');
    }
}
