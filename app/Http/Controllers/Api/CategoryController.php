<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $categories = Category::withCount(['posts' => function($query)
        {
            $query->when(count(request()->input('category_id',[])),function($query)
            {
                $query->whereIn('category_id',request()->category_id['filterCategories']);
            });
        }])->get();

        return CategoryResource::collection($categories);
    }

    public function getCategories()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }
}
