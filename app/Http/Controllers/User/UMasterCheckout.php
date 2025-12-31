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

class UMasterCheckout extends Controller
{
    /**
     * Display the checkout page with cart details.
     *
     * @return \Illuminate\View\View
     */
    public function checkout()
    {
        $data = [
            'cat' => CartProduct::where('user_id', session('Uemail'))->get(),
            'sub' => session('subtotal'),
            'add' => Order::where('user_id', session('Uemail'))->first(),
        ];

        return view('User/Checkout', compact('data'));
    }

    /**
     * Handle the checkout action and create an order.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout_action(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'fname' => ['required'],
            'lname' => ['required', 'min:2', 'max:20'],
            'ema' => ['required', 'email'],
            'pho' => ['required', 'digits:10'],
            'add' => ['required', 'min:5', 'max:150'],
            'cdt' => ['required', 'min:2', 'max:20'],
            'sta' => ['required', 'min:2', 'max:20'],
            'pin' => ['required', 'integer'],
        ], [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'lname.min' => 'Last name must be at least 2 characters.',
            'lname.max' => 'Last name cannot be more than 20 characters.',
            'ema.required' => 'Email is required.',
            'ema.email' => 'Please enter a valid email address.',
            'pho.required' => 'Phone number is required.',
            'pho.digits' => 'Phone number must be exactly 10 digits.',
            'add.required' => 'Address is required.',
            'add.min' => 'Address must be at least 5 characters.',
            'add.max' => 'Address cannot exceed 150 characters.',
            'cdt.required' => 'City is required.',
            'cdt.min' => 'City must be at least 2 characters.',
            'cdt.max' => 'City cannot be more than 20 characters.',
            'sta.required' => 'State is required.',
            'sta.min' => 'State must be at least 2 characters.',
            'sta.max' => 'State cannot be more than 20 characters.',
            'pin.required' => 'PIN code is required.',
            'pin.integer' => 'PIN code must be a valid number.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a Razorpay order
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $subtotal = session('subtotal');

        $razorpayOrder = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $subtotal * 100, // Amount in paise
            'currency' => 'INR',
        ]);

        // Prepare order data
        $dorderid = $razorpayOrder->id;
        $cart = CartProduct::where('user_id', session('Uemail'))->get();

        $products = [];
        $quantities = [];
        $prices = [];

        foreach ($cart as $cat) {
            $products[] = $cat->product_id;
            $quantities[] = $cat->product_qty;
            $prices[] = $cat->product_price;
        }

        // Create a new order
        $ord = new Order();
        $ord->user_id = session('Uemail');
        $ord->product_id = json_encode($products);  // Store product IDs as JSON
        $ord->order_qty = json_encode($quantities); // Store quantities as JSON
        $ord->order_price = json_encode($prices);   // Store prices as JSON
        $ord->order_total = $subtotal; // Ensure $subtotal is defined
        $ord->order_coupon = session('coupon');
        $ord->order_date = Carbon::today();
        $ord->payment_id = $dorderid; // Ensure $dorderid is defined

        // Shipping details
        $ord->shipped_name = $request->fname . ' ' . $request->lname;
        $ord->shipped_email = $request->ema;
        $ord->shipped_phone = $request->pho;
        $ord->shipped_address = $request->add;
        $ord->shipped_pincode = $request->pin;
        $ord->shipped_state = $request->sta;
        $ord->shipped_cdt = $request->cdt;
        $ord->save();

        // Update user information
        $tem = RegisterUser::where('user_email', session('Uemail'))->first();
        $tem->user_name = $request->fname . ' ' . $request->lname;
        $tem->user_address = $request->add;
        $tem->user_pincode = $request->pin;
        $tem->user_state = $request->sta;
        $tem->user_cdt = $request->cdt;
        $tem->save();

        // Prepare data for payment view
        $data = [
            'razorpayOrderId' => $razorpayOrder->id,
            'sub' => $subtotal,
            'key' => env('RAZORPAY_KEY'),
        ];

        return view('User/Payment', compact('data'));
    }

    /**
     * Display the payment page.
     *
     * @return \Illuminate\View\View
     */
    public function payment()
    {
        return view('User/Payment');
    }

    /**
     * Handle repayment action.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function repayment(Request $request)
    {
        // Find the order by ID
        $order = Order::find($request->raz);

        // Prepare data for payment view
        $data = [
            'razorpayOrderId' => $order->payment_id,
            'sub' => $order->order_total,
            'key' => env('RAZORPAY_KEY'),
        ];

        return view('User/Payment', compact('data'));
    }

    /**
     * Process the payment action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment_action(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $razorpayOrderId = $request->input('razorpay_order_id');
            $result = Order::where('payment_id', $razorpayOrderId)->update([
                'order_status' => 'Ordered',
                'payment_status' => 'Paid',
                'payment_date' => Carbon::today()
            ]);

            if ($result) {
                $tem = CartProduct::where('user_id', session('Uemail'))->get();
                foreach ($tem as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->product_qty -= $item->product_qty;
                        $product->save();
                    }
                }

                CartProduct::where('user_id', session('Uemail'))->delete();
                session()->remove('coupon');
                session()->remove('subtotal');
            }

            session()->flash('success', 'Order placed successfully.');
            return redirect()->route('order');
        } catch (\Exception $e) {
            session()->flash('error', 'Error processing the order. Please try again.');
            return redirect()->route('order');
        }
    }
}
