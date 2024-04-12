<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;

class CategoriesController extends Controller
{
    public function get_categories(int $id = 0)
    {
        if($id != 0) {
            $categories = Category::find($id);
        } else {
            $categories = Category::all();
        }

        if(!$categories) {
            return response()->json([
                'status' => false,
                'message' => 'Categories not found'
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => 'Categories listed successfully',
            'data' => $categories
        ]);
    }

    public function create_category(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->main_categories_id = $request->main_categories_id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->title = $request->title;
        $category->image_id = $request->image_id;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ]);
    }

    public function update_category(UpdateCategoryRequest $request, int $id)
    {
        $category = Category::findOrFail($id);

        $category->main_categories_id = $request->main_categories_id ?? $category->main_categories_id;
        $category->name = $request->name ?? $category->name;
        $category->slug = Str::slug($request->name) ?? $category->slug;
        $category->description = $request->description ?? $category->description;
        $category->title = $request->title ?? $category->title;
        $category->image_id = $request->image_id ?? $category->image_id;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function delete_category(int $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 400);
        }

        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
