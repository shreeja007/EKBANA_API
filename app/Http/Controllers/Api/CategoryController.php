<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\CompanyCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = CompanyCategory::query()
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%' . $request->keyword . '%'))
            ->paginate(10);

        return $this->successResponse(
            CategoryResource::collection($categories)->response()->getData(true),
            'Category Fetched Successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = CompanyCategory::create($request->validated());

        return $this->successResponse(
            new CategoryResource($category),
            'Category created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyCategory $category)
    {
        $category->load('companies');
        return $this->successResponse(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, CompanyCategory $category)
    {
        $category->update($request->only('title'));
        return $this->successResponse(new CategoryResource($category), 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyCategory $category)
    {
        $category->delete();
        return $this->successResponse(null, 'Category deleted successfully');
    }
}
