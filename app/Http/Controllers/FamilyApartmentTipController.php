<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\Models\Tip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FamilyApartmentTipController extends Controller
{
 public function index()
{
    $selectedCategory = request('category', 'all');

    $categories = [
        ['key' => 'all', 'label' => 'Tous'],
        ['key' => 'food', 'label' => 'Gastronomie'],
        ['key' => 'nature', 'label' => 'Nature'],
        ['key' => 'culture', 'label' => 'Culture'],
        ['key' => 'practical', 'label' => 'Pratique'],
    ];

    $tips = \App\Models\Tip::query()
        ->with('user')
        ->when($selectedCategory !== 'all', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->latest()
        ->get();

    $mapTips = $tips
        ->filter(fn ($tip) => !is_null($tip->lat) && !is_null($tip->lng))
        ->map(fn ($tip) => [
            'id' => $tip->id,
            'title' => $tip->title,
            'lat' => (float) $tip->lat,
            'lng' => (float) $tip->lng,
            'category_label' => $tip->category_label,
            'address' => $tip->address,
            'url' => route('family-apartment.tips.show', $tip),
        ])
        ->values();

    return view('family-apartment.tips.index', compact(
        'tips',
        'categories',
        'selectedCategory',
        'mapTips'
    ));
}

    public function create()
    {
        return view('family-apartment.tips.create');
    }

    public function show(\App\Models\Tip $tip)
    {
        return view('family-apartment.tips.show', compact('tip'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'category' => ['required', 'in:food,nature,culture,practical'],
        'address' => ['nullable', 'string', 'max:255'],
        'lat' => ['nullable', 'numeric', 'between:-90,90'],
        'lng' => ['nullable', 'numeric', 'between:-180,180'],
        'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        'description' => ['nullable', 'string'],
        'image' => ['nullable', 'image', 'max:4096'],
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');

        if ($file && $file->isValid()) {
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = uniqid('tip_', true) . '.' . $extension;

            Storage::disk('public')->put(
                'tips/' . $filename,
                file_get_contents($file->getPathname())
            );

            $imagePath = 'tips/' . $filename;
        }
    }

    $categoryLabels = [
        'food' => 'Gastronomie',
        'nature' => 'Nature',
        'culture' => 'Culture',
        'practical' => 'Pratique',
    ];

    $tip = Tip::create([
        'title' => $validated['title'],
        'category' => $validated['category'],
        'category_label' => $categoryLabels[$validated['category']] ?? null,
        'user_id' => auth()->id(),
        'address' => $validated['address'] ?? null,
        'lat' => $validated['lat'] ?? null,
        'lng' => $validated['lng'] ?? null,
        'rating' => $validated['rating'] ?? null,
        'description' => $validated['description'] ?? null,
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('family-apartment.tips.show', $tip)
        ->with('success', 'Le bon plan a bien été ajouté.');
}
}
