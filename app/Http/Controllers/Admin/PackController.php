<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use App\Models\Service;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackController extends Controller
{
    public function index()
    {
        $packs = Pack::with('service')->ordered()->get();
        return view('admin.packs.index', compact('packs'));
    }

    public function create()
    {
        $services = Service::active()->get();
        $features = Feature::active()->get();
        return view('admin.packs.create', compact('services', 'features'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'features' => 'nullable|array',
            'features.*.id' => 'exists:features,id',
            'features.*.is_included' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $pack = Pack::create($validated);

        if ($request->has('features')) {
            foreach ($request->features as $featureData) {
                $pack->features()->attach($featureData['id'], [
                    'is_included' => $featureData['is_included'] ?? false
                ]);
            }
        }

        return redirect()->route('admin.packs.index')
            ->with('success', 'Pack créé avec succès.');
    }

    public function edit(Pack $pack)
    {
        $services = Service::active()->get();
        $features = Feature::active()->get();
        return view('admin.packs.edit', compact('pack', 'services', 'features'));
    }

    public function update(Request $request, Pack $pack)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($validated['name'] !== $pack->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $pack->update($validated);

        if ($request->has('features')) {
            $syncData = [];
            foreach ($request->features as $featureData) {
                $syncData[$featureData['id']] = [
                    'is_included' => $featureData['is_included'] ?? false
                ];
            }
            $pack->features()->sync($syncData);
        }

        return redirect()->route('admin.packs.index')
            ->with('success', 'Pack mis à jour avec succès.');
    }

    public function destroy(Pack $pack)
    {
        $pack->delete();
        return redirect()->route('admin.packs.index')
            ->with('success', 'Pack supprimé avec succès.');
    }
}
