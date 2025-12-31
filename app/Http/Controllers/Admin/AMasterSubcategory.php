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

class AMasterSubcategory extends Controller
{
    /**
     * Display the form to create a new subcategory.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'cat' => Category::all()
        ];
        return view('Admin/Subcategory/Create', compact('data'));
    }

    /**
     * Display the list of subcategories.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'subcat' => Subcategory::all()
        ];
        return view('Admin/Subcategory/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific subcategory.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'cat' => Category::all(),
            'subcat' => Subcategory::find($id),
            'id' => $id
        ];
        return view('Admin/Subcategory/Edit', compact('data'));
    }

    /**
     * Store a new subcategory in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storesubcat(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'subcatnam' => ['required', 'min:5', 'max:200', 'string', 'unique:subcategories,subcategory_name'],
        ], [
            'subcatnam.required' => 'The Subcategory is required.',
            'subcatnam.string' => 'The Subcategory must be a string.',
            'subcatnam.min' => 'The Subcategory must be at least 5 characters long.',
            'subcatnam.max' => 'The Subcategory may not exceed 200 characters.',
            'subcatnam.unique' => 'The Subcategory must be unique.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new subcategory
        $subcategory = new Subcategory();
        $subcategory->category_id = $request['catnam'];
        $subcategory->subcategory_name = $request['subcatnam'];

        if ($subcategory->save()) {
            session()->flash('success', 'Subcategory created successfully.');
            return redirect()->route('manage.subcat');
        } else {
            session()->flash('error', 'Subcategory could not be created. Please try again.');
            return redirect()->route('manage.subcat');
        }
    }

    /**
     * Update an existing subcategory in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatesubcat($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'subcatnam' => ['required', 'min:5', 'max:200', 'string'],
        ], [
            'subcatnam.required' => 'The Subcategory is required.',
            'subcatnam.string' => 'The Subcategory must be a string.',
            'subcatnam.min' => 'The Subcategory must be at least 5 characters long.',
            'subcatnam.max' => 'The Subcategory may not exceed 200 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the subcategory to update
        $subcategory = Subcategory::find($id);
        if (!$subcategory) {
            session()->flash('error', 'Subcategory not found.');
            return redirect()->route('manage.subcat');
        }

        // Update subcategory details
        $subcategory->category_id = $request['catnam'];
        $subcategory->subcategory_name = $request['subcatnam'];

        if ($subcategory->save()) {
            session()->flash('success', 'Subcategory updated successfully.');
            return redirect()->route('manage.subcat');
        } else {
            session()->flash('error', 'Subcategory could not be updated. Please try again.');
            return redirect()->route('manage.subcat');
        }
    }

    /**
     * Delete a subcategory from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletesubcat($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategory->delete();
            session()->flash('success', 'Subcategory deleted successfully.');
        } else {
            session()->flash('error', 'Subcategory not found.');
        }
        return redirect()->route('manage.subcat');
    }
}
