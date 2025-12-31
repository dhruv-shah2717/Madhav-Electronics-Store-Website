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

class UMasterContact extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('User/Contact');
    }

    /**
     * Handle the contact form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addcontact_action(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'fname' => ['required', 'min:2', 'max:15'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min:5', 'max:100']
        ], [
            'fname.required' => 'The Name is required.',
            'fname.min' => 'The Name must be at least 2 characters long.',
            'fname.max' => 'The Name may not exceed 15 characters.',
            'email.required' => 'The Email is required.',
            'email.email' => 'The Email must be a valid format.',
            'message.required' => 'The Message is required.',
            'message.min' => 'The Message must be at least 5 characters long.',
            'message.max' => 'The Message may not exceed 100 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new contact entry
        $contact = new Contact();
        $contact->contact_name = $request->fname;
        $contact->contact_email = $request->email;
        $contact->contact_message = $request->message;

        if ($contact->save()) {
            session()->flash('success', 'Your contact message has been sent. We will reply within 24 hours. Please check your email.');
            return redirect()->route('contact');
        } else {
            session()->flash('error', 'Error in sending your message. Please try again.');
            return redirect()->route('contact');
        }
    }
}
