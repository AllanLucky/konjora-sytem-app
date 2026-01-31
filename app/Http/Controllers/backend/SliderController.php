<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Services\SliderService;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of sliders.
     */
    public function index()
    {
        $slider = Slider::all();
        return view('backend.admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        // Just return the create view
        return view('backend.admin.slider.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(SliderRequest $request)
    {
        // Save slider via service
        $this->sliderService->saveSlider($request->validated(), $request->file('image'));

        // Redirect to index with success message
        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully');
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $this->sliderService->updateSlider($request->validated(), $request->file('image'), $id);

        return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        // Delete associated image if exists
        if ($slider->image) {
            $imagePath = public_path(parse_url($slider->image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted successfully.');
    }
}
