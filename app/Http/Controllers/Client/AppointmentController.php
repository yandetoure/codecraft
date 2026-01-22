<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('client_id', Auth::id())
            ->with(['project', 'assignedUser'])
            ->latest()
            ->paginate(15);

        return view('client.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $projects = Project::where('client_id', Auth::id())
            ->whereIn('status', ['developing', 'testing', 'completed'])
            ->get();

        return view('client.appointments.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|in:consultation,support,training,other',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preferred_date' => 'required|date|after:now',
        ]);

        // Security check: ensure project belongs to client
        $project = Project::where('id', $validated['project_id'])
            ->where('client_id', Auth::id())
            ->firstOrFail();

        // Create appointment request (status pending by default from db/model usually, or set here)
        $appointment = new Appointment();
        $appointment->project_id = $project->id;
        $appointment->client_id = Auth::id();
        $appointment->assigned_to = null; // Will be assigned by admin
        $appointment->type = $validated['type'];
        $appointment->subject = $validated['subject'];
        $appointment->description = $validated['description'];
        $appointment->scheduled_at = $validated['preferred_date'];
        $appointment->duration_minutes = 30; // Default
        $appointment->status = 'scheduled'; // Or 'requested' if we had that status, but 'scheduled' is fine effectively acting as a request until confirmed
        $appointment->save();

        return redirect()->route('client.appointments.index')
            ->with('success', 'Votre demande de rendez-vous a été envoyée.');
    }

    public function show(Appointment $appointment)
    {
        if ($appointment->client_id !== Auth::id()) {
            abort(403);
        }

        return view('client.appointments.show', compact('appointment'));
    }
}
