<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\pagescontroller;
use App\Http\Controllers\CommentController;




class CommentsController extends Controller
{
    public function store(Post $post)
    {
        $data = ['body' => request('body'), 'post_id' => $post->id];
    
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
    
        Comment::create($data);
    
        return back();
    }
    
    
}
