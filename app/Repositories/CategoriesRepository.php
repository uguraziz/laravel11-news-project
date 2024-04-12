<?php
namespace App\Repositories;

use App\Models\Category;
use App\Interface\CategoriesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;


class CategoriesRepository implements CategoriesInterface
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all(): Collection
    {
        return $this->category::all();
    }

    public function find($id): ?Category
    {
        return $this->category::find($id);
    }

    public function findOrAll(int $id = 0): JsonResponse
    {
        if($id != 0){
            $category = $this->find($id);
        }else{
            $category = $this->all();
        }

        if($category){
            return response()->json([
                'status' => true,
                'message' => 'Category found',
                'data' => $category
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Category not found',
        ], 400);
    }

    public function create(array $data): JsonResponse
    {
        $category = $this->category;
        $category->main_categories_id = $data['main_categories_id'];
        $category->name = $data['name'];
        $category->slug = Str::slug($data['name']);
        $category->description = $data['description'];
        $category->title = $data['title'];
        $category->image_id = $data['image_id'];
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ]);
    }

    public function update(array $data, int $id): JsonResponse
    {
        $category = $this->find($id);
        $category->main_categories_id = $data['main_categories_id'] ?? $category->main_categories_id;
        $category->name = $data['name'] ?? $category->name;
        $category->slug = Str::slug($data['name']) ?? $category->slug;
        $category->description = $data['description'] ?? $category->description;
        $category->title = $data['title'] ?? $category->title;
        $category->image_id = $data['image_id'] ?? $category->image_id;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $category = $this->find($id);

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
