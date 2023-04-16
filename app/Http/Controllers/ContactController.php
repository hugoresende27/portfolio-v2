<?php

namespace App\Http\Controllers;
use App\Models\portfolio\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function store(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'company' => 'required|max:100',
            'email' => 'required|email',
            'phone_number' => 'required|max:10',
            'message' => 'nullable',
        ]);

        $contact = Contact::create($validatedData);

        return $contact;
    }

}
