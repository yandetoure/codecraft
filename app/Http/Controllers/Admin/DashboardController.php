<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'active_projects' => Project::active()->count(),
            'revenue' => Invoice::paid()->sum('total_amount'),
            'pending_quotes' => Quote::where('status', 'sent')->count(),
            'open_tickets' => SupportTicket::open()->count(),
        ];

        $recent_projects = Project::with('client', 'pack')->latest()->take(5)->get();
        $recent_tickets = SupportTicket::with('client', 'project')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_projects', 'recent_tickets'));
    }
}
