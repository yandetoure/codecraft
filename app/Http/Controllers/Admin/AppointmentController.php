<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['project', 'client', 'assignedUser'])->latest()->paginate(15);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create(Request $request)
    {
        $projects = Project::active()->get();
        $admins = User::role(['admin', 'super_admin'])->get();
        return view('admin.appointments.create', compact('projects', 'admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'type' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_at' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:15',
            'location' => 'nullable|string',
        ]);

        $project = Project::find($validated['project_id']);
        $validated['client_id'] = $project->client_id;
        $validated['status'] = 'scheduled';

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')->with('success', 'Rendez-vous programmé.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:scheduled,confirmed,completed,cancelled,no_show'
        ]);

        $appointment->update(['status' => $validated['status']]);

        return back()->with('success', 'Statut du rendez-vous mis à jour.');
    }
}
