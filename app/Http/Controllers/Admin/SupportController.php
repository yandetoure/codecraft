<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::with(['client', 'project'])->latest()->paginate(15);
        return view('admin.support.index', compact('tickets'));
    }

    public function show(SupportTicket $ticket)
    {
        $ticket->load(['messages.user', 'project', 'client']);
        return view('admin.support.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'is_internal' => 'boolean'
        ]);

        $ticket->addMessage(Auth::id(), $validated['message'], $validated['is_internal'] ?? false);

        return back()->with('success', 'Réponse envoyée au client.');
    }

    public function updateStatus(Request $request, SupportTicket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,resolved,closed'
        ]);

        $ticket->update(['status' => $validated['status']]);

        return back()->with('success', 'Statut du ticket mis à jour.');
    }
}
