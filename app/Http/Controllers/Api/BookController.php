<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = Book::paginate(10);
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication' => 'required|date',
            'word_count' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $book = Book::create($validated);
        return response()->json($book, ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'publisher' => 'string|max:255',
            'author' => 'string|max:255',
            'genre' => 'string|max:255',
            'publication' => 'date',
            'word_count' => 'integer',
            'price' => 'numeric'
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();
        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
