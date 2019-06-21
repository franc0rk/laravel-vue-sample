<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostAttachment;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['attachments', 'user', 'category'])->get()->toArray();

        return response()->json($posts);
    }

    public function store(CreatePostRequest $request)
    {
        $post = new Post($request->all());

        auth()->user()->posts()->save($post);

        // saving attachment
        $filename = $post->id . '-' . $request->attachment->getClientOriginalName();
        $post->attachments()->save(new PostAttachment(['path' => 'attachments/' . $filename]));
        \Storage::disk('attachments')->put($filename, \File::get($request->attachment));

        $post->load(['attachments', 'user', 'category']);

        return response()->json($post->toArray(), 201);
    }
}
