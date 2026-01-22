<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Pack;
use App\Services\ProjectService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;
    protected $notificationService;

    public function __construct(ProjectService $projectService, NotificationService $notificationService)
    {
        $this->projectService = $projectService;
        $this->notificationService = $notificationService;
    }

    public function index(Request $request)
    {
        $query = Project::with(['client', 'pack']);

        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        $projects = $query->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load(['client', 'pack', 'features', 'quotes', 'invoices', 'paymentSchedules', 'statusHistories.user']);
        return view('admin.projects.show', compact('project'));
    }

    public function updateStatus(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', array_keys(config('codecraft.project_statuses'))),
            'notes' => 'nullable|string',
        ]);

        $this->projectService::updateStatus($project, $validated['status'], $validated['notes']);

        $this->notificationService->notifyStatusUpdate($project);

        return back()->with('success', 'Statut du projet mis à jour.');
    }

    public function generateQuote(Project $project)
    {
        $quote = $this->projectService->generateQuote($project);

        $this->notificationService->notifyQuoteGenerated($quote);

        return back()->with('success', 'Devis généré et envoyé au client.');
    }

    public function generateInvoice(Project $project)
    {
        $acceptedQuote = $project->quotes()->where('status', 'accepted')->latest()->first();

        if (!$acceptedQuote) {
            return back()->with('error', 'Aucun devis accepté trouvé pour ce projet.');
        }

        $invoice = $this->projectService->convertToInvoice($acceptedQuote);

        return back()->with('success', 'Facture générée avec succès.');
    }
}
