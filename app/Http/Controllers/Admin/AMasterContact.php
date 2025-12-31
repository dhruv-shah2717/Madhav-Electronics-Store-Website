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

class AMasterContact extends Controller
{
    /**
     * Display the list of contact messages.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $data = [
            'con' => Contact::all()
        ];
        return view('Admin/Contact/Manage', compact('data'));
    }

    /**
     * Display the form to edit a specific contact message.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'con' => Contact::find($id),
            'id' => $id
        ];
        return view('Admin/Contact/Edit', compact('data'));
    }

    /**
     * Update a contact message and send a response email.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatecon(Request $request, $id)
    {
        // Validate the input data
        $validate = Validator::make($request->all(), [
            'conmess' => ['required', 'min:5', 'max:200'],
        ], [
            'conmess.required' => 'The Contact Message is required.',
            'conmess.min' => 'The Contact Message must be at least 5 characters long.',
            'conmess.max' => 'The Contact Message may not exceed 200 characters.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Find the contact message to update
        $contact = Contact::find($id);
        if (!$contact) {
            session()->flash('error', 'Contact message not found.');
            return redirect()->route('manage.con');
        }

        // Update the contact status and prepare email data
        $contact->contact_status = 'Resolved';
        $data = [
            'username' => $contact['contact_name'],
            'email' => $contact['contact_email'],
            'message' => $request['conmess']
        ];

        // Send the response email
        Mail::send('Admin/Contact/SendMessage', ['data1' => $data], function($message) use ($data) {
            $message->to($data['email']);
            $message->from('your_email@example.com', 'Dhruv Shah');
        });

        // Save the updated contact message
        if ($contact->save()) {
            session()->flash('success', 'Complaint resolved successfully.');
            return redirect()->route('manage.con');
        } else {
            session()->flash('error', 'Error resolving the complaint. Please try again.');
            return redirect()->route('manage.con');
        }
    }
}
