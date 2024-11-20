<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Get all sliders
     */
    public function index()
    {
        $sliders = Slider::all();
        return response()->json($sliders);
    }

    /**
     * Store a new slider
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string'
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('sliders', 'public');

        $slider = Slider::create([
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return response()->json($slider, 201);
    }

    /**
     * Show a single slider by ID
     */
    public function show($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        return response()->json($slider);
    }

    /**
     * Update an existing slider
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string'
        ]);

        // Update image if a new file is provided
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            // Store the new image
            $slider->image = $request->file('image')->store('sliders', 'public');
        }

        $slider->link = $request->link ?? $slider->link;
        $slider->save();

        return response()->json($slider);
    }

    /**
     * Delete a slider
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        // Delete the image
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();
        return response()->json(['message' => 'Slider deleted successfully']);
    }
}
