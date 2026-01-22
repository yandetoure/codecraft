<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::ordered()->get();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:technical,design,marketing,maintenance',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        Feature::create($validated);

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité créée.');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:technical,design,marketing,maintenance',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $feature->update($validated);

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité mise à jour.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité supprimée.');
    }
}
