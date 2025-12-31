<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Exception;
use App\Models\{
    CartProduct,Category,Contact,Discount,Order,Product,ProductAttribute,ProductImage,RegisterUser,Slider,Subcategory,
};

class AMasterSlider extends Controller
{
    /**
     * Display the form to create a new slider.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin/Slider/Create');
    }

    /**
     * Display the list of sliders.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'sli' => Slider::all()
        ];
        return view('Admin/Slider/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific slider.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'sli' => Slider::find($id),
            'id' => $id
        ];
        return view('Admin/Slider/Edit', compact('data'));
    }

    /**
     * Store a new slider in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storesli(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'sliimg' => ['required']
        ], [
            'sliimg.required' => 'The Slider Image is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Handle the image upload
        $image = $request['sliimg'];
        $fileName = uniqid() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('Images/Slider/');
        $image->move($destinationPath, $fileName);

        // Create a new slider
        $slider = new Slider();
        $slider->slider_image = 'Images/Slider/' . $fileName;

        if ($slider->save()) {
            session()->flash('success', 'Slider created successfully.');
            return redirect()->route('manage.sli');
        } else {
            session()->flash('error', 'Slider could not be created. Please try again.');
            return redirect()->route('manage.sli');
        }
    }

    /**
     * Update an existing slider in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatesli($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'sliimg' => ['required']
        ], [
            'sliimg.required' => 'The Slider Image is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Handle the image upload
        $image = $request['sliimg'];
        $fileName = uniqid() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('Images/Slider/');
        $image->move($destinationPath, $fileName);

        // Find the slider to update
        $slider = Slider::find($id);
        if (!$slider) {
            session()->flash('error', 'Slider not found.');
            return redirect()->route('manage.sli');
        }

        // Update slider image
        $slider->slider_image = 'Images/Slider/' . $fileName;

        if ($slider->save()) {
            session()->flash('success', 'Slider updated successfully.');
            return redirect()->route('manage.sli');
        } else {
            session()->flash('error', 'Slider could not be updated. Please try again.');
            return redirect()->route('manage.sli');
        }
    }

    /**
     * Delete a slider from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletesli($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->delete();
            session()->flash('success', 'Slider deleted successfully.');
        } else {
            session()->flash('error', 'Slider not found.');
        }
        return redirect()->route('manage.sli');
    }
}
