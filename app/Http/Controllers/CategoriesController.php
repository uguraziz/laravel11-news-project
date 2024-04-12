<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    protected $categoriesRepository;
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function get_categories(int $id = 0)
    {
        return $this->categoriesRepository->findOrAll($id);
    }

    public function create_category(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        return $this->categoriesRepository->create($data);
    }

    public function update_category(UpdateCategoryRequest $request, int $id)
    {
        $data = $request->validated();
        return $this->categoriesRepository->update($data, $id);
    }

    public function delete_category(int $id)
    {
        return $this->categoriesRepository->delete($id);
    }
}
