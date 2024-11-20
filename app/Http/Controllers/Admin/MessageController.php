<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // Get search query
        $search = $request->query('q');

        // Query messages with search functionality
        $messages = Message::where(function($query) use ($search) {
            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            }
        })->paginate(10); // Adjust pagination as needed

        // Return to the index view with data
        return view('admin.message.index', compact('messages'));
    }

    public function show($id)
{
    $message = Message::findOrFail($id);

    return view('admin.message.show', compact('message'));
}
}
