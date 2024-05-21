<?php

namespace App\Http\Controllers\Type;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Type\TypeRequest;
use App\Http\Resources\Type\TypeIndexResource;
use App\Http\Resources\Type\TypeShowResource;
use App\Repositories\Interfaces\TypeRepositoryInterface;

class TypeController extends Controller
{
    public function __construct(protected TypeRepositoryInterface $typeRepositoryInterface)
    {
        //
    }

    public function index()
    {
        $types = $this->typeRepositoryInterface->getAllTypes();

        return ApiResponse::success(
            data: ['types' => TypeIndexResource::collection($types)],
        );
    }

    public function store(TypeRequest $request)
    {
        $type = $this->typeRepositoryInterface->storeType($request->only(['name']));

        return ApiResponse::created(
            data: ['type' => new TypeIndexResource($type)],
        );
    }

    public function show(string $id)
    {
        $type = $this->typeRepositoryInterface->getSingleType($id);

        return ApiResponse::success(
            data: ['type' => new TypeShowResource($type)],
        );
    }

    public function update(TypeRequest $request, string $id)
    {
        $type = $this->typeRepositoryInterface->updateType($request->only(['name']), $id);

        return ApiResponse::success(
            data: ['type' => new TypeShowResource($type)],
        );
    }

    public function delete(string $id)
    {
        $typeTemporaryName = $this->typeRepositoryInterface->deleteType(id: $id);

        return ApiResponse::success(
            data: "Type with name {$typeTemporaryName} has been deleted successfully."
        );
    }
}
