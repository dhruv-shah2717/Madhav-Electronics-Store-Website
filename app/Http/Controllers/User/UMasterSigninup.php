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

class UMasterSigninup extends Controller
{
    /**
     * Display the sign-in page.
     *
     * @return \Illuminate\View\View
     */
    public function signin()
    {
        if (session("Uemail") || session("Aemail")) {
            session()->flash("error", "You are already logged into your account.");
            return redirect()->route('home'); // Redirect to home if already logged in
        }
        return view('User/Signin');
    }

    /**
     * Handle the sign-in action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signin_action(Request $request)
    {
        // Validate the email input
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'The Email is required.',
            'email.email' => 'The Email must be a valid format.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Process the sign-in
        $email = strtoupper($request->email);
        $user = RegisterUser::where('user_email', $email)->first();

        if ($user) {
            // Generate and send OTP
            $otp = mt_rand(100000, 999999);
            $user->user_otp = $otp;
            $user->save();

            $data = ['email' => $request['email'], 'otp' => $otp];
            Mail::send('User/SendOtp', ['data1' => $data], function($message) use ($data) {
                $message->to($data['email']);
                $message->from('your_email@example.com', 'Dhruv Shah');
            });

            session()->flash('success', 'Verify your account with the OTP sent to your email.');
            session()->put('email', $email);
            return redirect()->route('otp');
        } else {
            session()->flash('error', 'Your account has not been created. Please create an account.');
            return redirect()->route('signin');
        }
    }

    /**
     * Display the sign-up page.
     *
     * @return \Illuminate\View\View
     */
    public function signup()
    {
        if (session("Uemail") || session("Aemail")) {
            session()->flash("error", "You are already logged into your account.");
            return redirect()->route('home'); // Redirect to home if already logged in
        }
        return view('User/Signup');
    }

    /**
     * Handle the sign-up action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup_action(Request $request)
    {
        // Validate the email input
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:registerusers,user_email'],
        ], [
            'email.required' => 'The Email is required.',
            'email.email' => 'The Email must be a valid format.',
            'email.unique' => 'The Email ID is already registered.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Create a new user and send OTP
        $otp = mt_rand(100000, 999999);
        $user = new RegisterUser();
        $email = strtoupper($request->email);
        $user->user_email = $email;
        $user->user_otp = $otp;

        if ($user->save()) {
            $data = ['email' => $request['email'], 'otp' => $otp];
            Mail::send('User/SendOtp', ['data1' => $data], function($message) use ($data) {
                $message->to($data['email']);
                $message->from('your_email@example.com', 'Dhruv Shah');
            });

            session()->flash('success', 'Verify the OTP sent to your email.');
            session()->put('email', $email);
            return redirect()->route('otp');
        } else {
            session()->flash('error', 'Error in creating account.');
            return redirect()->route('signup');
        }
    }

    /**
     * Display the OTP verification page.
     *
     * @return \Illuminate\View\View
     */
    public function otp()
    {
        if (session("Uemail") || session("Aemail")) {
            session()->flash("error", "You are already logged into your account.");
            return redirect()->route('home'); // Redirect to home if already logged in
        }
        return view('User/Otp');
    }

    /**
     * Handle the OTP verification action.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function otp_action(Request $request)
    {
        // Validate the OTP input
        $validate = Validator::make($request->all(), [
            'otp' => ['required', 'min:6', 'integer'],
        ], [
            'otp.required' => 'The OTP is required.',
            'otp.min' => 'The OTP must be exactly 6 digits.',
            'otp.integer' => 'The OTP must be an integer.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Verify the OTP
        $user = RegisterUser::where('user_email', session('email'))->first();
        if ($user && $user->user_otp == $request['otp']) {
            session()->forget('email');
            session()->flash('success', 'Account created successfully and logged in.');

            // Redirect based on user role
            if ($user->user_role == 'Admin') {
                $adminEmail = strtoupper($user->user_email);
                session()->put('Aemail', $adminEmail);
                return redirect()->route('admin');
            } else {
                $userEmail = strtoupper($user->user_email);
                session()->put('Uemail', $userEmail);
                return redirect()->route('home');
            }
        } else {
            session()->flash('error', 'The OTP you entered is incorrect.');
            return redirect()->route('otp');
        }
    }
}
