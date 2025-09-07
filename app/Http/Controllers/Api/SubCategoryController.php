<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Services\Contracts\SubCategoryServiceInterface;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends Controller
{
    protected SubCategoryServiceInterface $subCategoryService;

    public function __construct(SubCategoryServiceInterface $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    /**
     * Display a listing of subcategories
     */
    public function index(): JsonResponse
    {
        $subCategories = $this->subCategoryService->getAllSubCategories();

        return response()->json([
            'success' => true,
            'message' => 'Subcategories retrieved successfully',
            'data' => SubCategoryResource::collection($subCategories),
        ]);
    }

    /**
     * Display the specified subcategory
     */
    public function show(int $id): JsonResponse
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);

        if (!$subCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subcategory retrieved successfully',
            'data' => new SubCategoryResource($subCategory),
        ]);
    }

    /**
     * Get subcategories by category ID
     */
    public function getByCategory(int $categoryId): JsonResponse
    {
        $subCategories = $this->subCategoryService->getSubCategoriesByCategoryId($categoryId);

        return response()->json([
            'success' => true,
            'message' => 'Subcategories retrieved successfully',
            'data' => SubCategoryResource::collection($subCategories),
        ]);
    }
}
