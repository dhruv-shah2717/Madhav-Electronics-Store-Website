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

class AMasterOrder extends Controller
{
    /**
     * Display the list of orders.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'ord' => Order::all()
        ];
        return view('Admin/Order/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific order.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'ord' => Order::find($id),
            'id' => $id
        ];
        return view('Admin/Order/Edit', compact('data'));
    }

    /**
     * Update an existing order.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateord($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'user_id' => ['required', 'string'],
            'product_id' => ['required'],
            'order_qty' => ['required'],
            'order_price' => ['required'],
            'order_total' => ['required', 'numeric'],
            'order_coupon' => ['nullable', 'string'],
            'order_date' => ['required', 'date'],
            'order_status' => ['required'],
            'payment_date' => ['required', 'date'],
            'payment_status' => ['required'],
            'shipped_name' => ['required', 'string', 'max:255'],
            'shipped_email' => ['required', 'email', 'max:255'],
            'shipped_phone' => ['required', 'digits:10'],
            'shipped_address' => ['required', 'string', 'max:255'],
            'shipped_pincode' => ['required', 'digits:6'],
            'shipped_state' => ['required', 'string', 'max:100'],
            'shipped_cdt' => ['required', 'string', 'max:100'],
            'payment_id' => ['required', 'string', 'max:255'],
        ], [
            'user_id.required' => 'The User ID is required.',
            'product_id.required' => 'The Product ID is required.',
            'order_qty.required' => 'The Order Quantity is required.',
            'order_price.required' => 'The Order Price is required.',
            'order_total.required' => 'The Order Total is required.',
            'order_total.numeric' => 'The Order Total must be a number.',
            'order_status.required' => 'The Order Status is required.',
            'payment_status.required' => 'The Payment Status is required.',
            'shipped_name.required' => 'The Shipped Name is required.',
            'shipped_name.max' => 'The Shipped Name may not be greater than 255 characters.',
            'shipped_email.required' => 'The Shipped Email is required.',
            'shipped_email.email' => 'The Shipped Email must be a valid email address.',
            'shipped_email.max' => 'The Shipped Email may not be greater than 255 characters.',
            'shipped_phone.required' => 'The Shipped Phone is required.',
            'shipped_phone.digits' => 'The Shipped Phone must be exactly 10 digits.',
            'shipped_address.required' => 'The Shipped Address is required.',
            'shipped_address.max' => 'The Shipped Address may not be greater than 255 characters.',
            'shipped_pincode.required' => 'The Shipped Pincode is required.',
            'shipped_pincode.digits' => 'The Shipped Pincode must be exactly 6 digits.',
            'shipped_state.required' => 'The Shipped State is required.',
            'shipped_state.max' => 'The Shipped State may not be greater than 100 characters.',
            'shipped_cdt.required' => 'The Shipped City/District/Town is required.',
            'shipped_cdt.max' => 'The Shipped City/District/Town may not be greater than 100 characters.',
            'payment_id.required' => 'The Payment ID is required.',
            'payment_id.max' => 'The Payment ID may not be greater than 255 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the order to update
        $order = Order::find($id);
        if (!$order) {
            session()->flash('error', 'Order not found.');
            return redirect()->route('manage.ord');
        }

        // Update order details
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->order_qty = $request->order_qty;
        $order->order_price = $request->order_price;
        $order->order_total = $request->order_total;
        $order->order_coupon = $request->order_coupon;
        $order->order_date = $request->order_date;
        $order->payment_date = $request->payment_date;
        $order->payment_id = $request->payment_id;
        $order->shipped_name = $request->shipped_name;
        $order->shipped_email = $request->shipped_email;
        $order->shipped_phone = $request->shipped_phone;
        $order->shipped_address = $request->shipped_address;
        $order->shipped_pincode = $request->shipped_pincode;
        $order->shipped_state = $request->shipped_state;
        $order->shipped_cdt = $request->shipped_cdt;

        // Update order status and payment status based on the provided order status
        switch ($request->order_status) {
            case "Pending":
                $order->order_status = "Pending";
                $order->payment_status = "Pending";
                break;
            case "Shipped":
                $order->order_status = "Shipped";
                $order->shipped_date = Carbon::now();
                $order->payment_status = "Paid";
                break;
            case "Ordered":
                $order->order_status = "Ordered";
                $order->order_date = Carbon::now();
                $order->payment_status = "Paid";
                break;
            case "Delivered":
                $order->order_status = "Delivered";
                $order->delivered_date = Carbon::now();
                $order->payment_status = "Paid";
                break;
            case "Cancelled":
                $order->order_status = "Cancelled";
                $order->payment_status = "Refund";
                $order->cancle_date = Carbon::now();
                break;
        }

        // Save the updated order
        if ($order->save()) {
            session()->flash('success', 'Order updated successfully.');
            return redirect()->route('manage.ord');
        } else {
            session()->flash('error', 'Order could not be updated. Please try again.');
            return redirect()->route('manage.ord');
        }
    }

    /**
     * Delete an order from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteord($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            session()->flash('success', 'Order deleted successfully.');
        } else {
            session()->flash('error', 'Order not found.');
        }
        return redirect()->route('manage.ord');
    }
}
