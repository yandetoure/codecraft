<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use App\Models\Feature;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackSelectionController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $packs = Pack::active()->with(['service', 'features'])->ordered()->get();
        return view('packs.index', compact('packs'));
    }

    public function show(Pack $pack)
    {
        $pack->load(['service', 'features']);
        return view('packs.show', compact('pack'));
    }

    public function order(Request $request, Pack $pack)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
            'payment_type' => 'required|in:total,installment',
        ]);

        $optionalFeatures = Feature::whereIn('id', $request->features ?? [])->get();

        $project = $this->projectService->createFromPack(
            Auth::user(),
            $pack,
            $optionalFeatures,
            $validated
        );

        return redirect()->route('client.projects.show', $project)
            ->with('success', 'Votre commande a été enregistrée. Nous allons vous envoyer un devis rapidement.');
    }
}
