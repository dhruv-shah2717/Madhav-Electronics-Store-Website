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

class AMasterUser extends Controller
{
    /**
     * Display the form to edit a specific user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'use' => RegisterUser::find($id),
            'id' => $id
        ];
        return view('Admin/User/Edit', compact('data'));
    }

    /**
     * Update an existing user in the database.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateuse($id, Request $request)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'otp' => ['required', 'numeric', 'digits:6'],
            'address' => ['required', 'string', 'max:500'],
            'pincode' => ['required', 'numeric', 'digits:6'],
            'state' => ['required', 'string', 'max:100'],
            'cdt' => ['required', 'string', 'max:50'],
        ], [
            'name.required' => 'The User Name field is required.',
            'name.string' => 'The User Name must be a valid string.',
            'name.max' => 'The User Name cannot exceed 255 characters.',
            'role.required' => 'Please select a Role.',
            'otp.required' => 'The OTP field is required.',
            'otp.numeric' => 'OTP must be a number.',
            'otp.digits' => 'OTP must be exactly 6 digits.',
            'address.required' => 'The Address field is required.',
            'address.string' => 'Address must be a valid string.',
            'address.max' => 'Address cannot exceed 500 characters.',
            'pincode.required' => 'The Pincode field is required.',
            'pincode.numeric' => 'Pincode must be a number.',
            'pincode.digits' => 'Pincode must be exactly 6 digits.',
            'state.required' => 'The State field is required.',
            'state.string' => 'State must be a valid string.',
            'state.max' => 'State cannot exceed 100 characters.',
            'cdt.required' => 'The CDT field is required.',
            'cdt.string' => 'CDT must be a valid string.',
            'cdt.max' => 'CDT cannot exceed 50 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the user to update
        $user = RegisterUser::find($id);
        if (!$user) {
            session()->flash('error', 'User  not found.');
            return redirect()->route('admin');
        }

        // Update user details
        $user->user_name = $request->name;
        $user->user_role = $request->role;
        $user->user_otp = $request->otp;
        $user->user_address = $request->address;
        $user->user_pincode = $request->pincode;
        $user->user_state = $request->state;
        $user->user_cdt = $request->cdt;

        if ($user->save()) {
            session()->flash('success', 'User  updated successfully.');
            return redirect()->route('admin');
        } else {
            session()->flash('error', 'User  could not be updated. Please try again.');
            return redirect()->route('admin');
        }
    }

    /**
     * Delete a user from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteuse($id)
    {
        $user = RegisterUser::find($id);
        if ($user) {
            $user->delete();
            session()->flash('success', 'User  deleted successfully.');
        } else {
            session()->flash('error', 'User  not found.');
        }
        return redirect()->route('admin');
    }
}
