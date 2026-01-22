<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->with('pack')->latest()->get();
        return view('client.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // Ensure user only sees their own projects
        if ($project->client_id !== Auth::id()) {
            abort(403);
        }

        $project->load(['pack', 'features', 'quotes', 'invoices', 'paymentSchedules', 'statusHistories', 'configuration']);
        return view('client.projects.show', compact('project'));
    }

    public function acceptQuote(Quote $quote)
    {
        if ($quote->project->client_id !== Auth::id()) {
            abort(403);
        }

        $quote->accept();

        // Notify admin
        // Notification::send(User::role('admin')->get(), new QuoteAccepted($quote));

        return back()->with('success', 'Devis accepté avec succès.');
    }

    public function rejectQuote(Quote $quote)
    {
        if ($quote->project->client_id !== Auth::id()) {
            abort(403);
        }

        $quote->reject();

        return back()->with('success', 'Devis refusé.');
    }

    public function updateConfiguration(Request $request, Project $project)
    {
        if ($project->client_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'sms_number' => 'nullable|string|max:20',
            'email_sender' => 'nullable|email|max:255',
            'email_sender_name' => 'nullable|string|max:255',
        ]);

        $project->configuration()->update($validated);

        return back()->with('success', 'Paramètres mis à jour.');
    }
}
