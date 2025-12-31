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

class AMasterCategory extends Controller
{
    /**
     * Display the form to create a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin/Category/Create');
    }

    /**
     * Display the list of categories.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'cat' => Category::all()
        ];
        return view('Admin/Category/Manage', compact('data'));
    }

    /**
     * Display the form to edit a category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'cat' => Category::find($id),
            'id' => $id
        ];
        return view('Admin/Category/Edit', compact('data'));
    }

    /**
     * Store a new category in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storecat(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'catnam' => ['required', 'min:5', 'max:200', 'string', 'unique:categories,category_name'],
            'catimg' => ['required']
        ], [
            'catnam.required' => 'The Category is required.',
            'catnam.string' => 'The Category must be a string.',
            'catnam.min' => 'The Category must be at least 5 characters long.',
            'catnam.max' => 'The Category may not exceed 200 characters.',
            'catnam.unique' => 'The Category must be unique.',
            'catimg.required' => 'The Category Image is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Handle the image upload
        $image = $request['catimg'];
        $fileName = uniqid() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('Images/Category/');
        $image->move($destinationPath, $fileName);

        // Create a new category
        $category = new Category();
        $category->category_name = $request['catnam'];
        $category->category_image = 'Images/Category/' . $fileName;

        if ($category->save()) {
            session()->flash('success', 'Category created successfully.');
            return redirect()->route('manage.cat');
        } else {
            session()->flash('error', 'Category could not be created. Please try again.');
            return redirect()->route('manage.cat');
        }
    }

    /**
     * Update an existing category.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatecat($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'catnam' => ['required', 'min:5', 'max:200', 'string'],
        ], [
            'catnam.required' => 'The Category is required.',
            'catnam.string' => 'The Category must be a string.',
            'catnam.min' => 'The Category must be at least 5 characters long.',
            'catnam.max' => 'The Category may not exceed 200 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the category to update
        $category = Category::find($id);
        if (!$category) {
            session()->flash('error', 'Category not found.');
            return redirect()->route('manage.cat');
        }

        // Update category name
        $category->category_name = $request['catnam'];

        // Handle the image upload if a new image is provided
        if ($request->hasFile('catimg')) {
            $image = $request['catimg'];
            $fileName = uniqid() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('Images/Category/');
            $image->move($destinationPath, $fileName);
            $category->category_image = 'Images/Category/' . $fileName;
        }

        if ($category->save()) {
            session()->flash('success', 'Category updated successfully.');
            return redirect()->route('manage.cat');
        } else {
            session()->flash('error', 'Category could not be updated. Please try again.');
            return redirect()->route('manage.cat');
        }
    }

    /**
     * Delete a category from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletecat($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            session()->flash('success', 'Category deleted successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
        return redirect()->route('manage.cat');
    }
}
