<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        $contacts = Contact::latest()->paginate(12)->through(fn (Contact $contact) => [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'subject' => $contact->subject,
            'message' => $contact->message,
            'ip_address' => $contact->ip_address,
            'is_read' => $contact->is_read,
            'created_at_formatted' => optional($contact->created_at)->format('d/m/Y H:i'),
        ]);

        return Inertia::render('Admin/Contacts/Index', compact('contacts'));
    }

    public function markAsRead(Contact $contact): RedirectResponse
    {
        $contact->update(['is_read' => true]);

        return back()->with('success', 'Đã đánh dấu đã đọc.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Đã xóa liên hệ.');
    }
}
