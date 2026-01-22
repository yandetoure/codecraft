<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\Project;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $tickets = Auth::user()->supportTickets()->with('project')->latest()->get();
        return view('client.support.index', compact('tickets'));
    }

    public function create()
    {
        $projects = Auth::user()->projects()->get();
        return view('client.support.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|string|in:' . implode(',', array_keys(config('codecraft.ticket_types'))),
            'priority' => 'required|string|in:' . implode(',', array_keys(config('codecraft.ticket_priorities'))),
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::find($validated['project_id']);
        if ($project->client_id !== Auth::id()) {
            abort(403);
        }

        $ticket = SupportTicket::create([
            'project_id' => $project->id,
            'client_id' => Auth::id(),
            'type' => $validated['type'],
            'priority' => $validated['priority'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        $this->notificationService->notifyNewTicket($ticket);

        return redirect()->route('client.support.index')
            ->with('success', 'Ticket de support créé avec succès.');
    }

    public function show(SupportTicket $ticket)
    {
        if ($ticket->client_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['messages.user', 'project']);
        return view('client.support.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        if ($ticket->client_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->addMessage(Auth::id(), $validated['message']);

        return back()->with('success', 'Réponse envoyée.');
    }
}
