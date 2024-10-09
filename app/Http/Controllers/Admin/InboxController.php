<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rs = Inbox::paginate(10);

        return view('admin.inbox.index', compact('rs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inbox.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $faq = Inbox::create($input);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.inbox.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rs = Inbox::find($id);

        return view('admin.inbox.edit', @compact('rs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rs    = Inbox::find($id);

        // Replace local image path with full URL
        if (!empty($input['reply'])) {
            $input['reply'] = str_replace(
                '../../../js/',
                'https://e-pcdc.ddc.moph.go.th/js/',
                $input['reply']
            );
        }

        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        // Send email after updating using email from form
        if (!empty($input['email']) && !empty($input['reply'])) {
            $this->sendEmailReply($input['email'], $input['reply']);
        }

        return redirect()->route('admin.inbox.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inbox::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }

    /**
     * Send email to the provided reply email with HTML content.
     */
    protected function sendEmailReply($email, $replyMsg)
    {
        $subject = 'e-Learning หลักสูตรการป้องกันควบคุมโรคติดต่อและภัยสุขภาพในเด็ก : ตอบกลับความเห็นของคุณ';

        // Use Mail::html to send HTML content email
        Mail::html($replyMsg, function ($msg) use ($email, $subject) {
            $msg->to($email)
                ->subject($subject);
        });
    }

}
