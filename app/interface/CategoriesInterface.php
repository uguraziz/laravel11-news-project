<?php

namespace App\Interface;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface CategoriesInterface
{
    public function all(): Collection;
    public function find($id): ?Category;
    public function findOrAll(int $id = 0): JsonResponse;
    public function create(array $data): JsonResponse;
    public function update(array $data, int $id): JsonResponse;
    public function delete(int $id): JsonResponse;
}
