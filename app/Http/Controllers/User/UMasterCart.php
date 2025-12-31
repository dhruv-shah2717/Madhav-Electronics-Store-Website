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

class UMasterCart extends Controller
{
    /**
     * Display the user's cart.
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        // Fetch cart products and product images for the user
        $data = [
            'car' => CartProduct::where('user_id', session('Uemail'))->get(),
            'proimg' => ProductImage::all(),
        ];
        return view('User/Cart', compact('data'));
    }

    /**
     * Add a product to the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addcart_action(Request $request)
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
            session()->flash('success', 'Your item has been added successfully.');
            return redirect()->route('cart');
        } else {
            session()->flash('error', 'Error adding item to cart.');
            return redirect()->route('cart');
        }
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * @param int $qty
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatecart_action($qty, $id)
    {
        $result = CartProduct::where('_id', $id)->update(['product_qty' => $qty]);

        if ($result) {
            $this->refreshdiscount_action(); // Refresh discounts after updating cart
            return redirect()->route('cart');
        } else {
            return redirect()->route('cart');
        }
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletecart_action($id)
    {
        $result = CartProduct::where('_id', $id)->delete();
        if ($result) {
            $this->refreshdiscount_action(); // Refresh discounts after removing product
            session()->flash('success', 'Product removed successfully.');
            return redirect()->route('cart');
        } else {
            session()->flash('error', 'Product could not be removed. Please try again.');
            return redirect()->route('cart');
        }
    }

    /**
     * Apply a discount coupon to the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applydiscount_action(Request $request)
    {
        // Validate the discount input
        $validate = Validator::make($request->all(), [
            'discount' => ['required'],
        ], [
            'discount.required' => 'A discount coupon is required.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Check if a coupon is already applied
        if (session()->has('coupon')) {
            session()->flash('error', 'A discount coupon is already added. Please remove the old coupon before adding a new one.');
            return redirect()->route('cart');
        }

        // Calculate total and validate discount
        $total = 0;
        $currentDate = now(); // Get the current date and time
        $result = Discount::where('discount_name', $request->discount)->first();

        if ($result) {
            // Check if the coupon has expired
            if ($currentDate->greaterThan(\Carbon\Carbon::parse($result->discount_expire))) {
                session()->flash('error', 'This discount coupon has expired.');
                return redirect()->route('cart');
            }

            // Calculate total price of items in the cart
            $cartItems = CartProduct::where('user_id', session('Uemail'))->get();
            foreach ($cartItems as $item) {
                $total += $item->product_price * $item->product_qty;
            }

            // Validate if total price is greater than discount price
            if ($total > $result->discount_price) {
                session()->put('coupon', $result->discount_price);
                session()->flash('success', 'Discount coupon added successfully.');
                return redirect()->route('cart');
            } else {
                session()->flash('error', 'The total price must be greater than ₹' . $result->discount_price);
                return redirect()->route('cart');
            }
        } else {
            session()->flash('error', 'Discount coupon not found.');
            return redirect()->route('cart');
        }
    }

    /**
     * Remove the applied discount coupon.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removediscount_action() 
    {
        session()->remove('coupon');
        session()->flash('success', 'Discount coupon removed successfully.');
        return redirect()->route('cart');
    }

    /**
     * Refresh the discount session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refreshdiscount_action() 
    {
        session()->remove('coupon');
        return redirect()->route('cart');
    }

    /**
     * Set the subtotal for the checkout process.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setsubtotal_action(Request $request) 
    {
        $subtotal = $request->sub;
        session()->put('subtotal', $subtotal);
        return redirect()->route('checkout');
    }
}
