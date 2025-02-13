<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoryRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category = $category->create($request->mappedData());
        return $this->successResponse('Category created successfully.',
            [new CategoryResource($category)]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->mappedData());
        return $this->successResponse('Category updated successfully.',
            [new CategoryResource($category)]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse('Category deleted successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return $this->successResponse('Category restored successfully');
    }
}
