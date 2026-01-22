<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_projects' => $user->projects()->count(),
            'active_projects' => $user->projects()->active()->count(),
            'pending_payments' => $user->projects()
                ->with('invoices')
                ->get()
                ->pluck('invoices')
                ->flatten()
                ->where('status', 'pending')
                ->sum('total_amount'),
            'open_tickets' => $user->supportTickets()->open()->count(),
        ];

        $recent_projects = $user->projects()->with('pack')->latest()->take(3)->get();
        $next_appointments = $user->appointments()->upcoming()->take(3)->get();

        return view('client.dashboard', compact('stats', 'recent_projects', 'next_appointments'));
    }
}
