<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function fetch_messages(Request $request)
    {
        $messages = Message::paginate(12);

        foreach ($messages as $message) {
            $message->seen= true;
            $message->save();
        }

        return view('admin.messages', compact('messages'));
    }
    public function send_message(Request $request)
    {
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10'],
            'email' => ['required', 'email:rfc,dns'],
            'message' => ['required', 'max:250']
        ]);

        $message = Message::create($request->all());

        return redirect('/')->with('success', 'Message reçu avec succès, nous vous répondrons dans les plus brefs délais');
        
    }

    public function delete_message(Request $request, $id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message Deleted!');
    }
}
