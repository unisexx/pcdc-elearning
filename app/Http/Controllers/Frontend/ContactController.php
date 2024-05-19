<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function save(Request $request)
    {
        // Validate the request
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel'   => 'nullable|string|max:20',
            'msg'   => 'required|string',
        ]);

        // Create a new contact
        Inbox::create([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'tel'   => $request->input('tel'),
            'msg'   => $request->input('msg'),
        ]);

        // Redirect or return response
        return redirect()->back()->with('success', 'ข้อความของคุณถูกส่งเรียบร้อยแล้ว');
    }
}
