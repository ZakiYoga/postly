<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
        ]);

        if (NewsletterSubscriber::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'This email is already subscribed.!');;
        }

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Thanks for subscribing!');
    }
}
