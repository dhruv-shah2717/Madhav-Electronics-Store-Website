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

class AMasterProductImage extends Controller
{
    /**
     * Display the list of images for a specific product.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function manage($id)
    {
        $data = [
            'proimg' => ProductImage::where('product_id', $id)->get(),
            'id' => $id
        ];
        return view('Admin/ProductImage/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific product image.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'id' => $id,
        ];
        return view('Admin/ProductImage/Edit', compact('data'));
    }

    /**
     * Update a product image in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateproimg($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'proimg' => ['required'],
        ], [
            'proimg.required' => 'The Product Image is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the product image to update
        $productImage = ProductImage::find($id);
        if (!$productImage) {
            session()->flash('error', 'Product Image not found.');
            return redirect()->route('manage.pro');
        }

        // Handle the image upload
        if ($request->hasFile('proimg')) {
            $image = $request->file('proimg');
            $uniqueFileName = uniqid() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('Images/Product/');
            $image->move($destinationPath, $uniqueFileName);
            $productImage->image_path = 'Images/Product/' . $uniqueFileName;

            if ($productImage->save()) {
                session()->flash('success', 'Product Image updated successfully.');
                return redirect()->route('manage.pro');
            } else {
                session()->flash('error', 'Product Image could not be updated. Please try again.');
                return redirect()->route('manage.pro');
            }
        }
    }

    /**
     * Delete a product image from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteproimg($id)
    {
        $productImage = ProductImage::find($id);
        if ($productImage) {
            $productImage->delete();
            session()->flash('success', 'Product Image deleted successfully.');
        } else {
            session()->flash('error', 'Product Image not found.');
        }
        return redirect()->back();
    }
}
