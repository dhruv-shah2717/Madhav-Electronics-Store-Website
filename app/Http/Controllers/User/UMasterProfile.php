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

class UMasterProfile extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile() 
    {
        // Fetch the user's information based on their email
        $data = [
            'use' => RegisterUser::where('user_email', session('Uemail'))->first(),
        ];
        return view('User/Profile', compact('data'));
    }

    /**
     * Handle the profile update action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profile_action(Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'uname' => ['required', 'min:2', 'max:15'],
            'address' => ['required', 'min:5', 'max:50'],
            'pincode' => ['required', 'integer'],
            'state' => ['required', 'min:5', 'max:15'],
            'cdt' => ['required', 'min:5', 'max:15'],
        ], [
            'uname.required' => 'The User Name is required.',
            'uname.min' => 'The User Name must be at least 2 characters long.',
            'uname.max' => 'The User Name may not exceed 15 characters.',
            'address.required' => 'The Address is required.',
            'address.min' => 'The Address must be at least 5 characters long.',
            'address.max' => 'The Address may not exceed 50 characters.',
            'pincode.required' => 'The Pincode is required.',
            'pincode.integer' => 'The Pincode must be an integer.',
            'state.required' => 'The State is required.',
            'state.min' => 'The State must be at least 5 characters long.',
            'state.max' => 'The State may not exceed 15 characters.',
            'cdt.required' => 'The District is required.',
            'cdt.min' => 'The District must be at least 5 characters long.',
            'cdt.max' => 'The District may not exceed 15 characters.',
        ]);
    
        if ($validate->fails()) {
            session()->flash('error', 'Your information could not be updated due to validation errors.');
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Update the user's information
        $user = RegisterUser::where('user_email', session('Uemail'))->first();
        if ($user) {
            $user->user_name = $request['uname'];
            $user->user_address = $request['address'];
            $user->user_pincode = $request['pincode'];
            $user->user_state = $request['state'];
            $user->user_cdt = $request['cdt'];

            if ($user->save()) {
                session()->flash('success', 'Your information has been updated successfully.');
                return redirect()->route('profile');
            } else {
                session()->flash('error', 'Error in updating your information.');
                return redirect()->route('profile');
            }
        }

        session()->flash('error', 'User  not found.');
        return redirect()->route('profile');
    }

    /**
     * Handle the logout action.
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
