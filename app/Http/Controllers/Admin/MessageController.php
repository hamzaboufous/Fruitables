<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Contact $message)
    {
        // Mark as read
        $message->update(['is_read' => true]);
        
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Contact $message)
    {
        $message->delete();
        
        return back()->with('success', 'Message supprimé avec succès');
    }
}
