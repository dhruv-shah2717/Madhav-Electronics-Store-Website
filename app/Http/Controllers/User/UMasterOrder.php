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

class UMasterOrder extends Controller
{
    /**
     * Display the user's orders.
     *
     * @return \Illuminate\View\View
     */
    public function order()
    {
        // Fetch orders for the logged-in user
        $orders = Order::where('user_id', session('Uemail'))->get();

        // Get product IDs from orders (decode the product_id string to array)
        $productIds = [];
        foreach ($orders as $order) {
            $productIds = array_merge($productIds, json_decode($order->product_id));
        }

        // Fetch product names for the IDs
        $products = Product::whereIn('_id', $productIds)->pluck('product_name', 'id');

        // Pass the data to the view
        $data = [
            'ord' => $orders,
            'pro' => $products,
        ];

        return view('User/Order', compact('data'));
    }

    /**
     * Download the invoice for a specific order.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function download_invoice($id)
    {
        // Find the order by ID
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('order')->with('error', 'Order not found.');
        }

        // Decode order details
        $price = json_decode($order->order_price, true) ?? [];
        $qty = json_decode($order->order_qty, true) ?? []; 
        $productIds = json_decode($order->product_id, true) ?? [];

        // Fetch product names for the IDs
        $products = Product::whereIn('_id', $productIds)->pluck('product_name', 'id');

        // Generate the PDF invoice
        $pdf = Pdf::loadView('User.Invoice', compact('order', 'products', 'price', 'qty', 'productIds'))
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        return $pdf->download('invoice.pdf');
    }

    /**
     * Cancel an order.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelorder_action($id)
    {
        // Find the order by ID
        $order = Order::find($id);
        if ($order) {
            // Update order status and payment status
            $order->order_status = 'Cancelled';
            $order->payment_status = 'Refund';
            $order->cancle_date = Carbon::today();
            $order->save();

            session()->flash('success', 'Your order has been cancelled.');
            return redirect()->route('order');
        }

        session()->flash('error', 'Order not found.');
        return redirect()->route('order');
    }
}
