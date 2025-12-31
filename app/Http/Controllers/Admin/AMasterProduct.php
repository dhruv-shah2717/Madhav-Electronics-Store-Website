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

class AMasterProduct extends Controller
{
    /**
     * Display the form to create a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'cat' => Category::all(),
            'subcat' => Subcategory::all()
        ];
        return view('Admin/Product/Create', compact('data'));
    }

    /**
     * Display the list of products.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'pro' => Product::all()
        ];
        return view('Admin/Product/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific product.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'cat' => Category::all(),
            'subcat' => Subcategory::all(),
            'pro' => Product::find($id),
            'id' => $id
        ];
        return view('Admin/Product/Edit', compact('data'));
    }

    /**
     * Store a new product in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storepro(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'pronam' => ['required', 'min:2', 'max:200', 'string'],
            'probra' => ['required', 'min:2', 'max:200', 'string'],
            'propri' => ['required', 'integer'],
            'proxpri' => ['required', 'integer'],
            'proimg' => ['required', 'array'],
            'prodis' => ['required', 'min:2', 'max:1000', 'string']
        ], [
            'pronam.required' => 'The Product Name is required.',
            'pronam.min' => 'The Product Name must be at least 2 characters long.',
            'pronam.max' => 'The Product Name may not exceed 200 characters.',
            'pronam.string' => 'The Product Name must be a string.',
            'probra.required' => 'The Product Brand Name is required.',
            'probra.min' => 'The Product Brand Name must be at least 2 characters long.',
            'probra.max' => 'The Product Brand Name may not exceed 200 characters.',
            'probra.string' => 'The Product Brand Name must be a string.',
            'propri.required' => 'The Product Price is required.',
            'propri.integer' => 'The Product Price must be an integer.',
            'proxpri.required' => 'The Product Ex Price is required.',
            'proxpri.integer' => 'The Product Ex Price must be an integer.',
            'prodis.required' => 'The Product Description is required.',
            'prodis.min' => 'The Product Description must be at least 2 characters long.',
            'prodis.max' => 'The Product Description may not exceed 1000 characters.',
            'proimg.required' => 'The Product Image is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new product
        $product = new Product();
        $product->product_name = $request['pronam'];
        $product->product_brand = $request['probra'];
        $product->product_price = $request['propri'];
        $product->product_xprice = $request['proxpri'];
        $product->category_id = $request['catnam'];
        $product->subcategory_id = $request['subcatnam'];
        $product->product_qty = $request['proqty'];
        $product->product_description = $request['prodis'];

        if ($product->save()) {
            // Handle image uploads
            if ($request->hasFile('proimg')) {
                $isPrimary = true;

                foreach ($request->file('proimg') as $image) {
                    $fileName = uniqid() . '_' . $image->getClientOriginalName();
                    $destinationPath = public_path('Images/Product/');
                    $image->move($destinationPath, $fileName);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = 'Images/Product/' . $fileName;
                    $productImage->image_primary = $isPrimary;
                    $productImage->save();

                    $isPrimary = false;
                }
            }

            session()->flash('success', 'Product created successfully.');
            return redirect()->route('manage.pro');
        }

        session()->flash('error', 'Product could not be created. Please try again.');
        return redirect()->route('manage.pro');
    }

    /**
     * Update an existing product in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatepro($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'pronam' => ['required', 'min:2', 'max:200', 'string'],
            'probra' => ['required', 'min:2', 'max:200', 'string'],
            'propri' => ['required', 'integer'],
            'proxpri' => ['required', 'integer'],
            'prodis' => ['required', 'min:2', 'max:1000', 'string']
        ], [
            'pronam.required' => 'The Product Name is required.',
            'pronam.min' => 'The Product Name must be at least 2 characters long.',
            'pronam.max' => 'The Product Name may not exceed 200 characters.',
            'pronam.string' => 'The Product Name must be a string.',
            'probra.required' => 'The Product Brand Name is required.',
            'probra.min' => 'The Product Brand Name must be at least 2 characters long.',
            'probra.max' => 'The Product Brand Name may not exceed 200 characters.',
            'probra.string' => 'The Product Brand Name must be a string.',
            'propri.required' => 'The Product Price is required.',
            'propri.integer' => 'The Product Price must be an integer.',
            'proxpri.required' => 'The Product Ex Price is required.',
            'proxpri.integer' => 'The Product Ex Price must be an integer.',
            'prodis.required' => 'The Product Description is required.',
            'prodis.min' => 'The Product Description must be at least 2 characters long.',
            'prodis.max' => 'The Product Description may not exceed 1000 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the product to update
        $product = Product::find($id);
        if (!$product) {
            session()->flash('error', 'Product not found.');
            return redirect()->route('manage.pro');
        }

        // Update product details
        $product->product_name = $request['pronam'];
        $product->product_brand = $request['probra'];
        $product->product_price = $request['propri'];
        $product->product_xprice = $request['proxpri'];
        $product->category_id = $request['catnam'];
        $product->subcategory_id = $request['subcatnam'];
        $product->product_qty = $request['proqty'];
        $product->product_description = $request['prodis'];

        if ($product->save()) {
            session()->flash('success', 'Product updated successfully.');
            return redirect()->route('manage.pro');
        }

        session()->flash('error', 'Product could not be updated. Please try again.');
        return redirect()->route('manage.pro');
    }

    /**
     * Delete a product from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletepro($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            session()->flash('success', 'Product deleted successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
        return redirect()->route('manage.pro');
    }
}
