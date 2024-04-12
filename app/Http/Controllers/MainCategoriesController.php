<?php

namespace App\Http\Controllers;

use App\Models\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{
    public function get_main_categories(int $id = 0)
    {
        if($id != 0) {
            $main_categories = MainCategories::find($id);
        } else {
            $main_categories = MainCategories::all();
        }

        if(!$main_categories) {
            return response()->json([
                'status' => false,
                'message' => 'Main categories not found'
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => 'Main categories listed successfully',
            'data' => $main_categories
        ]);
    }

    public function create_main_category(Request $request)
    {
        $main_category = new MainCategories();
        $main_category->name = $request->name;
        $main_category->slug = Str::slug($request->name);
        $main_category->image_id = $request->image_id;
        $main_category->save();

        return response()->json([
            'status' => true,
            'message' => 'Main category created successfully',
            'data' => $main_category
        ]);
    }

    public function update_main_category(Request $request, int $id)
    {
        $main_category = MainCategories::findOrFail($id);

        $main_category->name = $request->name ?? $main_category->name;
        $main_category->slug = Str::slug($request->name) ?? $main_category->slug;
        $main_category->image_id = $request->image_id ?? $main_category->image_id;
        $main_category->save();

        return response()->json([
            'status' => true,
            'message' => 'Main category updated successfully',
            'data' => $main_category
        ]);
    }

    public function delete_main_category(int $id)
    {
        $main_category = MainCategories::findOrFail($id);
        $main_category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Main category deleted successfully',
            'data' => $main_category
        ]);
    }
}
