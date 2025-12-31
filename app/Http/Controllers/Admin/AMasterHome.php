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

class AMasterHome extends Controller
{
    /**
     * Display the admin home dashboard with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        // Calculate the total revenue from delivered orders
        $totalRevenue = 0;
        $orders = Order::where('order_status', 'Delivered')->get();
        foreach ($orders as $order) {
            $totalRevenue += $order->order_total;
        }

        // Prepare data for the dashboard
        $data = [
            'use' => RegisterUser::all(),
            'pcount' => Product::count(), // Count of products
            'ccount' => Contact::where('contact_status','Pending')->count(), // Count of contacts
            'ocount' => Order::count(), // Count of orders
            'scount' => $totalRevenue, // Total revenue from delivered orders
        ];

        return view('Admin/Home', compact('data'));
    }

    /**
     * Handle the logout action for the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout_action()
    {
        session()->flush(); // Clear all session data
        session()->flash('success', 'Logged out successfully.');
        return redirect()->route('home');
    }
}
