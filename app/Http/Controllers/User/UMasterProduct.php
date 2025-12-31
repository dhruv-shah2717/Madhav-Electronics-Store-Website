<?php

namespace App\Http\Controllers\User;

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

class UMasterProduct extends Controller
{
    /**
     * Display the product details page.
     *
     * @param int $id
     * @param int|null $atu
     * @return \Illuminate\View\View
     */
    public function product($id, $atu = null)
    {
        // Find the product by ID
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        // Initialize price and selected attribute
        $price = $product->product_price;
        $selectedAttribute = null;

        // If an attribute ID is provided, adjust the price accordingly
        if (!empty($atu)) {
            $attribute = ProductAttribute::find($atu);
            if ($attribute) {
                $price += $attribute->attribute_price; // Add attribute price
                $selectedAttribute = $atu; // Set selected attribute
            } else {
                $selectedAttribute = "Default"; // Fallback if attribute not found
            }
        }

        // Fetch related products
        $relatedProducts = Product::where('_id', '!=', $product->_id)
            ->where(function ($query) use ($product) {
                $query->orWhere('category_id', $product->category_id)
                      ->orWhere('subcategory_id', $product->subcategory_id);
            })
            ->limit(4)
            ->get();

        // Prepare data for the view
        $data = [
            'pro' => $product,
            'proimg' => ProductImage::all(),
            'proatu' => ProductAttribute::where('product_id', $id)->get(),
            'price' => $price,
            'sel' => $selectedAttribute,
            'relpro' => $relatedProducts,
        ];

        return view('User/Product', compact('data'));
    }

    /**
     * Handle the "Buy Now" action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buynow_action(Request $request)
    {
        $uid = session('Uemail');
        $atu = $request['cat'];
        $pid = $request['cid'];
        $price = $request['cpri'];

        // Create a new cart product entry
        $cartProduct = new CartProduct();
        $cartProduct->user_id = $uid;
        $cartProduct->product_id = $pid;
        $cartProduct->attribute_id = $atu;
        $cartProduct->product_price = $price;

        if ($cartProduct->save()) {
            // Set the subtotal in the session
            session()->put('subtotal', $price);
            return redirect()->route('checkout');
        } else {
            session()->flash('error', 'Error adding item to cart.');
            return redirect()->route('home');
        }
    }
}
