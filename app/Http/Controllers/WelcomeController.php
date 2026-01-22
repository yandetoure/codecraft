<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Pack;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $featuredPacks = Pack::where('is_featured', true)->get();

        return view('welcome', compact('services', 'featuredPacks'));
    }

    public function features()
    {
        $features = \App\Models\Feature::orderBy('type')->orderBy('name')->get();
        return view('features.index', compact('features'));
    }
}
