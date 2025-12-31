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

class AMasterDiscount extends Controller
{
    /**
     * Display the form to create a new discount.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin/Discount/Create');
    }

    /**
     * Display the list of discounts.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'dis' => Discount::all()
        ];
        return view('Admin/Discount/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific discount.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'dis' => Discount::find($id),
            'id' => $id
        ];
        return view('Admin/Discount/Edit', compact('data'));
    }

    /**
     * Store a new discount in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storedis(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'disnam' => ['required', 'min:5', 'max:200', 'string', 'unique:discounts,discount_name'],
            'dispri' => ['required', 'integer'],
            'disdat' => ['required']
        ], [
            'disnam.required' => 'The Discount Name is required.',
            'disnam.string' => 'The Discount must be a string.',
            'disnam.min' => 'The Discount must be at least 5 characters long.',
            'disnam.max' => 'The Discount may not exceed 200 characters.',
            'disnam.unique' => 'The Discount Name must be unique.',
            'dispri.required' => 'The Discount Price is required.',
            'dispri.integer' => 'The Discount Price must be an integer.',
            'disdat.required' => 'The Discount Date is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new discount
        $discount = new Discount();
        $discount->discount_name = $request['disnam'];
        $discount->discount_price = $request['dispri'];
        $discount->discount_expire = $request['disdat'];

        if ($discount->save()) {
            session()->flash('success', 'Discount created successfully.');
            return redirect()->route('manage.dis');
        } else {
            session()->flash('error', 'Discount could not be created. Please try again.');
            return redirect()->route('manage.dis');
        }
    }

    /**
     * Update an existing discount.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatedis($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'disnam' => ['required', 'min:5', 'max:200', 'string'],
            'dispri' => ['required', 'integer'],
            'disdat' => ['required']
        ], [
            'disnam.required' => 'The Discount Name is required.',
            'disnam.string' => 'The Discount must be a string.',
            'disnam.min' => 'The Discount must be at least 5 characters long.',
            'disnam.max' => 'The Discount may not exceed 200 characters.',
            'dispri.required' => 'The Discount Price is required.',
            'dispri.integer' => 'The Discount Price must be an integer.',
            'disdat.required' => 'The Discount Date is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the discount to update
        $discount = Discount::find($id);
        if (!$discount) {
            session()->flash('error', 'Discount not found.');
            return redirect()->route('manage.dis');
        }

        // Update discount details
        $discount->discount_name = $request['disnam'];
        $discount->discount_price = $request['dispri'];
        $discount->discount_expire = $request['disdat'];

        if ($discount->save()) {
            session()->flash('success', 'Discount updated successfully.');
            return redirect()->route('manage.dis');
        } else {
            session()->flash('error', 'Discount could not be updated. Please try again.');
            return redirect()->route('manage.dis');
        }
    }

    /**
     * Delete a discount from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletedis($id)
    {
        $discount = Discount::find($id);
        if ($discount) {
            $discount->delete();
            session()->flash('success', 'Discount deleted successfully.');
        } else {
            session()->flash('error', 'Discount not found.');
        }
        return redirect()->route('manage.dis');
    }
}
