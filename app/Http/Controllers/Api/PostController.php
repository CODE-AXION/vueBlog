<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $categories = request('filterCategories',[]);

        $posts = Post::when(count($categories), function ($query) use ($categories) {
            $query->whereIn('category_id', $categories);
        })->get();

        return PostResource::collection($posts);
    }

    public function getPosts()
    {
        $posts = Post::with('category')->get();

        return PostResource::collection($posts);
    }

    public function deletePosts($id)
    {
        $post = Post::find($id)->first()->delete();

        return response()->json(['message' => 'Post Deleted Successfully','success' => true]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'metaTitle' => ['required'],
            'metaDescription' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ]);


        try {

            Post::create([

                'title' => $request->title,
                'meta_title' => $request->metaTitle,
                'meta_description' => $request->metaDescription,
                'description' => $request->description,
                'category_id' => $request->category,
                'status' => $request->status
            ]);

            return response()->json(['success' => true]);

        } catch (\Throwable $th) {

            return response()->json(['success' => false,'Oops Some Error Occured !']);
        }
    }
}
