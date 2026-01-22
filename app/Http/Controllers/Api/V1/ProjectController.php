<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->with('pack')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $projects
        ]);
    }

    public function show(Project $project)
    {
        if ($project->client_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }

        $project->load(['pack', 'features', 'quotes', 'invoices', 'paymentSchedules', 'statusHistories']);

        return response()->json([
            'status' => 'success',
            'data' => $project
        ]);
    }
}
