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

class AMasterProductAttribute extends Controller
{
    /**
     * Display the form to create a new product attribute.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'pro' => Product::all()
        ];
        return view('Admin/ProductAttribute/Create', compact('data'));
    }

    /**
     * Display the list of product attributes.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'proatu' => ProductAttribute::all()
        ];
        return view('Admin/ProductAttribute/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific product attribute.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'pro' => Product::all(),
            'proatu' => ProductAttribute::find($id),
            'id' => $id
        ];
        return view('Admin/ProductAttribute/Edit', compact('data'));
    }

    /**
     * Store a new product attribute in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeproatu(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'proatunam' => ['required', 'min:5', 'max:200'],
            'proatupri' => ['required', 'integer'],
        ], [
            'proatunam.required' => 'The Attribute Name is required.',
            'proatunam.min' => 'The Attribute Name must be at least 5 characters long.',
            'proatunam.max' => 'The Attribute Name may not exceed 200 characters.',
            'proatupri.required' => 'The Attribute Price is required.',
            'proatupri.integer' => 'The Attribute Price must be an integer.'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new product attribute
        $attribute = new ProductAttribute();
        $attribute->attribute_name = $request['proatunam'];
        $attribute->attribute_price = $request['proatupri'];
        $attribute->product_id = $request['proid'];

        if ($attribute->save()) {
            session()->flash('success', 'Product Attribute created successfully.');
            return redirect()->route('manage.proatu');
        } else {
            session()->flash('error', 'Product Attribute could not be created. Please try again.');
            return redirect()->route('manage.proatu');
        }
    }

    /**
     * Update an existing product attribute in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateproatu($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'proatunam' => ['required', 'min:5', 'max:200'],
            'proatupri' => ['required', 'integer'],
        ], [
            'proatunam.required' => 'The Attribute Name is required.',
            'proatunam.min' => 'The Attribute Name must be at least 5 characters long.',
            'proatunam.max' => 'The Attribute Name may not exceed 200 characters.',
            'proatupri.required' => 'The Attribute Price is required.',
            'proatupri.integer' => 'The Attribute Price must be an integer.'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the product attribute to update
        $attribute = ProductAttribute::find($id);
        if (!$attribute) {
            session()->flash('error', 'Product Attribute not found.');
            return redirect()->route('manage.proatu');
        }

        // Update attribute details
        $attribute->attribute_name = $request['proatunam'];
        $attribute->attribute_price = $request['proatupri'];
        $attribute->product_id = $request['proid'];

        if ($attribute->save()) {
            session()->flash('success', 'Product Attribute updated successfully.');
            return redirect()->route('manage.proatu');
        } else {
            session()->flash('error', 'Product Attribute could not be updated. Please try again.');
            return redirect()->route('manage.proatu');
        }
    }

    /**
     * Delete a product attribute from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteproatu($id)
    {
        $attribute = ProductAttribute::find($id);
        if ($attribute) {
            $attribute->delete();
            session()->flash('success', 'Product Attribute deleted successfully.');
        } else {
            session()->flash('error', 'Product Attribute not found.');
        }
        return redirect()->route('manage.proatu');
    }
}
