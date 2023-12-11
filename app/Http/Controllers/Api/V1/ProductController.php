<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\StoreProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Product::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductRepositoryInterface $repository)
    {
        $data=$repository->paginate($request->input('page_limit'));
        return $this->resultWithAdditional(ProductResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
       $product= StoreProductAction::run($request->validated());
       return $this->successResponse(
           ProductResource::make($product),
           trans('product.store_success')
       );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->successResponse(ProductResource::make($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $model = UpdateProductAction::run($product, $request->validated());
        return $this->successResponse(ProductResource::make($model),
            trans('product.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DeleteProductAction::run($product);
        return $this->successResponse(ProductResource::make($product),
            trans('product.delete_success'));
    }
    public function togglePublished(Product $product, ProductRepositoryInterface $repository): JsonResponse
    {
        $this->authorize('update', $product);
        $data = $repository->togglePublished($product);
        return $this->successResponse(ProductResource::make($data));
    }
}
