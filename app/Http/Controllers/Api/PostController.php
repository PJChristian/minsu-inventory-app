<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $documents = Post::paginate(15);

        return response()->json($documents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $document = Post::create($request->validated());

        return response()->json([
            'message' => 'Document created successfully',
            'data' => $document,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $document = Post::findOrFail($id);

        return response()->json($document);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id): JsonResponse
    {
        $document = Post::findOrFail($id);
        $document->update($request->validated());

        return response()->json([
            'message' => 'Document updated successfully',
            'data' => $document,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $document = Post::findOrFail($id);
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully']);

    }
}
