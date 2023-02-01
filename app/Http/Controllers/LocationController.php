<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    public function index(): View
    {
        return view('locations.index', ['locations' => Location::withCount(['players', 'games'])->get()]);
    }

    public function show(int $id): View
    {
        return view('locations.show', ['location' => Location::with(['players', 'games'])->findOrFail($id)]);
    }
}
