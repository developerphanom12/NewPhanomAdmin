<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function saveOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'email_subject' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'support_url' => 'required|url',
        ]);

        $contact = Contact::first(); // Only one row expected
        if ($contact) {
            $contact->update($validated);
            return redirect()->back()->with('success', $contact ? 'Contact updated!' : 'Contact created!');

        } else {
            Contact::create($validated);
            return redirect()->back()->with('success', $contact ? 'Contact updated!' : 'Contact created!');

        }
    }

    public function getContact()
    {
        $contact = Contact::first();
        return response()->json($contact);
    }
}
