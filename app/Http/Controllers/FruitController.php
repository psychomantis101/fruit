<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Models\Fruit;
use App\Services\FruitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function __construct(
        private FruitService $fruitService
    ){}

    public function index(): JsonResponse
    {
        $fruits = Fruit::allFruits()->get()->toArray();

        return response()->json($fruits);
    }

    public function updateFruit(FruitRequest $request, Fruit $fruit): JsonResponse
    {
        $fruit->update($request->validated());

        return response()->json('success');
    }

    public function updateNesting(Request $request): JsonResponse
    {
        $this->fruitService->updateNesting($request->fruits);

        return response()->json('success');
    }
}


