<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CategoryRepositoryInterface $repository)
    {
        $data = $repository->paginate($request->input('page_limit'));
        return $this->successResponse(CategoryResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = StoreCategoryAction::run($request->validated());
        return $this->successResponse(
            CategoryResource::make($data->load('parent','children')),
            trans('category.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->successResponse(CategoryResource::make($category->load('parent')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $model = UpdateCategoryAction::run($category, $request->validated());
        return $this->successResponse(CategoryResource::make($model->load('parent')),
            trans('category.update_success'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DeleteCategoryAction::run($category);
        return $this->successResponse(
            CategoryResource::make($category),
            trans('category.delete_success')
        );
    }
}
