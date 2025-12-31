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

class UMasterHome extends Controller
{
    /**
     * Display the home page with featured products and categories.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        // Fetch data for the home page
        $data = [
            'sli' => Slider::all(), // Fetch all sliders
            'newpro' => Product::orderBy('created_at', 'desc')->limit(4)->get(), // Fetch the 4 most recently created products
            'trepro' => Product::orderBy('product_qty', 'asc')->limit(4)->get(), // Fetch the 4 products with the least quantity
            'proimg' => ProductImage::all(), // Fetch all product images
            'cat' => Category::all(), // Fetch all categories
        ];

        return view('User/Home', compact('data'));
    }
}
