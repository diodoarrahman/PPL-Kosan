<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'kosan_id' => 'required|exists:kosans,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'kosan_id' => $request->kosan_id,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id
        ]);

        return back();
    }
}
