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

class UMasterShop extends Controller
{
    /**
     * Display the shop page with products based on category and subcategory.
     *
     * @param int|null $category
     * @param int|null $subcategory
     * @return \Illuminate\View\View
     */
    public function shop($category = null, $subcategory = null)
    {
        // Fetch products based on category and subcategory
        if ($category && $subcategory) {
            $products = Product::where('category_id', $category)
                ->where('subcategory_id', $subcategory)
                ->get();
        } elseif ($category) {
            $products = Product::where('category_id', $category)->get();
        } else {
            // Fetch a random sample of products if no category is specified
            $size = Product::count();
            $products = Product::raw(function($collection) use ($size) {
                return $collection->aggregate([
                    ['$sample' => ['size' => $size]]
                ]);
            });
        }

        // Prepare data for the view
        $data = [
            'pro' => $products,
            'proimg' => ProductImage::all(),
            'cat' => Category::all(),
            'subcat' => Subcategory::all(),
            'count' => count($products),
        ];

        $search = null; // Initialize search variable
        return view('User/Shop', compact('data', 'search'));
    }

    /**
     * Handle the search action for products.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search_action(Request $request)
    {
        $search = $request->search;

        // If search is empty, fetch all products
        if (empty($search)) {
            $data = [
                'pro' => Product::all(),
                'proimg' => ProductImage::all(),
                'cat' => Category::all(),
                'subcat' => Subcategory::all(),
                'count' => Product::count(),
            ];
        } else {
            // Search for products based on name, brand, category, or subcategory
            $products = Product::where('product_name', 'LIKE', "%$search%")
                ->orWhere('product_brand', 'LIKE', "%$search%")
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('category_name', 'LIKE', "%$search%");
                })
                ->orWhereHas('subcategory', function ($query) use ($search) {
                    $query->where('subcategory_name', 'LIKE', "%$search%");
                })
                ->get();

            $data = [
                'pro' => $products,
                'proimg' => ProductImage::all(),
                'cat' => Category::all(),
                'subcat' => Subcategory::all(),
                'count' => count($products),
            ];
        }

        return view('User/Shop', compact('data', 'search'));
    }

    /**
     * Filter products based on price range.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function price_action(Request $request)
    {
        $range = $request->ran;

        // Fetch products within the specified price range
        $products = Product::where('product_price', '<=', $range)->get();

        $data = [
            'pro' => $products,
            'proimg' => ProductImage::all(),
            'cat' => Category::all(),
            'subcat' => Subcategory::all(),
            'count' => count($products),
            'val' => $range,
        ];

        $search = null; // Initialize search variable
        return view('User/Shop', compact('data', 'search'));
    }
}
