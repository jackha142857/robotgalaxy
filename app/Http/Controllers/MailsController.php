<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Mail\SendMailable;

class MailsController extends Controller
{
    /**
     * Display a listing of the mails.
     */
    public function index()
    {
        $mails = Mail::with('user','user')->paginate(25);
        return view('mails.index', compact('mails'));
    }

    /**
     * Show the form for creating a new mail.
     */
    public function create()
    {
        $Users = User::pluck('id','id')->all();        
        return view('mails.create', compact('Users','Users'));
    }

    /**
     * Store a new mail in the storage.
     */
    public function store(Request $request)
    {
        try {            
            $data = $this->getData($request);            
            Mail::create($data);
            return redirect()->route('mails.mail.index')
                ->with('success_message', 'Mail was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified mail.
     */
    public function show($id)
    {
        $mail = Mail::with('user','user')->findOrFail($id);
        return view('mails.show', compact('mail'));
    }

    /**
     * Show the form for editing the specified mail.
     */
    public function edit($id)
    {
        $mail = Mail::findOrFail($id);
        $Users = User::pluck('id','id')->all();
        return view('mails.edit', compact('mail','Users','Users'));
    }

    /**
     * Update the specified mail in the storage.
     */
    public function update($id, Request $request)
    {
        try {            
            $data = $this->getData($request);            
            $mail = Mail::findOrFail($id);
            $mail->update($data);
            return redirect()->route('mails.mail.index')
                ->with('success_message', 'Mail was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }        
    }

    /**
     * Remove the specified mail from the storage.
     */
    public function destroy($id)
    {
        try {
            $mail = Mail::findOrFail($id);
            $mail->delete();
            return redirect()->route('mails.mail.index')
                ->with('success_message', 'Mail was successfully deleted.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }
    
    /**
     * Get the request's data from the request.
     */
    protected function getData(Request $request)
    {
        $rules = [
                'user_id' => 'nullable',
            'title' => 'required|string|min:1|max:255',
            'content' => 'required|string|min:1|max:255',
            'sender_user_id' => 'nullable',
            'state' => 'boolean', 
        ];        
        $data = $request->validate($rules);
        $data['state'] = $request->has('state');
        return $data;
    }
    
    public function sendMail(Request $request)
    {
        if($request->ajax()) 
        {
            $name = $request->input('name', 'Anonymous');
            $sender = $request->input('sender', 'Anonymous');
            $receiver = User::where('id', 1)->get()->first()->email;
            $subject = $request->input('subject', 'N/A');
            $content = $request->input('content', 'N/A');
            \Illuminate\Support\Facades\Mail::to($receiver)->send(new SendMailable($name, $sender, $subject, $content));    
                    
            return 'Email was sent! Thanks for your feedback! We will reply as soon as possible!';
        }
        return "Fail to sent email! Please contact us by phone!";
    }
}
