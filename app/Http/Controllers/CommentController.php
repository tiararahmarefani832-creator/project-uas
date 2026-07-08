<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,      
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Pertanyaan/Komentar berhasil dikirim!');
    }
}