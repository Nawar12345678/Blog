<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller\pagescontoller;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\User;
use App\Models\Role;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


use App\Models\Category;
use Illuminate\Support\Facades\Schema;








class pagescontroller extends Controller
{
    public function posts(){
        $posts = Post::all();
        return view('content.posts', compact('posts'));
    }
    public function post(Post $post){
        //$post = DB::table('posts')->find($id);
        return view('content.post', compact('post'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'url' => 'image|mimes:jpg,jpeg,gif,png|max:2048',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if ($request->hasFile('url')) {
            $img_name = time() .'.' . $request->file('url')->getClientOriginalExtension();
            $request->file('url')->move(public_path('upload'), $img_name);
            $post->url = $img_name;
        }
        else {
            // Provide a default value if 'url' is not present in the request
            $post->url = 'default.jpg';
        }

      // Check if the request has a category_id before attempting to save it
    if ($request->has('category_id')) {
    $post->category_id = $request->input('category_id');
    } else {

        $post->category_id = 1; 
    }

$post->save();


        $post->save();

        return redirect('/posts');
    }



    public function category($name){
        $cat = DB::table('categories')->where('name', $name)->value('id');
        $posts = DB::table('posts')->where('category_id' ,$cat)->get();

        return view('content.category', compact('posts'));
    }


    public function admin()
    {
        $users = User::all();
        return view('content.admin', compact('users') );
    }


    public function addRole(Request $request)
    {
        $user = User::where('email',$request['email'])->first();
        $user->roles()->detach();
        if($request['role_user'])
        {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if($request['role_editor'])
        {
            $user->roles()->attach(Role::where('name', 'Editor')->first());
        }
        if($request['role_admin'])
        {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();

    }
    public function editor()
    {
        return view('content.editor');
    }

    public function accessDenied()
    {
        return view('content.access_denied');
    }

    public function like(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_like = 0;


        $like = DB::table('likes')
            ->where('post_id', $post_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$like)
        {
            $new_like = new Like;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 1;
            $new_like->save();
            $is_like = 1;

        }
            elseif ($like->like == 1) {
                DB::table('likes')
                    ->where('post_id', $post_id)
                    ->where('user_id', Auth::user()->id)
                    ->delete();
                $is_like = 0;
            } 
            elseif ($like->like == 0) {
                DB::table('likes')
                    ->where('post_id', $post_id)
                    ->where('user_id', Auth::user()->id)
                    ->update(['like' => 1]);
                $is_like = 1;
                $change_like = 1;

            }

        $response = array(
            'is_like' => $is_like,
            'change_like' => $change_like,

        );

        return response()->json($response, 200);
    }


    public function dislike(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_dislike = 0;

        $dislike = DB::table('likes')
            ->where('post_id', $post_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if(!$dislike)
        {
            $new_like = new Like;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 0;
            $new_like->save();
            $is_disike = 1;

        }
            elseif ($dislike->like == 0) {
                DB::table('likes')
                    ->where('post_id', $post_id)
                    ->where('user_id', Auth::user()->id)
                    ->delete();
                $is_dislike = 0;
            } 
            elseif ($dislike->like == 1) {
                DB::table('likes')
                    ->where('post_id', $post_id)
                    ->where('user_id', Auth::user()->id)
                    ->update(['like' => 0]);
                $is_dislike = 1;
                $change_dislike = 1;

            }

        $response = array(
            'is_dislike' => $is_dislike,
            'change_dislike' => $change_dislike,

        );

        return response()->json($response, 200);
    }

    public function statistics()
    {
        $users = DB::table('users')->count();
        $posts = DB::table('posts')->count();
        $comments = DB::table('comments')->count();
        
        //comments
        $most_comments = User::withCount('comments')
        ->orderBy('comments_count', 'desc')
        ->first();
    
    
        $likes_count_1 = DB::table('likes')
        ->where('user_id', $most_comments->id)
        ->count();


        $user_1_count = $most_comments->comments_count + $most_comments->likes_count;
        //ilkes 


        $most_likes = User::withCount('likes')
        ->orderBy('likes_count', 'desc')
        ->first();
        $comments_count_2 = DB::table('comments')
        ->where('user_id', $most_likes->id)
        ->count();

        $user_2_count = $most_likes->likes_count + $most_likes->comments_count;



    if($user_1_count > $user_2_count)
    {
        $active_user = $most_comments->name;
        $active_user_likes = $likes_count_1;
        $active_user_comments =  $most_comments->comments_count;

    }
    else
    {
        $active_user = $most_likes->name;
        $active_user_likes = $most_likes->likes_count;
        $active_user_comments = $most_comments->comments_count_2;

    }

        $statistics = array(
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
            'active_user' => $active_user,
            'active_user_likes' => $active_user_likes,
            'active_user_comments' => $active_user_comments,

        );


        return view('content.Statistics', compact('statistics'));

    }


}









