<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostCommentRequest;
use App\Http\Requests\AddPostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserPostsController extends Controller
{
    public function my_posts()
    {
        $my_posts = Auth::user()->posts()->get();
        return view('layouts.front.my-posts', ['my_posts' => $my_posts]);
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(AddPostRequest $request)
    {
        $user = Auth::user();

        
        if (request()->file('post_image')) {   
            $file = $request->post_image;
            $extension = $file->getClientOriginalExtension();  
            $image_path = $request->file('post_image')->store('images', 's3');
        }

        if (request()->file('post_video')) {
            $file = $request->post_video;
            $extension = $file->getClientOriginalExtension();
            $video_path = $request->file('post_video')->store('videos', 's3');
        }

        $post = $user->posts()->create([
            'title' => $request->post_title,
            'description' => $request->post_description,
            'image_name' => request()->file('post_image') ? basename($image_path) : null,
            'image_path' => request()->file('post_image') ? Storage::disk('s3')->url($image_path) : null,
            'country' => $request->country
        ]);

        if (request()->file('post_video')) {
            $video_path = $request->file('post_video')->store('videos', 's3');

            $post->video()->create([
                'user_id' => Auth::id(),
                'video_name' => request()->file('post_video') ? basename($video_path) : null,
                'video_path' => request()->file('post_video') ? Storage::disk('s3')->url($video_path) : null,
            ]);
        }

        return redirect()->route('welcome');
    }

    public function edit(Post $post)
    {
        return view('layouts.front.edit-post', ['post' => $post]);
    }

    public function update(AddPostRequest $request, Post $post)
    {
        $user = Auth::user();

        if (request()->file('post_image')) {
            Storage::disk('s3')->delete("images/{$post->image_name}");
            $file = $request->post_image;
            $extension = $file->getClientOriginalExtension();
            $image_path = $request->file('post_image')->store('images', 's3');
        }

         if (request()->file('post_video')) {
            Storage::disk('s3')->delete("videos/{$post->video_name}");
            $video_path = $request->file('post_video')->store('videos', 's3');
    
            $post->video()->create([
                'user_id' => Auth::id(),
                'video_name' => request()->file('post_video') ? basename($video_path) : null,
                'video_path' => request()->file('post_video') ? Storage::disk('s3')->url($video_path) : null,
            ]);
        }

        $post->update([
            'title' => $request->post_title,
            'description' => $request->post_description,
            'image_name' => request()->file('post_image') ? basename($image_path) : $post->image_name,
            'image_path' => request()->file('post_image') ? Storage::disk('s3')->url($image_path) : $post->image_path,
            'video_name' => request()->file('post_video') ? basename($video_path) : $post->video_name,
            'video_path' => request()->file('post_video') ? Storage::disk('s3')->url($video_path) : $post->video_path,
            'country' => $request->country
        ]);

        return redirect()->route('welcome');
    }

    public function delete(Post $post)
    {
        Storage::disk('s3')->delete("images/{$post->image_name}");
        Storage::disk('s3')->delete("videos/{$post->video_name}");

        $post->video()->delete();
        $post->delete();
        return back();
    }

    public function add_comment(AddPostCommentRequest $request, Post $post)
    {
        try {
            $comment = $post->comments()->create([
                'title' => $request->title,
                'user_id' => Auth::id()
            ]);
    
            $comment = $comment->load('user');
            return $comment;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }


    public function add_like($id)
    {
        $post = Post::findOrFail($id);
        $like = $post->likes()->create(['user_id' => Auth::id()]);
        return $like;   
        
    }

    public function delete_like($id)
    {
        $post = Post::findOrFail($id);
        $like = $post->likes()->where('user_id', Auth::id())->delete();
        return $like;   
        
    }


    public function all_comments($id)
    {
        try {
            $post = Post::findOrFail($id);
            $comments = $post->comments()->with('user')->get();
            return $comments;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
       
    }

    public function share_post(Post $post)
    {
        $shared_post = Post::create([
            'user_id' => Auth::id(),
            'title' => $post->title,
            'description' => $post->description,
            'image_name' => $post->image_name,
            'image_path' => $post->image_path,
            'is_shared' => true,
            'shared_by' => auth()->user()->id
        ]);

        $shared_post->video()->create([
            'video_name' => $post->video_name,
            'video_path' => $post->video_path,
        ]);

        Alert::success('Post shared successfully');

        return back();
    }
}
