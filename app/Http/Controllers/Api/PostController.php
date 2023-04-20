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
}
