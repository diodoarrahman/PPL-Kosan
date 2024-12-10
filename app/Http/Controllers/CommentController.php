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
    public function destroy($id)
    {
        // Cari komentar atau balasan berdasarkan ID
        $comment = Comment::findOrFail($id);

        // Pastikan hanya admin atau pemilik komentar yang bisa menghapusnya
        if (Auth::user()->role === 'admin' || Auth::id() === $comment->user_id) {
            $comment->delete();  // Hapus komentar atau balasan
            return redirect()->back()->with('success', 'Komentar atau balasan berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar atau balasan ini.');
    }
}
